<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Chat;
use App\Models\Course;
use App\Models\Funnel;
use App\Models\FunnelPage;
use App\Models\Integration;
use App\Models\Mailinglist;
use App\Models\OjaPlan;
use App\Models\Page;
use App\Models\PersonalChatroom;
use App\Models\Plan;
use App\Models\Shop;
use App\Models\ShopOrder;
use App\Models\SmsAutomation;
use App\Models\SmsCampaign;
use App\Models\StoreOrder;
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

    public function list_performance($username)
    {
        return view('dashboard.listPerformance', [
            'username' => $username
        ]);
    }

    public function list_setting($username)
    {
        return view('dashboard.listSetting', [
            'username' => $username
        ]);
    }

    public function new_subscribers($username)
    {
        return view('dashboard.newSubscribers', [
            'username' => $username
        ]);
    }

    public function create_list($username)
    {
        return view('dashboard.list', [
            'username' => $username
        ]);
    }

    public function view_list($username)
    {
        return view('dashboard.viewList', [
            'username' => $username
        ]);
    }

    public function list_subscribers($username)
    {
        return view('dashboard.listSubscribers', [
            'username' => $username
        ]);
    }

    public function import_subscribers($username)
    {
        return view('dashboard.ImportSubscribers', [
            'username' => $username
        ]);
    }

    public function export_subscribers($username)
    {
        return view('dashboard.exportSubscribers', [
            'username' => $username
        ]);
    }

    public function segments($username)
    {
        return view('dashboard.Segments', [
            'username' => $username
        ]);
    }

    public function create_segments($username)
    {
        return view('dashboard.createSegment', [
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

        $plan = OjaPlan::where('id', $user->plan)->first();
        $plans = OjaPlan::latest()->get();

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
        $funnels = Funnel::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.funnelBuilder', [
            'username' => $username,
            'funnels' => $funnels
        ]);
    }

    public function view_funnel_pages($username, $id)
    {
        $id = Crypt::decrypt($id);

        $funnel = Funnel::findorfail($id);
        $pages = FunnelPage::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.viewFunnelPage', [
            'username' => $username,
            'funnel' => $funnel,
            'pages' => $pages
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
        $smsAutomations = SmsCampaign::latest()->where('user_id', Auth::user()->id)->where('sms_type', 'plain')->cursor();

        return view('dashboard.smsAutomation', [
            'username' => $username,
            'smsAutomations' => $smsAutomations
        ]);
    }

    public function newsms($username)
    {
        $contact_lists = \App\Models\ContactList::where('user_id', Auth::user()->id)->get();
        $integrations = Integration::latest()->where('user_id', Auth::user()->id)->get();
        return view('dashboard.newsms', [
            'username' => $username,
            'contact_lists' => $contact_lists,
            'integrations' => $integrations
        ]);
    }

    public function contact_list(Request $request)
    {
        $contact_lists = \App\Models\ContactList::latest()->where('user_id', Auth::user()->id)->cursor();

        if ($request->isMethod('post')) {
            $c = new \App\Models\ContactList();
            $c->name = $request->name;
            $c->user_id = Auth::user()->id;
            $c->status = $request->status;
            $c->save();

            return back()->with([
                'type' => 'success',
                'message' => 'Contact List Created.'
            ]);
        } else {
            return view('dashboard.contact.list', compact('contact_lists'));
        }

    }

    public function contact_list_update(Request $request)
    {
        $contact_lists = \App\Models\ContactList::latest()->where('user_id', Auth::user()->id)->cursor();

        if ($request->isMethod('post')) {
            $c = \App\Models\ContactList::findOrFail($request->list_id);
            $c->name = $request->name;
            $c->user_id = Auth::user()->id;
            $c->status = $request->status;
            $c->update();

            return back()->with([
                'type' => 'success',
                'message' => 'Contact List updated.'
            ]);
        } else {
            return view('dashboard.contact.list', compact('contact_lists'));
        }

    }

    public function contact_list_delete(Request $request)
    {


        if ($request->isMethod('post')) {
            $contact_num = \App\Models\ContactNumber::where('contact_list_id', $request->list_id)->delete();
            $c = \App\Models\ContactList::findOrFail($request->list_id);
            $c->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Contact List deleted.'
            ]);
        } else {
            return view('dashboard.contact.list', compact('contact_lists'));
        }

    }

    public function add_contact_to_list(Request $request)
    {
        $contact = \App\Models\ContactNumber::latest()->where('contact_list_id', $request->list_id)->cursor();
        $list_id = $request->list_id;
        if ($request->isMethod('post')) {
            $c = new \App\Models\ContactNumber();
            $c->phone_number = $request->phone_no;
            $c->contact_list_id = $request->list_id;
            $c->status = 'subscribed';
            $c->save();

            return back()->with([
                'type' => 'success',
                'message' => 'Contact Added Successfully.'
            ]);
        } else {
            return view('dashboard.contact.contact_number', compact('contact', 'list_id'));
        }

    }

    public function update_contact_num(Request $request)
    {

        if ($request->isMethod('post')) {
            $c = \App\Models\ContactNumber::findOrFail($request->contact_id);
            $c->phone_number = $request->phone_no;
            $c->status = $request->status;
            $c->update();

            return back()->with([
                'type' => 'success',
                'message' => 'Contact Updated Successfully.'
            ]);
        } else {
            return view('dashboard.contact.contact_number', compact('contact', 'list_id'));
        }

    }

    public function delete_contact_num(Request $request)
    {

        if ($request->isMethod('post')) {
            $c = \App\Models\ContactNumber::findOrFail($request->contact_id)->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Contact Deleted Successfully.'
            ]);
        } else {
            return view('dashboard.contact.contact_number', compact('contact', 'list_id'));
        }

    }

    public function whatsapp_automation($username)
    {
        $whatsappAutomations = SmsCampaign::latest()->where('user_id', Auth::user()->id)->where('sms_type', 'whatsapp')->cursor();
        return view('dashboard.whatsappAutomation', [
            'username' => $username,
            'whatsappAutomations' => $whatsappAutomations
        ]);
    }

    public function sendbroadcast($username)
    {
        $contact_lists = \App\Models\ContactList::where('user_id', Auth::user()->id)->get();
        $integrations = Integration::latest()->where('user_id', Auth::user()->id)->get();
        return view('dashboard.sendbroadcast', [
            'username' => $username,
            'contact_lists' => $contact_lists,
            'integrations' => $integrations
        ]);
    }

    public function sentcampaigns($username)
    {
        return view('dashboard.SentCampaign', [
            'username' => $username
        ]);
    }

    public function receive_message($username)
    {
        return view('dashboard.ReceiveMessage', [
            'username' => $username
        ]);
    }

    public function auto_reply($username)
    {
        return view('dashboard.AutoReply', [
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

    public function shops($username)
    {
        return view('dashboard.Shops', [
            'username' => $username
        ]);
    }


    public function checkout($username)
    {
        return view('dashboard.Checkout', [
            'username' => $username
        ]);
    }

    public function cart($username)
    {
        return view('dashboard.Cart', [
            'username' => $username
        ]);
    }

    public function stores($username)
    {
        return view('dashboard.mystoree', [
            'username' => $username
        ]);
    }

    public function create_course($username)
    {
        return view('dashboard.lms.createCourse', [
            'username' => $username
        ]);
    }

    public function shop($username)
    {
        return view('dashboard.lms.ShopCourse', [
            'username' => $username
        ]);
    }

    public function view_cart($username)
    {
        return view('dashboard.lms.AddCart', [
            'username' => $username
        ]);
    }

    public function courses_details($username)
    {
        return view('dashboard.lms.Details', [
            'username' => $username
        ]);
    }

    public function create_course_start($username)
    {
        $categories = Category::latest()->get();
        return view('dashboard.lms.coursestart', [
            'username' => $username,
            'categories' => $categories
        ]);
    }

    public function course_content($username, $id)
    {
        $idFinder = Crypt::decrypt($id);

        $course = Course::find($idFinder);

        return view('dashboard.lms.coursecontent', [
            'username' => $username,
            'course' => $course
        ]);
    }

    public function create_shop($username)
    {
        return view('dashboard.lms.createshop', [
            'username' => $username
        ]);
    }

    public function my_cart($username)
    {
        return view('dashboard.lms.MyCart', [
            'username' => $username
        ]);
    }

    public function view_course_details($username, Request $request)
    {
        $course = Course::find($request->id);

        return view('dashboard.lms.viewcoursedetails', [
            'username' => $username,
            'course' => $course
        ]);
    }

    public function course_details($username)
    {
        return view('dashboard.lms.coursedetails', [
            'username' => $username
        ]);
    }

    public function main_promo($username)
    {
        return view('dashboard.promotion.Product', [
            'username' => $username
        ]);
    }

    public function view_shops($username)
    {
        $shop = Shop::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.lms.checkShops', compact('username', 'shop'));
    }

    public function view_enrollments($username, Request $reequest)
    {
        $shop = Shop::latest()->where('user_id', Auth::user()->id)->first();

        return view('dashboard.lms.view_enrollments', compact('username', 'shop'));
    }

    public function my_shops($username)
    {
        $shop = Shop::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.lms.myShops', compact('username', 'shop'));
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
            'username' => $username,
            'integrations' => $integrations
        ]);
    }

    public function reports_analysis($username)
    {
        $coursePurchase = Transaction::where('user_id', Auth::user()->id)->where('status', 'Course Purchase')->get()->count();
        $referralBonus = Transaction::where('user_id', Auth::user()->id)->where('status', 'Referral Bonus')->get()->count();
        $productPurchase = Transaction::where('user_id', Auth::user()->id)->where('status', 'Product Purchase')->get()->count();
        $topUp = Transaction::where('user_id', Auth::user()->id)->where('status', 'Top Up')->get()->count();

        return view('dashboard.reportsAnalysis', [
            'coursePurchase' => $coursePurchase,
            'referralBonus' => $referralBonus,
            'productPurchase' => $productPurchase,
            'topUp' => $topUp,
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


    public function main_notify($username)
    {
        return view('dashboard.notification', [
            'username' => $username
        ]);
    }

    public function main_sales($username)
    {
        $store = \App\Models\Store::where('user_id', Auth::user()->id)->first();
        $shop = \App\Models\Shop::where('user_id', Auth::user()->id)->first();

        if($store != null)
        {
            $storeOrderCount = StoreOrder::where('store_id', $store->id)->get()->count();
        } else {
            $storeOrderCount = 0;
        }

        if($shop != null)
        {
            $shopOrderCount = ShopOrder::where('shop_id', $shop->id)->get()->count();
        } else {
            $shopOrderCount = 0;
        }

        return view('dashboard.salesAnalytics', [
            'username' => $username,
            'storeOrderCount' => $storeOrderCount,
            'shopOrderCount' => $shopOrderCount
        ]);
    }

    public function main_support($username)
    {
        return view('dashboard.support.supportMain', [
            'username' => $username
        ]);
    }

    public function support_chat($username)
    {
        return view('dashboard.support.chat', [
            'username' => $username,
        ]);
    }

    public function support_email($username)
    {
        return view('dashboard.support.emailMain', [
            'username' => $username
        ]);
    }

    public function getdownlines($array, $parent = 0, $level = 1)
    {
        $referedMembers = '';
        foreach ($array as $key => $entry) {
            if ($entry->referral_link == $parent) {

                if ($level == 1) {
                    $levelQuote = "Direct Referral";
                } else {
                    $levelQuote = "Indirect Referral";
                }

                $referedMembers .= "
              <tr>
              <td> $key </td>
              <td> $entry->first_name $entry->last_name</td>
              <td> $levelQuote </td>" .
                    '<td><a href="javascript: void(0);" class="badge badge-soft-primary font-size-11 m-1">' . "Tier " . $level . "</a></td>" .
                    '<td>' . "10%" . '</td>' .
                    '<td>' . $this->getUserParent($entry->id) . '</td>' .
                    '<td>' . $this->getUserStatus($entry->id) . '</td>
              <td>' . $this->getUserRegDate($entry->id) . '</td>
              </tr>';

                $referedMembers .= $this->getdownlines($array, $entry->id, $level + 1);
            }

            if ($level == 5) {
                break;
            }
        }
        return $referedMembers;
    }

    public function saveToken(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->update([
            'fcm_token' => $request->token
        ]);

        return response()->json(['Token successfully stored.']);
    }

    //Get user Parent
    function getUserParent($id)
    {
        $user = User::where('id', $id)->first();
        $parent = User::where('id', $user->referral_link)->first();
        if ($parent) {
            return "$parent->first_name $parent->last_name";
        } else {
            return "null";
        }
    }

    function getUserStatus($id)
    {
        $user = User::where('id', $id)->first();

        return $user->status;
    }

    function getUserRegDate($id)
    {
        $user = User::where('id', $id)->first();

        return $user->created_at;
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

        $sender = '08161215848';
        $message = 'This is a test message.';

        // Separate multiple numbers by comma

        $mobiles = '23481';

        // Set your domain's API URL

        $api_url = 'http://domain.com/api/';


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
