<?php

namespace App\Http\Controllers;

use App\Models\AffiliateLevel;
use App\Models\Affiliates;
use App\Models\CurrencyRate;
use App\Models\OjafunnelNotification;
use App\Models\OjaPlan;
use App\Models\OjaPlanInterval;
use App\Models\OjaSubscription;
use App\Models\PaymentGateway;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Stripe;
use Stripe\Exception\CardException;
use Stripe\StripeClient;

class AccountUpgradeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    function fcm($body, $firebaseToken)
    {
        $SERVER_API_KEY = config('app.fcm_token');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => config('app.name'),
                "body" => $body,
                'image' => URL::asset('assets/images/Logo-fav.png'),
            ],
            'vibrate' => 1,
            'sound' => 1
        ];

        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $result = curl_exec ( $ch );

        return $result;
    }

    public function upgrade_account($amount)
    {
        $amount = Crypt::decrypt($amount);

        $user = User::findorfail(Auth::user()->id);

        return view('dashboard.makePayment', [
            'amount' => $amount,
            'user' => $user
        ]);
    }

    public function upgrade_account_confirm($plan_id, $response, $price, $currency)
    {
        $planId = Crypt::decrypt($plan_id);
        $price = Crypt::decrypt($price);
        $currency = Crypt::decrypt($currency);

        // dd($planId, $response, number_format($price), $currency);

        $plan = OjaPlan::find($planId);
        $planInterval = OjaPlanInterval::where('plan_id', $plan->id)->where('price', $price)->where('currency', $currency)->first();

        // return (now()->addMonth()->subDays(3)->toDateString());

        if($planInterval->type == 'monthly')
        {
            $date = now()->addMonth();
            $expiryNotice = now()->addMonth()->subDays(7)->toDateString();
        }
        if($planInterval->type == 'yearly')
        {
            $date = now()->addYear()->toDateString();
            $expiryNotice = now()->addYear()->subDays(7)->toDateString();
        }


        $levels = AffiliateLevel::all();

        if (Auth::user()->referral_link) {
            $affiliates = Affiliates::where('referral_id', Auth::user()->id)->get();

            foreach ($affiliates as $affiliate) {
                if (!empty($affiliate->bonus)) {
                    continue; // Skip processing if bonus is not empty
                }

                $level = $levels->where('level', $affiliate->level)->first();

                if ($level) {
                    $earnings = $level->bonus_percent * $price / 100;

                    $affiliate->update([
                        'bonus' => $planInterval->currency_sign.''.$earnings
                    ]);

                    $user_wallet = User::find($affiliate->referrer_id);
                    if ($user_wallet) {
                        if($planInterval->currency_sign == '₦')
                        {
                            $user_wallet->update([
                                'wallet' => $user_wallet->wallet + $earnings,
                                'ref_bonus' => $user_wallet->ref_bonus + $earnings,
                            ]);
                        } else {
                            $user_wallet->update([
                                'dollar_wallet' => $user_wallet->dollar_wallet + $earnings,
                                'ref_bonus' => $user_wallet->ref_bonus + $earnings,
                            ]);
                        }
                    }
                }
            }
        }

        OjaSubscription::create([
            'user_id' => Auth::user()->id,
            'plan_id' => $plan->id,
            // 'plan_interval' =>
            'status' => 'Active',
            'ends_at' => $date,
            'started_at' => now(),
            'amount' => $planInterval->price,
            'currency' => $planInterval->currency,
            'expiry_notify_at' => $expiryNotice
        ]);

        $user = User::find(Auth::user()->id);

        $user->update([
            'plan' => $plan->id
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $planInterval->currency_sign.''.$planInterval->price,
            'reference' => $response,
            'status' => 'Account Upgrade.'
        ]);

        OjafunnelNotification::create([
            'to' => Auth::user()->id,
            'title' => config('app.name'),
            'body' => 'Your '.config('app.name').' account has been upgraded successfully.'
        ]);

        $currentUser = User::where('id', Auth::user()->id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        $this->fcm('Your '.config('app.name').' account has been upgraded successfully.', $currentUser);

        return redirect()->route('user.upgrade', Auth::user()->username)->with([
            'type' => 'success',
            'message' => 'Account upgrade completed successfully.'
        ]);
    }

    public function upgrade_account_with_balance($plan_id, $price, $currency)
    {
        $planId = Crypt::decrypt($plan_id);
        $price = Crypt::decrypt($price);
        $currency = Crypt::decrypt($currency);
        $plan = OjaPlan::find($planId);
        $planInterval = OjaPlanInterval::where('plan_id', $plan->id)->where('price', $price)->where('currency', $currency)->first();

        if($planInterval->currency_sign == '₦')
        {
            if($price > Auth::user()->wallet)
            {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Account naira wallet balance is low, top-up your wallet and try again.'
                ]);
            }
        } else {
            if($price > Auth::user()->dollar_wallet)
            {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Account dollar wallet balance is low, top-up your wallet and try again.'
                ]);
            }
        }

        if($planInterval->type == 'monthly')
        {
            $date = now()->addMonth();
            $expiryNotice = now()->addMonth()->subDays(7)->toDateString();
        }
        if($planInterval->type == 'yearly')
        {
            $date = now()->addYear()->toDateString();
            $expiryNotice = now()->addYear()->subDays(7)->toDateString();
        }

        $levels = AffiliateLevel::all();

        if (Auth::user()->referral_link) {
            $affiliates = Affiliates::where('referral_id', Auth::user()->id)->get();

            foreach ($affiliates as $affiliate) {
                if (!empty($affiliate->bonus)) {
                    continue; // Skip processing if bonus is not empty
                }

                $level = $levels->where('level', $affiliate->level)->first();

                if ($level) {
                    $earnings = $level->bonus_percent * $price / 100;

                    $affiliate->update([
                        'bonus' => $planInterval->currency_sign.''.$earnings
                    ]);

                    $user_wallet = User::find($affiliate->referrer_id);
                    if ($user_wallet) {
                        if($planInterval->currency_sign == '₦')
                        {
                            $user_wallet->update([
                                'wallet' => $user_wallet->wallet + $earnings,
                                'ref_bonus' => $user_wallet->ref_bonus + $earnings,
                            ]);
                        } else {
                            $user_wallet->update([
                                'dollar_wallet' => $user_wallet->dollar_wallet + $earnings,
                                'ref_bonus' => $user_wallet->ref_bonus + $earnings,
                            ]);
                        }
                    }
                }
            }
        }

        OjaSubscription::create([
            'user_id' => Auth::user()->id,
            'plan_id' => $plan->id,
            'status' => 'Active',
            'ends_at' => $date,
            'started_at' => now(),
            'amount' => $planInterval->price,
            'currency' => $planInterval->currency,
            'expiry_notify_at' => $expiryNotice
        ]);

        $user = User::find(Auth::user()->id);
        if($planInterval->currency_sign == '₦')
        {
            $user->update([
                'plan' => $plan->id,
                'wallet' => $user->wallet - $planInterval->price
            ]);
        } else {
            $user->update([
                'plan' => $plan->id,
                'dollar_wallet' => $user->dollar_wallet - $planInterval->price
            ]);
        }

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $planInterval->currency_sign.''.$planInterval->price,
            'reference' => config('app.name'),
            'status' => 'Account Upgrade.'
        ]);

        OjafunnelNotification::create([
            'to' => Auth::user()->id,
            'title' => config('app.name'),
            'body' => 'Your '.config('app.name').' account has been upgraded successfully.'
        ]);

        $currentUser = User::where('id', Auth::user()->id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        $this->fcm('Your '.config('app.name').' account has been upgraded successfully.', $currentUser);

        return redirect()->route('user.upgrade', Auth::user()->username)->with([
            'type' => 'success',
            'message' => 'Account upgrade completed successfully.'
        ]);
    }

    public function upgrade_account_with_stripe(Request $request, $plan_id, $price, $currency)
    {
        $planId = Crypt::decrypt($plan_id);
        $price = Crypt::decrypt($price);
        $currency = Crypt::decrypt($currency);

        if($price <= 0)
        {
            return back()->with([
                'type' => 'danger',
                'message' => "Please try again and if error persist, contact".config('app.name')." Administrator"
            ]);
        }

        // Fetch PaymentGateway details from the database
        $paymentGateway = PaymentGateway::where('name', 'Stripe')->first();

        try {
            $stripe = new StripeClient($paymentGateway->STRIPE_SECRET);

            $stripe->paymentIntents->create([
                'amount' => $price * 100,
                'currency' => $currency,
                'payment_method' => $request->payment_method,
                'description' => 'Product payment with stripe',
                'confirm' => true,
                'receipt_email' => Auth::user()->email,
                'automatic_payment_methods[enabled]' => true,
                'automatic_payment_methods[allow_redirects]' => 'never'
            ]);
        } catch (CardException $th) {
            return back()->with([
                'type' => 'danger',
                'message' => "There was a problem processing your payment."
            ]);
        }

        $plan = OjaPlan::find($planId);
        $planInterval = OjaPlanInterval::where('plan_id', $plan->id)->where('price', $price)->where('currency', $currency)->first();

        if($planInterval->type == 'monthly')
        {
            $date = now()->addMonth();
            $expiryNotice = now()->addMonth()->subDays(7)->toDateString();
        }
        if($planInterval->type == 'yearly')
        {
            $date = now()->addYear()->toDateString();
            $expiryNotice = now()->addYear()->subDays(7)->toDateString();
        }

        $levels = AffiliateLevel::all();

        if (Auth::user()->referral_link) {
            $affiliates = Affiliates::where('referral_id', Auth::user()->id)->get();

            foreach ($affiliates as $affiliate) {
                if (!empty($affiliate->bonus)) {
                    continue; // Skip processing if bonus is not empty
                }

                $level = $levels->where('level', $affiliate->level)->first();


                if ($level) {
                    $earnings = $level->bonus_percent * $price / 100;

                    $affiliate->update([
                        'bonus' => $planInterval->currency_sign.''.$earnings
                    ]);

                    $user_wallet = User::find($affiliate->referrer_id);

                    if ($user_wallet) {
                        if($planInterval->currency_sign == '₦')
                        {
                            $user_wallet->update([
                                'wallet' => $user_wallet->wallet + $earnings,
                                'ref_bonus' => $user_wallet->ref_bonus + $earnings,
                            ]);
                        } else {
                            $user_wallet->update([
                                'dollar_wallet' => $user_wallet->dollar_wallet + $earnings,
                                'ref_bonus' => $user_wallet->ref_bonus + $earnings,
                            ]);
                        }
                    }
                }
            }
        }

        OjaSubscription::create([
            'user_id' => Auth::user()->id,
            'plan_id' => $plan->id,
            'status' => 'Active',
            'ends_at' => $date,
            'started_at' => now(),
            'amount' => $planInterval->price,
            'currency' => $planInterval->currency,
            'expiry_notify_at' => $expiryNotice
        ]);

        $user = User::find(Auth::user()->id);
        $user->update([
            'plan' => $plan->id,
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $planInterval->currency_sign.''.$planInterval->price,
            'reference' => config('app.name').'with stripe',
            'status' => 'Account Upgrade.'
        ]);

        OjafunnelNotification::create([
            'to' => Auth::user()->id,
            'title' => config('app.name'),
            'body' => 'Your '.config('app.name').' account has been upgraded successfully.'
        ]);

        $currentUser = User::where('id', Auth::user()->id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        $this->fcm('Your '.config('app.name').' account has been upgraded successfully.', $currentUser);

        return redirect()->route('user.upgrade', Auth::user()->username)->with([
            'type' => 'success',
            'message' => 'Account upgrade completed successfully.'
        ]);
    }

}
