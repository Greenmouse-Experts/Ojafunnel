<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use App\Models\Mailinglist;
use App\Models\Page;
use App\Models\Plan;
use App\Models\SmsAutomation;
use App\Models\Subscriber;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tzsk\Sms\Facades\Sms;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
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

    public function dashboard()
    {
        return view('dashboard.dashboard');
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
        $mailinglists = Mailinglist::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.mailingList', [
            'username' => $username,
            'mailinglists' => $mailinglists
        ]);
    }

    public function contact($username, $id)
    {
        $idFinder = Crypt::decrypt($id);

        $mailinglist = Mailinglist::findorfail($idFinder);

        $contacts = Subscriber::latest()->where('mailinglist_id', $mailinglist->id)->get();

        return view('dashboard.contact', [
            'username' => $username,
            'contacts' => $contacts,
            'mailinglist' => $mailinglist
        ]);
    }

    public function add_contact($username, $id)
    {
        $idFinder = Crypt::decrypt($id);

        $mailinglist = Mailinglist::findorfail($idFinder);

        return view('dashboard.addcontact', [
            'username' => $username,
            'mailinglist' => $mailinglist
        ]);
    }

    public function copy_paste($username, $id)
    {
        $idFinder = Crypt::decrypt($id);

        $mailinglist = Mailinglist::findorfail($idFinder);

        return view('dashboard.copypaste', [
            'username' => $username,
            'mailinglist' => $mailinglist
        ]);
    }

    public function upload($username, $id)
    {
        $idFinder = Crypt::decrypt($id);

        $mailinglist = Mailinglist::findorfail($idFinder);

        return view('dashboard.upload', [
            'username' => $username,
            'mailinglist' => $mailinglist
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

    public function upgrade($username)
    {
        $user = User::findorfail(Auth::user()->id);

        $plan = Plan::where('id', $user->plan)->first();
        $plans = Plan::latest()->get();

        return view('dashboard.upgrade', [
            'username' => $username,
            'plan' => $plan,
            'plans' => $plans
        ]);
    }

    public function upgrade_account($username, $id, $amount)
    {
        $id = Crypt::decrypt($id);
        $amount = Crypt::decrypt($amount);

        $user = User::findorfail(Auth::user()->id);
        $plan = Plan::where('id', $id)->first();

        return view('dashboard.makePayment', [
            'amount' => $amount,
            'user' => $user,
            'plan' => $plan
        ]);
    }

    public function transaction($username)
    {
        $transactions = Transaction::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.transaction', [
            'username' => $username,
            'transactions' => $transactions
        ]);
    }

    public function subscription($username)
    {
        return view('dashboard.subscription', [
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

    public function pay($username)
    {
        return view('dashboard.pay', [
            'username' => $username
        ]);
    }

    public function congratulation($username)
    {
        return view('dashboard.congratulation', [
            'username' => $username
        ]);
    }

    
    public function page_builder($username)
    {
        $pages = Page::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.pageBuilder', [
            'username' => $username,
            'pages' => $pages
        ]);
    }

    public function sms_automation($username)
    {
        $smsAutomations = SmsAutomation::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.smsAutomation', [
            'username' => $username,
            'smsAutomations' => $smsAutomations
        ]);
    }

    public function newsms($username)
    {
        $mailinglists = Mailinglist::latest()->where('user_id', Auth::user()->id)->get();
        $integrations = Integration::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.newsms', [
            'username' => $username,
            'mailinglists' => $mailinglists,
            'integrations' => $integrations
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

    public function manage_integration($username)
    {
        $integrations = Integration::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.manageintegration', [
            'username' =>$username,
            'integrations' => $integrations
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

    public function test()
    {
        // if(auth()->check()) dd('success');
        // dd(config('sms.drivers.twilio.sid'));

        // $number1 = '+2348161215848';
        // $number2 = '+2348161215848';
        // try {
        //     $sms = Sms::via('twilio')->send("Testing Ojafunnel SMS Automation Using Twilio")->to([$number1, $number2])->dispatch();
        //     dd($sms);
        // } catch(Exception $e) {
        //     dd($e);
        // } 

        /*
            Sending messages using our API
            Requirements - PHP, cURL (enabled) function
        */



        // Initialize variables ( set your variables here )

        $username = 'promiseezema11@gmail.com';

        $password = 'password';

        $sender   = '08161215848';
        $message  = 'This is a test message.';

        // Separate multiple numbers by comma

        $mobiles  = '23481';

        // Set your domain's API URL

        $api_url  = 'http://domain.com/api/';


        //Create the message data

        $data = array('username' => $username, 'password' => $password, 'sender' => $sender, 'message' => $message, 'mobiles' => $mobiles);

        //URL encode the message data

        $data = http_build_query($data);

        //Send the message

        $ch = curl_init(); // Initialize a cURL connection

        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);

        $result = json_decode($result);


        if (isset($result->status) && strtoupper($result->status) == 'OK') {
            // Message sent successfully, do anything here

            echo 'Message sent at N' . $result->price;
        } else if (isset($result->error)) {
            // Message failed, check reason.

            echo 'Message failed - error: ' . $result->error;
        } else {
            // Could not determine the message response.

            echo 'Unable to process request';
        }
    }
}
