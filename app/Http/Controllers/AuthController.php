<?php

namespace App\Http\Controllers;

use App\Mail\SendCodeResetPassword;
use App\Models\Affiliates;
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
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            'password' => ['required', 'string', 'min:1'],
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

        // authentication attempt
        if (auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password']))) {

            if (!$user->email_verified_at) {
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
            }

            if ($user->status == 'inactive') {

                Auth::logout();

                return back()->with([
                    'type' => 'danger',
                    'message' => 'Account inactive, please contact administrator.'
                ]);
            }


            if ($user->user_type == 'User') {
                // Retrieve timezone from the user model
                $timezone =  $user->customer->timezone ?? 'UTC';

                // Set timezone in user's session (optional)
                session(['timezone' => $timezone]);

                // Set timezone in Laravel configuration
                Config::set('app.timezone', $timezone);

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
        return view('builder.optin-page');
        // return view('test');
    }

    public function copyText(Request $request)
    {
        $text = $request->get('text');

        return response()->json(['text' => $text]);
    }

    public function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Make a request to the debounce API for each email address
        $response = Http::get('https://api.debounce.io/v1/', [
            'api' => config('app.debounce_key'),
            'email' => trim($request->email), // Trim any leading/trailing whitespace
            // Add any other parameters required by the API
        ]);

        // Check if the request was successful
        if ($response->successful()) {
            // Process the response data
            $data = $response->json();

            // Add the debounce data to the result array
            $result = $data;
        } else {
            // Handle the error
            $result = ['error' => 'Failed to validate email address'];
        }

        return response()->json([
            'success' => true,
            'message' => 'Email addresse validated successfully.',
            'data' => $result
        ]);
    }
}
