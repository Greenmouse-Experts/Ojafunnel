<?php

namespace App\Http\Controllers;

use App\Mail\AdminWithdrawnNotification;
use App\Mail\UserWithdrawnNotification;
use App\Models\Admin;
use App\Models\AffiliateLevel;
use App\Models\Affiliates;
use App\Models\BankDetail;
use App\Models\OjafunnelNotification;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
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
        $result = curl_exec($ch);

        return $result;
    }

    public function transaction_confirm($response, $amount)
    {
        $user = User::findorfail(Auth::user()->id);

        $user->update([
            'wallet' => $user->wallet + $amount
        ]);

        $levels = AffiliateLevel::all();

        if (Auth::user()->referral_link) {
            $affiliates = Affiliates::where('referral_id', Auth::user()->id)->get();

            foreach ($affiliates as $affiliate) {
                if (!empty($affiliate->bonus)) {
                    continue; // Skip processing if bonus is not empty
                }

                $level = $levels->where('level', $affiliate->level)->first();

                if ($level) {
                    $earnings = $level->bonus_percent * $amount / 100;

                    $affiliate->update([
                        'bonus' => $earnings
                    ]);

                    $user_wallet = User::find($affiliate->referrer_id);
                    if ($user_wallet) {
                        $user_wallet->update([
                            'wallet' => $user_wallet->wallet + $earnings,
                            'ref_bonus' => $user_wallet->ref_bonus + $earnings,
                        ]);
                    }
                }
            }
        }

        Transaction::create([
            'user_id' => $user->id,
            'amount' => '₦'.$amount,
            'reference' => $response,
            'status' => 'Top Up'
        ]);

        OjafunnelNotification::create([
            'to' => Auth::user()->id,
            'title' => config('app.name'),
            'body' => 'Your ' . config('app.name') . ' account has been funded ₦' . $amount . '.'
        ]);

        $user = User::where('id', Auth::user()->id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        $this->fcm('Your ' . config('app.name') . ' account has been funded ₦' . $amount . '.', $user);

        return back()->with([
            'type' => 'success',
            'message' => 'Deposited successfully.'
        ]);
    }

    private function paystack_handler($url)
    {

        $curl = curl_init();


        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            return null;
        }

        return $response;
    }

    private function get_bank_by_id($bank_id, $data) {
        $banks = (object) json_decode($data, true);
        $bank_list = $banks->data;
        $result = null;
        foreach($bank_list as $bk) {
            $needle = (object) $bk;
            if($needle->id == $bank_id) {
                $result = $needle;
                break;
            }
        }

        return $result;
    }

    public function add_bank_information(Request $request)
    {
        $messages = [
            'bank_code.required' => 'Bank is required.',
        ];

        //Validate Request
        $this->validate($request, [
            'account_number' => ['required', 'numeric', 'digits:10'],
            'bank_code' => ['required', 'numeric']
        ], $messages);

        $bankInformations = BankDetail::where('user_id', Auth::user()->id)->get();

        if ($bankInformations->count() == 10) {
            return back()->with([
                'type' => 'danger',
                'message' => 'You are not allowed to enter more than ten(10) payment methods.'
            ]);
        }

        $get_data = null;

        $get_data = $this->paystack_handler("https://api.paystack.co/bank/resolve?account_number=$request->account_number&bank_code=$request->bank_code");
        $response = (Object) json_decode($get_data, true);
        if ($response->status) {
            $response = $response->data;

            $banks = $this->paystack_handler("https://api.paystack.co/bank");
            $result_bank = $this->get_bank_by_id($response['bank_id'], $banks);
            $response['Bank_name'] = $result_bank->name;
            $response['bank_code'] = $result_bank->code;
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => 'Something went wrong while resolving account details.'
            ]);
        }


        try {
            // $get_data = Http::get('https://maylancer.org/api/nuban/api.php?account_number=' . $request->account_number . '&bank_code=' . $request->bank_code);
            // $response = json_decode($get_data, true);

            // dd($response['account_name']);
            // dd(strtoupper(Auth::user()->first_name) . ' ' . Auth::user()->last_name);

            if (isset($response['account_name'])) {
                if (Str::contains($response['account_name'], strtoupper(Auth::user()->first_name))) {
                    if (Str::contains($response['account_name'], strtoupper(Auth::user()->last_name))) {
                        if ($bankInformations->isEmpty()) {
                            BankDetail::create([
                                'user_id' => Auth::user()->id,
                                'type' => 'NGN',
                                'account_name' => $response['account_name'],
                                'account_number' => $response['account_number'],
                                'bank_name' => $response['Bank_name'],
                                'bank_code' => $response['bank_code'],
                                'status' => 'Active'
                            ]);

                            return back()->with([
                                'type' => 'success',
                                'message' => 'Payment method added successfully.'
                            ]);
                        } else {
                            foreach ($bankInformations as $bank) {
                                $bank_number[] = $bank->account_number;
                            }
                            if (in_array($response['account_number'], $bank_number)) {
                                return back()->with([
                                    'type' => 'danger',
                                    'message' => 'Payment method added before.'
                                ]);
                            } else {
                                BankDetail::create([
                                    'user_id' => Auth::user()->id,
                                    'type' => 'NGN',
                                    'account_name' => $response['account_name'],
                                    'account_number' => $response['account_number'],
                                    'bank_name' => $response['Bank_name'],
                                    'bank_code' => $response['bank_code'],
                                    'status' => 'Active'
                                ]);

                                return back()->with([
                                    'type' => 'success',
                                    'message' => 'Payment method added successfully.'
                                ]);
                            }
                        }
                    } else {
                        return back()->with([
                            'type' => 'danger',
                            'message' => 'Account Name must be the same name on your Account.'
                        ]);
                    }
                } else {
                    return back()->with([
                        'type' => 'danger',
                        'message' => 'Account Name must be the same name on your Account.'
                    ]);
                }
            } else {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Invalid account number entered, ' . $response['message']
                ]);
            }
        } catch (Exception $e) {
            return back()->with([
                'type' => 'danger',
                'message' => 'This service is currently unavailable. Please try again.'
            ]);
        }
    }

    public function delete_bank_information($id)
    {
        $idFinder = Crypt::decrypt($id);

        $bank = BankDetail::findorfail($idFinder);

        $bank->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Bank Details deleted successfully!'
        ]);
    }

    public function add_us_bank_information(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'account_name' => ['required', 'string'],
            'type_of_bank_account' => ['required'],
            'routing_number' => ['required', 'string'],
            'account_number' => ['required', 'string', 'confirmed']
        ]);

        $bankInformations = BankDetail::where('user_id', Auth::user()->id)->get();

        if ($bankInformations->count() == 10) {
            return back()->with([
                'type' => 'danger',
                'message' => 'You are not allowed to enter more than ten(10) payment methods.'
            ]);
        }

        if ($bankInformations->isEmpty()) {
            BankDetail::create([
                'user_id' => Auth::user()->id,
                'type' => 'US',
                'account_name' => $request->account_name,
                'type_of_bank_account' => $request->type_of_bank_account,
                'routing_number' => $request->routing_number,
                'account_number' => $request->account_number,
                'status' => 'Active'
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Payment method added successfully.'
            ]);
        } else {
            foreach ($bankInformations as $bank) {
                $bank_number[] = $bank->account_number;
            }
            if (in_array($request->account_number, $bank_number)) {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Payment method added before.'
                ]);
            } else {
                BankDetail::create([
                    'user_id' => Auth::user()->id,
                    'type' => 'US',
                    'account_name' => $request->account_name,
                    'type_of_bank_account' => $request->type_of_bank_account,
                    'routing_number' => $request->routing_number,
                    'account_number' => $request->account_number,
                    'status' => 'Active'
                ]);

                return back()->with([
                    'type' => 'success',
                    'message' => 'Payment method added successfully.'
                ]);
            }
        }
    }

    public function update_bank_information($id, Request $request)
    {
        $idFinder = Crypt::decrypt($id);

        $bank = BankDetail::find($idFinder);

        if ($request->account_number == $bank->account_number) {
            //Validate Request
            $this->validate($request, [
                'account_name' => ['required', 'string'],
                'type_of_bank_account' => ['required'],
                'routing_number' => ['required', 'string'],
            ]);
        } else {
            //Validate Request
            $this->validate($request, [
                'account_name' => ['required', 'string'],
                'type_of_bank_account' => ['required'],
                'routing_number' => ['required', 'string'],
                'account_number' => ['required', 'string', 'confirmed']
            ]);
        }

        $bankInformations = BankDetail::where('user_id', Auth::user()->id)->get();

        if ($bankInformations->count() == 10) {
            return back()->with([
                'type' => 'danger',
                'message' => 'You are not allowed to enter more than ten(10) payment methods.'
            ]);
        }

        // if($bankInformations->isEmpty())
        // {
        $bank->update([
            'account_name' => $request->account_name,
            'type_of_bank_account' => $request->type_of_bank_account,
            'routing_number' => $request->routing_number,
            'account_number' => $request->account_number,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Payment method updated successfully.'
        ]);
        // } else {
        //     foreach ($bankInformations as $bank) {
        //         $bank_number[] = $bank->account_number;
        //     }
        //     if (in_array($request->account_number, $bank_number)) {
        //         return back()->with([
        //             'type' => 'danger',
        //             'message' => 'Details added before.'
        //         ]);
        //     } else {
        //         $bank->update([
        //             'account_name' => $request->account_name,
        //             'type_of_bank_account' => $request->type_of_bank_account,
        //             'routing_number' => $request->routing_number,
        //             'account_number' => $request->account_number,
        //         ]);

        //         return back()->with([
        //             'type' => 'success',
        //             'message' => 'Details updated successfully.'
        //         ]);
        //     }
        // }
    }

    public function add_paystack(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'account_name' => ['required', 'string'],
            'secret_key' => ['required'],
            'public_key' => ['required', 'string'],
        ]);

        $bankInformations = BankDetail::where('user_id', Auth::user()->id)->get();

        if ($bankInformations->count() == 10) {
            return back()->with([
                'type' => 'danger',
                'message' => 'You are not allowed to enter more than ten(10) payment methods.'
            ]);
        }

        if ($bankInformations->isEmpty()) {
            BankDetail::create([
                'user_id' => Auth::user()->id,
                'type' => 'PAYSTACK',
                'account_name' => $request->account_name,
                'secret_key' => $request->secret_key,
                'public_key' => $request->public_key,
                'status' => 'Active'
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Payment method added successfully.'
            ]);
        } else {
            foreach ($bankInformations as $bank) {
                $public_key[] = $bank->public_key;
            }
            if (in_array($request->public_key, $public_key)) {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Payment method added before.'
                ]);
            } else {
                BankDetail::create([
                    'user_id' => Auth::user()->id,
                    'type' => 'PAYSTACK',
                    'account_name' => $request->account_name,
                    'secret_key' => $request->secret_key,
                    'public_key' => $request->public_key,
                    'status' => 'Active'
                ]);

                return back()->with([
                    'type' => 'success',
                    'message' => 'Payment method added successfully.'
                ]);
            }
        }
    }

    public function update_paystack($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'account_name' => ['required', 'string'],
            'secret_key' => ['required'],
            'public_key' => ['required', 'string'],
        ]);

        $idFinder = Crypt::decrypt($id);

        $bank = BankDetail::find($idFinder);

        $bank->update([
            'account_name' => $request->account_name,
            'secret_key' => $request->secret_key,
            'public_key' => $request->public_key,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Payment method updated successfully.'
        ]);
    }

    public function withdraw(Request $request)
    {
        // /Validate Request
        $this->validate($request, [
            'wallet' => ['required'],
            'amount' => ['required', 'numeric'],
            'payment_method' => ['required'],
        ]);

        if($request->wallet == 'Naira')
        {
            if (request()->amount > Auth::user()->wallet) {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Amount entered is greater than your Naira Wallet Balance!'
                ]);
            }
        } else {
            if (request()->amount > Auth::user()->dollar_wallet) {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Amount entered is greater than your Dollar Wallet Balance!'
                ]);
            }
        }

        $bank = BankDetail::where('user_id', Auth::user()->id)->get();

        if ($bank->isEmpty()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'No Bank details added, add bank details and try again.',
            ]);
        } else {
            $user = User::findorfail(Auth::user()->id);
            if($request->wallet == 'Naira')
            {
                $user->wallet -= $request->amount;
            } else {
                $user->dollar_wallet -= $request->amount;
            }
            $user->save();

            $withdraw = Withdrawal::create([
                'wallet' => $request->wallet,
                'user_id' => Auth::user()->id,
                'payment_method' => $request->payment_method,
                'amount' => $request->amount
            ]);

            $administrator = Admin::latest()->first();

            // send withdraw email notification here
            Mail::to($administrator->email)->send(new AdminWithdrawnNotification(Auth::user(), $withdraw->amount));
            Mail::to(Auth::user()->email)->send(new UserWithdrawnNotification(Auth::user(), $withdraw->amount));

            OjafunnelNotification::create([
                'to' => Auth::user()->id,
                'title' => config('app.name'),
                'body' => 'Withdrawal request of ₦' . $withdraw->amount . '.',
            ]);

            OjafunnelNotification::create([
                'admin_id' => $administrator->id,
                'title' => config('app.name'),
                'body' => Auth::user()->first_name . ' ' . Auth::user()->last_name . ' request a withdrawal of ₦' . $withdraw->amount,
            ]);

            $user = User::where('id', Auth::user()->id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            $admin = Admin::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            $this->fcm('Withdrawal request of ₦' . $withdraw->amount . '.', $user);
            $this->fcm(Auth::user()->first_name . ' ' . Auth::user()->last_name . ' request a withdrawal of ₦' . $withdraw->amount, $admin);


            return back()->with([
                'type' => 'success',
                'message' => 'Wallet Withdrawal Successfully!'
            ]);
        }
    }

    public function delete_withdraw($id)
    {
        $idFinder = Crypt::decrypt($id);

        $withdraw = Withdrawal::findorfail($idFinder);

        if ($withdraw->status == 'created') {
            $user = User::find($withdraw->user_id);

            if($withdraw->wallet == 'Naira')
            {
                $user->wallet += $withdraw->amount;
            } else {
                $user->dollar_wallet += $withdraw->amount;
            }
            $user->save();

            $withdraw->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Withdrawal request deleted successfully!'
            ]);
        }

        return back()->with([
            'type' => 'danger',
            'message' => 'Cannot delete this withdrawal request!'
        ]);
    }
}
