<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('auth.login');
    }
    // Sign In
    public function signup()
    {
        return view('auth.signup');
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
     // emailverify
     public function emailverify()
     {
         return view('auth.veriyemail');
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
}