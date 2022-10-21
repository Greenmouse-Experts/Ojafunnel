<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
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
    public function email_Ecampaign()
    {
        return view('dashboard.EemailCampaign');
    }
    public function email_layout()
    {
        return view('dashboard.emaillayout');
    }
    public function email_code()
    {
        return view('dashboard.emailcode');
    }
    public function email_design()
    {
        return view('dashboard.emailDesign');
    }
    public function email_preview()
    {
        return view('dashboard.emailpreview');
    }
    public function email_automation()
    {
        return view('dashboard.emailAutomation');
    }
    public function edit_template()
    {
        return view('dashboard.editemplate');
    }
    public function automation_campaign()
    {
        return view('dashboard.automationCampaign');
    }

    public function mailing_list()
    {
        return view('dashboard.mailingList');
    }

    public function add_contact()
    {
        return view('dashboard.addcontact');
    }

    public function copy_paste()
    {
        return view('dashboard.copypaste');
    }

    public function upload()
    {
        return view('dashboard.upload');
    }
   
    public function create_message()
    {
        return view('dashboard.createMessage');
    }

    public function view_message()
    {
        return view('dashboard.viewMessage');
    }

    public function choose_temp()
    {
        return view('dashboard.funnelBuilder');
    }

    public function use_template()
    {
        return view('dashboard.useTemplate');
    }

    public function product_recall()
    {
        return view('dashboard.productRecall');
    }

    public function take_quiz()
    {
        return view('dashboard.takeQuiz');
    }

    public function face_shape()
    {
        return view('dashboard.faceShape');
    }

    public function choose_diamond()
    {
        return view('dashboard.chooseDiamond');
    }

    public function final_step()
    {
        return view('dashboard.finalStep');
    }

    public function page_builder()
    {
        return view('dashboard.pageBuilder');
    }

    public function sms_automation()
    {
        return view('dashboard.smsAutomation');
    }

    public function newsms()
    {
        return view('dashboard.newsms');
    }

    public function whatsapp_automation()
    {
        return view('dashboard.whatsappAutomation');
    }

    public function sendbroadcast()
    {
        return view('dashboard.sendbroadcast');
    }

    public function my_store()
    {
        return view('dashboard.myStore');
    }

    public function viewstore()
    {
        return view('dashboard.checkstore');
    }

    public function store()
    {
        return view('dashboard.mystoree');
    }

    public function create_course()
    {
        return view('dashboard.createCourse');
    }

    public function course_content()
    {
        return view('dashboard.coursecontent');
    }

    public function get_quiz()
    {
        return view('dashboard.getquiz');
    }

    public function course_summary()
    {
        return view('dashboard.coursesummary');
    }

    public function enroll_now()
    {
        return view('dashboard.enrollcourse');
    }

    public function enroll_cur()
    {
        return view('dashboard.enrollcur');
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
