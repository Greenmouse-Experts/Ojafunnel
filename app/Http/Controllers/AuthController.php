<?php

namespace App\Http\Controllers;

use App\Mail\SendCodeResetPassword;
use App\Models\Customer;
use App\Models\OjafunnelNotification;
use App\Models\OjaPlan;
use App\Models\Plan;
use App\Models\ResetCodePassword;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\SendMagicLinkNotification;
use App\Notifications\SendVerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Aws\Sns\SnsClient;      //// Import this package

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $customer = Customer::newCustomer();

        $user = new User();
        if (!empty($request->old())) {
            $customer->fill($request->old());
            $user->fill($request->old());
        }

        // save posted data
        if ($request->isMethod('post')) {
            $user->fill($request->all());
            $rules = $user->registerRules();

            // Captcha check
            // if (\Acelle\Model\Setting::get('registration_recaptcha') == 'yes') {
            //     $success = \Acelle\Library\Tool::checkReCaptcha($request);
            //     if (!$success) {
            //         $rules['recaptcha_invalid'] = 'required';
            //     }
            // }

            $this->validate($request, $rules);

            $plan = OjaPlan::where('name', 'Free')->first();
            // Okay, create it
            if ($plan) {
                $user = $customer->createAccountAndUser($request);
            } else {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Admin yet to add plans! Try again later.'
                ])->withInput();
            }

            // user email verification
            if (true) {
                // Send registration confirmation email
                try {
                    $code = mt_rand(100000, 999999);

                    $user->update([
                        'code' => $code
                    ]);

                    // Send email to user
                    $user->notify(new SendVerificationCode($user));

                    return redirect()->route('verify.account', Crypt::encrypt($user->email))->with([
                        'type' => 'success',
                        'message' => 'Registration Successful, Please verify your account!'
                    ]);
                } catch (\Exception $e) {
                    // return view('somethingWentWrong', ['message' => trans('messages.something_went_wrong_with_email_service') . ": " . $e->getMessage()]);
                    return redirect()->route('verify.account', Crypt::encrypt($user->email))->with([
                        'type' => 'success',
                        'message' => 'Registration Successful, Please verify your account!'
                    ]);
                }

                //return view('users.register_confirmation_notice');

                // no email verification
            } else {
                $user->setActivated();
                return redirect()->route('login');
            }
        }
        // $messages = [
        //     'username.regex' => 'Username must not have space in between',
        //     // 'password.regex' => 'Password must be more than 8 characters long, should contain at least 1 Uppercase, 1 Lowercase and  1 number',
        // ];

        // $this->validate($request, [
        //     'first_name' => ['required', 'string', 'max:255'],
        //     'last_name' => ['required', 'string', 'max:255'],
        //     'username' => ['required', 'min:5', 'max:100', 'regex:/^\S*$/u', 'unique:users'],
        //     'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
        //     'phone_number' => ['required', 'numeric'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     // 'g-recaptcha-response' => 'required|captcha',
        // ], $messages);

        // if(!$request->referral_link == null)
        // {
        //     $this->validate($request, [
        //         'referral_link' => 'exists:users,affiliate_link'
        //     ]);

        //     $referrer_id = User::where('affiliate_link', $request->referral_link)->first();

        //     $plan = OjaPlan::where('name', 'Free')->first();

        //     if($plan)
        //     {
        //         $user = User::create([
        //             'user_type' => 'User',
        //             'affiliate_link' => $this->referrer_id_generate(9),
        //             'first_name' => $request->first_name,
        //             'last_name' => $request->last_name,
        //             'username' => strtolower($request->username),
        //             'email' => $request->email,
        //             'phone_number' => $request->phone_number,
        //             'password' => Hash ::make($request->password),
        //             'referral_link' => $referrer_id->id,
        //             'plan' => $plan->id
        //         ]);

        //         $subscribe_amount = 10000;
        //         $array = User::all();
        //         $parent = $user->id;

        //         $this->getAncestors($array, $subscribe_amount, $parent);

        //     } else {
        //         return back()->with([
        //             'type' => 'danger',
        //             'message' => 'Admin yet to add plans! Try again later.'
        //         ]);
        //     }

        // } else {
        //     $plan = OjaPlan::where('name', 'Free')->first();

        //     if($plan)
        //     {
        //         $user = User::create([
        //             'user_type' => 'User',
        //             'affiliate_link' => $this->referrer_id_generate(7),
        //             'first_name' => $request->first_name,
        //             'last_name' => $request->last_name,
        //             'username' => strtolower($request->username),
        //             'email' => $request->email,
        //             'phone_number' => $request->phone_number,
        //             'password' => Hash ::make($request->password),
        //             'referral_link' => $request->referral_link,
        //             'plan' => $plan->id
        //         ]);
        //     } else {
        //         return back()->with([
        //             'type' => 'danger',
        //             'message' => 'Admin yet to add plans! Try again later.'
        //         ]);
        //     }
        // }

        // $code = mt_rand(100000, 999999);

        // $user->update([
        //     'code' => $code
        // ]);

        // // Send email to user
        // $user->notify(new SendVerificationCode($user));

        // return redirect()->route('verify.account', Crypt::encrypt($user->email))->with([
        //     'type' => 'success',
        //     'message' => 'Registration Successful, Please verify your account!'
        // ]);
    }

    function referrer_id_generate($input, $strength = 9)
    {
        $input = '01234567899876543210';
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    function getAncestors($array, $deposit_amount, $parent = 0, $level = 1)
    {
        $referedMembers = '';
        $parent = User::where('id', $parent)->first();
        foreach ($array as $entry) {
            if ($entry->id == $parent->referral_link) {
                if ($level == 1) {
                    $earnings = 30 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    $user_wallet = User::where('id', $entry->id)->first();
                    User::where('id', $entry->id)
                        ->update([
                            'wallet' => $user_wallet->wallet + $earnings,
                            'ref_bonus' => $user_wallet->ref_bonus + $earnings,
                        ]);
                    //create history
                    Transaction::create([
                        'user_id' => $entry->id,
                        'amount' => $earnings,
                        'reference' => 'referralbonus',
                        'status' => 'Referral Bonus',
                    ]);
                    OjafunnelNotification::create([
                        'to' => $entry->id,
                        'title' => config('app.name'),
                        'body' => 'A user just registered using your referral link.'
                    ]);
                } elseif ($level == 2) {
                    $earnings = 10 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    $user_wallet = User::where('id', $entry->id)->first();
                    User::where('id', $entry->id)
                        ->update([
                            'wallet' => $user_wallet->wallet + $earnings,
                            'ref_bonus' => $user_wallet->ref_bonus + $earnings,
                        ]);
                    //create history
                    Transaction::create([
                        'user_id' => $entry->id,
                        'amount' => $earnings,
                        'reference' => 'referralbonus',
                        'status' => 'Referral Bonus',
                    ]);
                    OjafunnelNotification::create([
                        'to' => $entry->id,
                        'title' => config('app.name'),
                        'body' => 'A user just registered using your referral link.'
                    ]);
                } elseif ($level == 3) {
                    $earnings = 5 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    $user_wallet = User::where('id', $entry->id)->first();
                    User::where('id', $entry->id)
                        ->update([
                            'wallet' => $user_wallet->wallet + $earnings,
                            'ref_bonus' => $user_wallet->ref_bonus + $earnings,
                        ]);
                    //create history
                    Transaction::create([
                        'user_id' => $entry->id,
                        'amount' => $earnings,
                        'reference' => 'referralbonus',
                        'status' => 'Referral Bonus',
                    ]);
                    OjafunnelNotification::create([
                        'to' => $entry->id,
                        'title' => config('app.name'),
                        'body' => 'A user just registered using your referral link.'
                    ]);
                } elseif ($level == 4) {
                    //dd('here4');
                    $earnings = 5 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    $user_wallet = User::where('id', $entry->id)->first();
                    User::where('id', $entry->id)
                        ->update([
                            'wallet' => $user_wallet->wallet + $earnings,
                            'ref_bonus' => $user_wallet->ref_bonus + $earnings,
                        ]);
                    //create history
                    Transaction::create([
                        'user_id' => $entry->id,
                        'amount' => $earnings,
                        'reference' => 'referralbonus',
                        'status' => 'Referral Bonus',
                    ]);
                    OjafunnelNotification::create([
                        'to' => $entry->id,
                        'title' => config('app.name'),
                        'body' => 'A user just registered using your referral link.'
                    ]);
                }

                if ($level == 5) {
                    break;
                }

                //$referedMembers .= '- ' . $entry->name . '- Level: '. $level. '- Commission: '.$earnings.'<br/>';
                $referedMembers .= $this->getAncestors($array, $deposit_amount, $entry->id, $level + 1);
            }
        }

        return $referedMembers;
    }

    public function verify_account($email)
    {
        $userFinder = Crypt::decrypt($email);

        $user = User::where('email', $userFinder)->first();

        return view('auth.verify_account', [
            'user' => $user
        ]);
    }

    public function email_verify_resend($email)
    {
        $email = Crypt::decrypt($email);

        $user = User::where('email', $email)->first();

        $code = mt_rand(100000, 999999);

        $user->update([
            'code' => $code
        ]);

        // Send email to user
        $user->notify(new SendVerificationCode($user));

        return back()->with([
            'type' => 'success',
            'message' => 'A fresh verification code has been sent to your email address.'
        ]);
    }

    public function registerConfirm($token, Request $request)
    {
        $userfinder = Crypt::decrypt($token);

        $user = User::find($userfinder);

        $this->validate($request, [
            'code' => ['required', 'numeric']
        ]);

        if ($user->code == $request->code) {
            $user->email_verified_at = now();
            $user->code = null;
            $user->save();

            return redirect()->route('login')->with([
                'type' => 'success',
                'message' => 'Account Verified, proceed to login!'
            ]);
        }

        return back()->with([
            'type' => 'danger',
            'message' => 'Incorrect Code'
        ]);
    }

    public function user_login(Request $request)
    {
        if ($request->input('submit') == 'magic-link') {
            $user = $this->loginViaMagicLink($request);

            if (!$user) {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'User with this username/email does not exist.'
                ]);
            }

            return back()->with([
                'type' => 'success',
                'message' => 'Magic Link Sent to the registered email ID.'
            ]);
        }

        $this->validate($request, [
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            // 'g-recaptcha-response' => 'required|captcha',
        ]);

        $input = $request->only(['email', 'password']);

        $user = User::query()->where('email', $request->email)
            ->orWhere('username', $request->email)->first();

        if ($user && !Hash::check($request->password, $user->password)) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Incorrect Password!'
            ]);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with([
                'type' => 'danger',
                'message' => "Email/Username doesn't exist"
            ]);
        }

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        // if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))

        // authentication attempt
        if (auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password']))) {

            /* if (!$user->email_verified_at) {
                $code = mt_rand(100000, 999999);
                $user->update([
                    'code' => $code
                ]);
                // Send email to user
                $user->notify(new SendVerificationCode($user));

                return redirect()->route('verify.account', Crypt::encrypt($user->email))->with([
                    'type' => 'success',
                    'message' => 'Registration Successful, Please verify your account!'
                ]);
            } */

            if ($user->status == 'inactive') {

                Auth::logout();

                return back()->with([
                    'type' => 'danger',
                    'message' => 'Account inactive, please contact administrator.'
                ]);
            }


            if ($user->user_type == 'User') {
                return redirect()->route('user.dashboard', $user->username);
            }

            Auth::logout();


            return back()->with([
                'type' => 'danger',
                'message' => 'You are not a User.'
            ]);
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => 'User authentication failed.'
            ]);
        }
    }

    public function loginViaMagicLink(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'max:255'],
        ]);

        $user = User::where('email', $request->email)
            ->orWhere('username', $request->email)->first();

        if ($user) {
            $user->notify(new SendMagicLinkNotification($user));
        }

        return $user;
    }

    public function forget()
    {
        return view('auth.forget');
    }

    public function forget_password(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users',
        ]);

        $user = User::where('email', $request->email)->first();

        // Delete all old code that user send before.
        ResetCodePassword::where('email', $request->email)->delete();

        // Generate random code
        $code = mt_rand(100000, 999999);

        // Create a new code
        $codeData = ResetCodePassword::create([
            'email' => $request->email,
            'code' => $code
        ]);

        // Send email to user
        
        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));

        return redirect()->route('user.reset.password', Crypt::encrypt($user->email))->with([
            'type' => 'success',
            'message' => 'We have emailed your password reset code!'
        ]);
    }

    public function password_reset_email($email)
    {
        $email = Crypt::decrypt($email);

        return view('auth.reset_password', [
            'email' => $email
        ]);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (ResetCodePassword::where('code', '=', $request->code)->exists()) {
            // find the code
            $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

            // check if it does not expired: the time is one hour
            if ($passwordReset->created_at > now()->addHour()) {
                $passwordReset->delete();

                return back()->with([
                    'type' => 'danger',
                    'message' => 'Password reset code expired'
                ]);
            }

            // find user's email
            $user = User::firstWhere('email', $passwordReset->email);

            // update user password
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            // delete current code
            $passwordReset->delete();

            return redirect()->route('login')->with([
                'type' => 'success',
                'message' => 'Password has been successfully reset, Please login'
            ]);
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => "Code doesn't exist in our database"
            ]);
        }
    }

    public function adminlogin()
    {
        return view('auth.admin');
    }

    public function post_admin_login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $input = $request->only(['email', 'password']);

        $user = User::query()->where('email', $request->email)->first();

        if ($user && !Hash::check($request->password, $user->password)) {
            return back()->with('failure_report', 'Incorrect Password!');
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('failure_report', 'Email does\'nt exist');
        }

        // authentication attempt
        if (auth()->attempt($input)) {
            if ($user->user_type == 'Administrator') {
                return redirect()->route('admin.dashboard');
            }

            return back()->with('failure_report', 'You are not an Administrator');
        } else {
            return back()->with('failure_report', 'User authentication failed.');
        }
    }

    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('/');
    }

    public function text()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://api.smslive247.com/api/v4/sms', [
        'body' => '{
            "senderID":"Ojaa",
            "messageText":"Welcome home",
            "mobileNumber":"+2348161215848",
            "route":"web"
        }',
        'headers' => [
            'Authorization' => 'MA-d1081d4c-4068-465b-b7d9-6a3e91963748',
            'accept' => 'application/json',
            'content-type' => 'application/*+json',
        ],
        ]);


        return $response;
    }
}
