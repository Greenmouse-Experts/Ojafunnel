<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    
    public function dashboard($username)
    {
        return view('dashboard.dashboard', [
            'username' => $username
        ]);
    }

    public function email_checker($username)
    {
        return view('dashboard.emailChecker', [
            'username' => $username
        ]);
    }

    public function email_campaign($username)
    {
        return view('dashboard.emailCampaign', [
            'username' => $username
        ]);
    }
    public function email_Ecampaign($username)
    {
        return view('dashboard.EemailCampaign', [
            'username' => $username
        ]);
    }
    public function email_layout($username)
    {
        return view('dashboard.emaillayout', [
            'username' => $username
        ]);
    }
    public function email_code($username)
    {
        return view('dashboard.emailcode', [
            'username' => $username
        ]);
    }
    public function email_design($username)
    {
        return view('dashboard.emailDesign', [
            'username' => $username
        ]);
    }
    public function email_preview($username)
    {
        return view('dashboard.emailpreview', [
            'username' => $username
        ]);
    }
    public function email_automation($username)
    {
        return view('dashboard.emailAutomation', [
            'username' => $username
        ]);
    }
    public function edit_template($username)
    {
        return view('dashboard.editemplate', [
            'username' => $username
        ]);
    }
    public function automation_campaign($username)
    {
        return view('dashboard.automationCampaign', [
            'username' => $username
        ]);
    }

    public function mailing_list($username)
    {
        return view('dashboard.mailingList', [
            'username' => $username
        ]);
    }

    public function add_contact($username)
    {
        return view('dashboard.addcontact', [
            'username' => $username
        ]);
    }

    public function copy_paste($username)
    {
        return view('dashboard.copypaste', [
            'username' => $username
        ]);
    }

    public function upload($username)
    {
        return view('dashboard.upload', [
            'username' => $username
        ]);
    }
   
    public function create_message($username)
    {
        return view('dashboard.createMessage', [
            'username' => $username
        ]);
    }

    public function view_message($username)
    {
        return view('dashboard.viewMessage', [
            'username' => $username
        ]);
    }

    public function choose_temp($username)
    {
        return view('dashboard.funnelBuilder', [
            'username' => $username
        ]);
    }

    public function use_template($username)
    {
        return view('dashboard.useTemplate', [
            'username' => $username
        ]);
    }

    public function product_recall($username)
    {
        return view('dashboard.productRecall', [
            'username' => $username
        ]);
    }

    public function take_quiz($username)
    {
        return view('dashboard.takeQuiz', [
            'username' => $username
        ]);
    }

    public function face_shape($username)
    {
        return view('dashboard.faceShape', [
            'username' => $username
        ]);
    }

    public function choose_diamond($username)
    {
        return view('dashboard.chooseDiamond', [
            'username' => $username
        ]);
    }

    public function final_step($username)
    {
        return view('dashboard.finalStep', [
            'username' => $username
        ]);
    }

    public function page_builder($username)
    {
        return view('dashboard.pageBuilder', [
            'username' => $username
        ]);
    }

    public function sms_automation($username)
    {
        return view('dashboard.smsAutomation', [
            'username' => $username
        ]);
    }

    public function newsms($username)
    {
        return view('dashboard.newsms', [
            'username' => $username
        ]);
    }

    public function whatsapp_automation($username)
    {
        return view('dashboard.whatsappAutomation', [
            'username' => $username
        ]);
    }

    public function sendbroadcast($username)
    {
        return view('dashboard.sendbroadcast', [
            'username' => $username
        ]);
    }

    public function my_store($username)
    {
        return view('dashboard.myStore', [
            'username' => $username
        ]);
    }

    public function viewstore($username)
    {
        return view('dashboard.checkstore', [
            'username' => $username
        ]);
    }

    public function store($username)
    {
        return view('dashboard.mystoree', [
            'username' => $username
        ]);
    }

    public function create_course($username)
    {
        return view('dashboard.createCourse', [
            'username' => $username
        ]);
    }

    public function course_content($username)
    {
        return view('dashboard.coursecontent', [
            'username' => $username
        ]);
    }

    public function get_quiz($username)
    {
        return view('dashboard.getquiz', [
            'username' => $username
        ]);
    }

    public function course_summary($username)
    {
        return view('dashboard.coursesummary', [
            'username' => $username
        ]);
    }

    public function enroll_now($username)
    {
        return view('dashboard.enrollcourse', [
            'username' => $username
        ]);
    }

    public function enroll_cur($username)
    {
        return view('dashboard.enrollcur', [
            'username' => $username
        ]);
    }

    public function affiliate_marketing($username)
    {
        $referrals = User::where('referral_link', Auth::user()->id)->get();

        return view('dashboard.affiliateMarketing', [
            'referrals' => $referrals,
            'username' => $username
        ]);
    }

    public function integration($username)
    {
        return view('dashboard.integration', [
            'username' => $username
        ]);
    }

    public function reports_analysis($username)
    {
        return view('dashboard.reportsAnalysis', [
            'username' => $username
        ]);
    }

    public function help($username)
    {
        return view('dashboard.help', [
            'username' => $username
        ]);
    }

    public function general($username)
    {
        return view('dashboard.generalSettings', [
            'username' => $username
        ]);
    }

    public function security($username)
    {
        return view('dashboard.securitySettings', [
            'username' => $username
        ]);
    }
}
