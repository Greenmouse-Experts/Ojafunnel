<?php

namespace App\Http\Controllers;

use App\Mail\AdminWithdrawnNotification;
use App\Models\Admin;
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

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $amount,
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

        try {
            $get_data = Http::get('https://maylancer.org/api/nuban/api.php?account_number=' . $request->account_number . '&bank_code=' . $request->bank_code);
            $response = json_decode($get_data, true);

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
                                'bank_code' => $response['bank_code']
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
                                    'bank_code' => $response['bank_code']
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
            'amount' => ['required', 'numeric'],
            'payment_method' => ['required'],
        ]);

        if (request()->amount > Auth::user()->wallet) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Amount entered is greater than your Wallet Balance!'
            ]);
        }

        $bank = BankDetail::where('user_id', Auth::user()->id)->get();

        if ($bank->isEmpty()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'No Bank details added, add bank details and try again.',
            ]);
        } else {
            $user = User::findorfail(Auth::user()->id);

            $withdraw = Withdrawal::create([
                'user_id' => Auth::user()->id,
                'payment_method' => $request->payment_method,
                'amount' => $request->amount
            ]);

            $user->wallet -= $request->amount;
            $user->save();

            $administrator = Admin::latest()->first();

            // send withdraw email notification here
            Mail::to($administrator->email)->send(new AdminWithdrawnNotification($user, $withdraw->amount));
            Mail::to($user->email)->send(new AdminWithdrawnNotification($user, $withdraw->amount));

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

            $user->wallet += $withdraw->amount;
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
