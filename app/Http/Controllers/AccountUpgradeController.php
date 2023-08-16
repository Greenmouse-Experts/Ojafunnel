<?php

namespace App\Http\Controllers;

use App\Models\OjafunnelNotification;
use App\Models\OjaPlan;
use App\Models\OjaPlanInterval;
use App\Models\OjaSubscription;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;

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
            'amount' => $planInterval->price,
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

        if($price > Auth::user()->wallet)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'Account wallet balance is low, top-up your wallet and try again.'
            ]);
        }

        // dd($planId, number_format($price), $currency);

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
            'plan' => $plan->id,
            'wallet' => $user->wallet - $planInterval->price
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $planInterval->price,
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

}
