<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        
    }

    public function dashboard()
    {
        if(!Session::get('AuthAccessToken')){
            return redirect()->route('login')->with([
                'type' => 'danger',
                'message' => "Please login with valid details"
            ]);
        }
        return view('dashboard.dashboard');
    }

    public function email_checker()
    {
        return view('dashboard.emailChecker');
    }

    public function email_campaign()
    {
        return view('dashboard.emailCampaign');
    }

    public function email_design()
    {
        return view('dashboard.emailDesign');
    }

    public function email_automation()
    {
        return view('dashboard.emailAutomation');
    }

    public function automation_campaign()
    {
        return view('dashboard.automationCampaign');
    }

    public function mailing_list()
    {
        return view('dashboard.mailingList');
    }

    public function create_message()
    {
        return view('dashboard.createMessage');
    }

    public function view_message()
    {
        return view('dashboard.viewMessage');
    }

    public function page_builder()
    {
        return view('dashboard.pageBuilder');
    }

    public function sms_automation()
    {
        return view('dashboard.smsAutomation');
    }

    public function whatsapp_automation()
    {
        return view('dashboard.whatsappAutomation');
    }

    public function my_store()
    {
        return view('dashboard.myStore');
    }

    public function create_course()
    {
        return view('dashboard.createCourse');
    }

    public function affiliate_marketing()
    {
        return view('dashboard.affiliateMarketing');
    }

    public function integration()
    {
        return view('dashboard.integration');
    }

    public function reports_analysis()
    {
        return view('dashboard.reportsAnalysis');
    }

    public function help()
    {
        return view('dashboard.help');
    }

    public function general()
    {
        return view('dashboard.generalSettings');
    }

    public function security()
    {
        return view('dashboard.securitySettings');
    }
}
