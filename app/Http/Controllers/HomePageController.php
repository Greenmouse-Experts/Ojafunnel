<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tzsk\Sms\Facades\Sms;

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
        if (request()->has('ref')) {
            session(['referrer' => request()->query('ref')]);
        }

        $referrer = User::whereaffiliate_link(session()->pull('referrer'))->first();
         
        $referrer_id = $referrer ? $referrer->affiliate_link : null;

        return view('auth.signup', compact('referrer_id'));
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

    public function test()
    {
        $number1 = '+2348161215848';
        $number2 = '+2348161215848';
        try {
            $sms = Sms::via('twilio')->send("Testing Ojafunnel SMS Automation Using Twilio")->to([$number1, $number2])->dispatch();
            dd($sms);
        } catch(Exception $e) {
            dd($e);
        } 


        $email = "your multitexter registered email "; 
        $password = "Your password"; 
        $message = "message content"; 
        $sender_name = "Your sender name"; 
        $recipients = "mobile numbers seperated by comma e.9 2348028828288,234900002000,234808887800"; 
        $forcednd = "set to 1 if you want DND numbers to "; 
        $data = array(
            "email" => $email, 
            "password" => $password,
            "message"=>$message, 
            "sender_name" => $sender_name,
            "recipients" => $recipients,
            "forcednd" => $forcednd
        ); 
        $data_string = json_encode($data); 
        $ch = curl_init('https://app.multitexter.com/v2/app/sms'); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string))); 
        $result = curl_exec($ch); 
        $res_array = json_decode($result); 
        print_r($res_array); 
    }
}