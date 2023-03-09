<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\ContactUs;
use App\Models\Customer;
use App\Models\OjafunnelNotification;
use App\Models\OjaPlan;
use App\Models\Page;
use App\Models\Plan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tzsk\Sms\Facades\Sms;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;

class HomePageController extends Controller
{
    //
    public function index()
    {
        return view('frontend.index');
    }
    //  Faqs
    public function faqs()
    {
        return view('frontend.faqs');
    }

    //  Pring
    public function pricing()
    {
        $plans = OjaPlan::latest()->get();

        return view('frontend.pricing', [
            'plans' => $plans
        ]);
    }

    // Contact-Us
    public function contact()
    {
        return view('frontend.contact');
    }
    // Login
    public function login()
    {
        Auth::logout();

        return view('auth.login');
    }
    // Sign Up
    public function signup()
    {
        $customer = Customer::newCustomer();
        $user = new User();
        if (request()->has('ref')) {
            session(['referrer' => request()->query('ref')]);
        }

        $referrer = User::whereaffiliate_link(session()->pull('referrer'))->first();

        $referrer_id = $referrer ? $referrer->affiliate_link : null;

        return view('auth.signup', compact('referrer_id', 'customer', 'user'));
    }
    // Email Verification
    public function emailverification()
    {
        return view('auth.emailverification');
    }
    // Forgot
    public function forgot()
    {
        return view('auth.forgot');
    }
    // ResetPassword
    public function resetpassword()
    {
        return view('auth.reset');
    }
    // Market Automation
    public function marketauto()
    {
        return view('frontend.marketauto');
    }
    // Pgae Builder
    public function pagebuilder()
    {
        return view('frontend.pagebuilder');
    }
    // Privacy
    public function privacy()
    {
        return view('frontend.privacy');
    }
    // Terms
    public function terms()
    {
        return view('frontend.terms');
    }
    // EmailMarketing
    public function emailmarketing()
    {
        return view('frontend.emailmarketing');
    }
    // Chat Automation
    public function chatautomation()
    {
        return view('frontend.chatautomation');
    }
    // Ecommerce
    public function ecommerce()
    {
        return view('frontend.Ecommerce');
    }
    // Funnel Builder
    public function funnelbuilder()
    {
        return view('frontend.FunnelBuilder');
    }

    // Affiliate Marketing
    public function affiliate()
    {
        return view('frontend.AffiliateMarketing');
    }

    // Integration
    public function integrations()
    {
        return view('frontend.Integration');
    }

    // Template Design
    public function template()
    {
        return view('frontend.template');
    }
    public function template_details($id)
    {
        $idFinder = Crypt::decrypt($id);
        
        $page = Page::find($idFinder);

        return view('frontend.templateDetail', [
            'page' => $page
        ]);
    }
    // See Demo
    public function demo()
    {
        return view('frontend.SeeDemo');
    }
    public function test()
    {
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://9r3xk3.api.infobip.com/sms/2/text/advanced',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{"messages":[{"destinations":[{"to":"08161215848"}],"from":"Ojafunnel","text":"This is a sample message"}]}',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: {3e299022a25c9eb6c26d79bc0850dca3-39356585-14ef-4e9b-8e89-23ea015a616c}',
                    'Content-Type: application/json',
                    'Accept: application/json'
                ),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        dd($response);
    }

    public function contactConfirm(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'phone' => 'required|numeric',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $contact = ContactUs::create([
            'name' => request()->name,
            'email' => request()->email,
            'phone_number' => request()->phone,
            'subject' => request()->subject,
            'message' => request()->message,
        ]);

        $admin = Admin::latest()->first();

        OjafunnelNotification::create([
            'admin_id' => $admin->id,
            'title' => config('app.name'),
            'body' => $contact->name . ' sent a contact us form.'
        ]);

        $firebaseToken = Admin::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

        $SERVER_API_KEY = config('app.fcm_token');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => config('app.name'),
                "body" => 'Contact form submitted by ' . $contact->name,
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
        curl_exec($ch);

        return back()->with([
            'type' => 'success',
            'message' => 'Form submitted successfully, we will get back to you shortly.'
        ]);
    }
}
