<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\DemoVideo;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Shop;
use App\Models\User;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Funnel;
use App\Models\FunnelCategory;
use App\Models\CurrencyRate;
use App\Models\Message;
use App\Models\OjaPlan;
use App\Models\Category;
use App\Models\EmailKit;
use App\Models\ContactUs;
use App\Models\Broadcast;
use App\Models\OrderItem;
use App\Models\ShopOrder;
use App\Models\FunnelPage;
use App\Models\Newsletter;
use App\Models\StoreOrder;
use App\Models\Withdrawal;
use App\Models\MessageUser;
use App\Models\SmsCampaign;
use App\Models\Transaction;
use App\Models\WaCampaigns;
use App\Models\SiteFeature;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\StoreProduct;
use Illuminate\Http\Request;
use App\Models\EmailCampaign;
use App\Models\WhatsappNumber;
use App\Models\OjaPlanInterval;
use App\Models\WhatsappSupport;
use App\Models\OjaPlanParameter;
use App\Models\ReplyMailSupport;
use App\Models\BirthdayAutomation;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Jobs\SendBroadcastEmail;
use App\Models\ListManagement;
use App\Models\ListManagementContact;
use App\Models\OjafunnelMailSupport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\OjafunnelNotification;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Mail\UserApprovedWithdrawNotification;
use App\Mail\BroadcastEmail;
use App\Mail\SubscriptionExpiryNotifyAdmin;
use App\Mail\AdminApprovedWithdrawNotification;
use App\Mail\UserApprovedNotification;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use App\Models\Customer;
use Twilio\Rest\Client as twilio;
use Exception;
use GuzzleHttp\Client;
use Aws\Sns\SnsClient;
use App\Mail\AccountInfoMail;
use App\Mail\NewsletterMail;
use App\Models\AffiliateBonus;
use App\Models\AffiliateLevel;
use App\Models\Affiliates;
use App\Models\ExplainerContent;
use App\Models\GeneralExchangeRate;
use App\Models\OjaSubscription;
use App\Models\PaymentGateway;
use App\Models\UpsellPageSubmission;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{

    public function __construct(){
        $this->all_emails = [];
    }

    public function profile_update(Request $request)
    {
        $ad = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $ad->name = $request->name;
        $ad->backup_amt = $request->backup_amt;
        $ad->months_nonactive_user = $request->months;

        $ad->update();
        return back()->with([
            'type' => 'success',
            'message' => 'Admin Profile Updated.'
        ]);
    }

    public function changePassword(Request $request)
    {
        //$ad = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, Auth::guard('admin')->user()->password)) {
            return back()->with([
                'type' => 'success',
                "message",
                "Old Password Doesn't match!"
            ]);
        }


        #Update the new Password
        Admin::whereId(Auth::guard('admin')->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Admin password changed successfully!.'
        ]);
    }

    public function dashboard()
    {
        return view('Admin.adminwelcome');
    }

    public function view_users()
    {
        $data['site_features'] = SiteFeature::get();
        $all_users = User::latest()->get();

        $selected_fts = "";
        foreach($all_users as $user){
            $feature_access = explode(",", $user->feature_access);
            $user->fts = SiteFeature::whereIN('id', $feature_access)->get(['features']);
        }
        $data['all_users'] = $all_users;
        return view('Admin.user.view-users', $data);
    }

    public function user_login($id)
    {
        $user = Auth::loginUsingId($id);

        return redirect()->route('user.dashboard', $user->username);
    }

    public function users_details()
    {
        return view('Admin.user.users-details');
    }

    public function add_plans()
    {
        return view('Admin.add-plans');
    }

    public function manage_plans()
    {
        return view('Admin.manage-plans');
    }

    public function viewmessage()
    {
        return view('Admin.viewmessages');
    }

    public function all_transactions()
    {
        return view('Admin.all_transactions');
    }

    public function recent_transactions()
    {
        return view('Admin.recent_transactions');
    }

    public function subscriptions()
    {
        return view('Admin.subscription.subscriptions');
    }

    public function unscribers()
    {
        return view('Admin.subscription.unscribers');
    }

    public function security()
    {
        return view('Admin.securitySettings');
    }

    public function general()
    {
        return view('Admin.generalSettings');
    }


    public function subscribtions()
    {

        return view('Admin.subscription.subscriptions');
    }

    public function vendorlist()
    {
        return view('Admin.vendorList');
    }

    public function trans_details()
    {
        return view('Admin.TransDetails');
    }

    public function affiliateList()
    {
        $affiliates = Affiliates::latest()->get();

        return view('Admin.affiliateList', [
            'affiliates' => $affiliates
        ]);
    }

    public function affiliateLevel()
    {
        $levels = AffiliateLevel::latest()->get();

        return view('Admin.affiliate.index', [
            'levels' => $levels
        ]);
    }

    public function create_affiliateLevel(Request $request)
    {
        $request->validate([
            'level' => 'required|integer',
            'bonus_percent' => 'required|numeric',
        ]);

        AffiliateLevel::create($request->all());

        return back()->with([
            'type' => 'success',
            'message' => 'Affiliate level created successfully'
        ]);

    }

    public function update_affiliateLevel(Request $request, $id)
    {
        $request->validate([
            'level' => 'required|integer',
            'bonus_percent' => 'required|numeric',
        ]);

        $finder = decrypt($id);

        $affiliate = AffiliateLevel::find($finder);

        $affiliate->update($request->all());

        return back()->with([
            'type' => 'success',
            'message' => 'Affiliate level updated successfully'
        ]);
    }

    public function delete_affiliateLevel($affiliatelevel)
    {
        $finder = decrypt($affiliatelevel);

        AffiliateLevel::find($finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Affiliate level deleted successfully'
        ]);

    }

    public function product()
    {
        return view('Admin.product');
    }

    public function addProduct()
    {
        return view('Admin.addProduct');
    }

    public function product_detail($id)
    {
        $product = StoreProduct::findOrFail($id);
        return view('Admin.ecommerce.productDetail', compact('product'));
    }

    public function viewCart()
    {
        return view('Admin.viewCart');
    }

    public function view_course()
    {
        return view('Admin.lms.courses');
    }


    public function view_shop()
    {
        return view('Admin.lms.viewShop');
    }


    public function view_category()
    {
        return view('Admin.lms.category');
    }

    public function course_detail($id)
    {
        $finder = Crypt::decrypt($id);
        $course = Course::find($finder);

        return view('Admin.lms.viewCourse', [
            'course' => $course
        ]);
    }

    public function store_list()
    {
        return view('Admin.ecommerce.storeList');
    }

    public function product_list()
    {
        return view('Admin.ecommerce.productList');
    }

    public function sales_list()
    {
        return view('Admin.ecommerce.salesList');
    }

    public function sales_details($id)
    {
        $order = StoreOrder::findOrFail($id);
        return view('Admin.ecommerce.salesDetail', compact('order'));
    }

    public function page_builder()
    {
        return view('Admin.pageBuilder');
    }

    public function funnel_builder()
    {
        $funnels = Funnel::latest()->get();

        return view('Admin.funnelBuilder', [
            'funnels' => $funnels
        ]);
    }

    public function view_funnel_pages($id)
    {
        $id = Crypt::decrypt($id);

        $funnel = Funnel::findorfail($id);

        $pages = FunnelPage::latest()->where(['folder_id' => $funnel->id])->get();

        return view('Admin.funnelBuilder-view', [
            'funnel' => $funnel,
            'pages' => $pages
        ]);
    }

    public function funnel_builder_categories()
    {
        $categories = FunnelCategory::latest()->get();

        return view('Admin.funnelBuilderCategory', [
            'categories' => $categories
        ]);
    }

    public function funnel_category_create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        FunnelCategory::create(['name' => $request->name]);

        return back()->with([
            'type' => 'success',
            'message' => 'Funnel category created successfully.',
        ]);
    }

    public function funnel_category_delete($id, Request $request)
    {
        $id = Crypt::decrypt($id);
        try {
            FunnelCategory::where(['id' => $id])
            ->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Funnel category created successfully.',
            ]);
        } catch(\Exception $e) {
            return back()->with([
                'type' => 'success',
                'message' => 'Funnel category already in use - cannot be deleted.',
            ]);
        }
    }

    public function email_support()
    {
        return view('Admin.support.emailSupport');
    }

    public function broadcast()
    {
        $lists = ListManagement::latest()->get();

        // $list_tags = "";
        // foreach($lists as $list){
        //     if($list->tags !== null){
        //         $list_tags .= $list->tags.",";
        //     }
        // }
        // $list_tags = str_replace(", ", ",", $list_tags);
        // $list_tags = array_unique(explode(',', $list_tags));

        // $arrs=[];
        // foreach($list_tags as $list_tag){
        //     if($list_tag !== ""){
        //         $arrs[] = $list_tag;
        //     }
        // }
        // $data['tags'] = $arrs;
        $data['lists'] = ListManagement::where('status', 1)->get();
        return view('Admin.broadcast', $data);
    }


    public function priviledges()
    {
        $data['site_features'] = SiteFeature::get();
        return view('Admin.priviledges', $data);
    }


    public function validate_user_emails(Request $request)
    {
        $ABSTRACTAPI = env('ABSTRACTAPI');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://emailvalidation.abstractapi.com/v1/?api_key=$ABSTRACTAPI&email=$request->email");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $data = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($data, true);

        session()->push('hidden_emails', $data['email']);
        session()->push('hidden_deliverability', $data['deliverability']);

        $hidden_emails = session()->get('hidden_emails');
        $hidden_deliverability = session()->get('hidden_deliverability');

        $results = "";

        $results .= '<table class="email_status">
            <tr>
                <th>Sn</th>
                <th>Email</th>
                <th>Status</th>
            </tr>';

        if(count($hidden_emails) > 0){
            $k=1;
            foreach($hidden_emails as $index => $hidden_email){
                $status = strtolower($hidden_deliverability[$index]) == "deliverable" ? "Active" : "Not Active";
                $results .= "<tr>
                    <td>$k</td>
                    <td>$hidden_email</td>
                    <td>$status</td>
                </tr>";
                $k++;
            }
        }
        $results .= "</table>";
        return $results;
    }

    public function fetch_referrals(Request $request)
    {
        $rules = [
            'user_id' => 'required',
        ];
        $validator = \Validator::make($request->all(), $rules)->stopOnFirstFailure(true);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->all(),
            ],200);
        }
        $results = "";
        $results .= '<table class="referral_tbl">
            <tr>
                <th>Sn</th>
                <th>Users</th>
                <th>Email</th>
                <th>Date</th>
            </tr>';

        $referrals = \App\Models\Referral::where('user', $request->user_id)->whereRaw("referred IN (SELECT id FROM users)")->get();

        if(count($referrals) > 0){
            $k=1;
            foreach($referrals as $referral){
                $customers = User::select('first_name', 'last_name', 'email')->where('id', $referral->referred)->first();
                $dates = \App\Models\Referral::where('user', $request->user_id)->value('created_at');

                $fullnames = ucwords($customers->first_name." ".$customers->last_name);
                if($customers && strlen($fullnames) < 4){
                    $fullnames = "Not specified";
                }
                $email = $customers->email;
                if($customers && strlen($email) < 4){
                    $email = "Not specified";
                }

                $results .= "<tr>
                    <td>$k</td>
                    <td>".$fullnames."</td>
                    <td>".$email."</td>
                    <td>".date("D jS, M Y h:ia", strtotime($dates))."</td>
                </tr>";
                $k++;
            }
        }
        $results .= "</table>";
        return $results;
    }

    public function get_users_prvd(Request $request)
    {
        $rules = [
            'user_id' => 'required',
        ];
        $validator = \Validator::make($request->all(), $rules)->stopOnFirstFailure(true);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->all(),
            ],200);
        }
        $site_features = User::where('id', $request->user_id)->first();
        $user_fts = explode(",", $site_features->feature_access);
        $site_features = SiteFeature::select('id', 'features')->get();

        $results = "";
        $results .= '<select name="features[]" multiple class="input select_features">
            <option value=""></option>';
            if(count($site_features) > 0){
                foreach($site_features as $feature){
                    $selected = in_array($feature->id, $user_fts) ? "selected" : "";
                    $results .= '<option value="'.$feature->id.'" '.$selected.'>'.$feature->features.'</option>';
                }
            }
        $results .= '</select>';
        return $results;
    }


    public function clrs(Request $request)
    {
        // Get the list of emails from the form
        $emailString = $request->input('emails');

        // Split the input string into an array of email addresses
        $emails = explode(',', $emailString);

        $results = [];

        // Iterate over each email address
        foreach ($emails as $email) {
            // Make a request to the debounce API for each email address
            $response = Http::get('https://api.debounce.io/v1/', [
                'api' => config('app.debounce_key'),
                'email' => trim($email), // Trim any leading/trailing whitespace
                // Add any other parameters required by the API
            ]);

            // Check if the request was successful
            if ($response->successful()) {
                // Process the response data
                $data = $response->json();
                // Extract the debounce data for the current email address
                $debounceData = $data['debounce'];
                // Add the debounce data to the results array
                $results[] = $data;
            } else {
                // Handle the error
                $results[] = ['error' => 'Failed to validate email address'];
            }
        }

        // Return the response as JSON
        return response()->json([
            'success' => true,
            'message' => 'Email addresses validated successfully.',
            'data' => $results
        ]);
    }

    public function reply_email_support($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'message' => ['required', 'string'],
        ]);

        $finder = Crypt::decrypt($id);
        $MailSupport = OjafunnelMailSupport::findorfail($finder);

        ReplyMailSupport::create([
            'mail_id' => $MailSupport->id,
            'user_id' => $MailSupport->user_id,
            'admin_id' => Auth::guard('admin')->user()->id,
            'title' => 'Reply',
            'body' => $request->message,
            'replied_by' => 'admin',
        ]);

        /** Store information to include in mail in $data as an array */
        $data = array(
            'name' => User::find($MailSupport->user_id)->first_name.' '.User::find($MailSupport->user_id)->first_name,
            'email' => User::find($MailSupport->user_id)->email,
            'title' => config('app.name'),
            'body' => $request->message
        );

        /** Send message to the user */
        Mail::send('emails.email_support', $data, function ($m) use ($data) {
            $m->to($data['email'])->subject(config('app.name'));
        });


        return back()->with([
            'type' => 'success',
            'message' => 'Message replied successfully.',
        ]);
    }

    public function send_email_to_user(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $user = User::find($request->name);

        OjafunnelMailSupport::create([
            'user_id' => $user->id,
            'admin_id' => Auth::guard('admin')->user()->id,
            'title' => $request->subject,
            'body' => $request->message,
            'by_who' => 'Administrator'
        ]);

        /** Store information to include in mail in $data as an array */
        // $data = array(
        //     'name' => User::find($user->user_id)->first_name.' '.User::find($user->user_id)->first_name,
        //     'email' => User::find($user->user_id)->email,
        //     'title' => config('app.name'),
        //     'body' => $request->message
        // );

        $data = array(
            'name' => $user->first_name.' '.$user->first_name,
            'email' => $user->email,
            'title' => config('app.name'),
            'body' => $request->message
        );

        /** Send message to the user */
        Mail::send('emails.email_support', $data, function ($m) use ($data) {
            $m->to($data['email'])->subject(config('app.name'));
        });


        return back()->with([
            'type' => 'success',
            'message' => 'Message sent successfully.',
        ]);
    }

    public function chat_support()
    {
        $users = User::where('user_type', 'User')->get();
        $authenticatedUserId = Auth::guard('admin')->user()->id;

        $userWithMessageUser = [];

        foreach ($users as $user) {
            $messageUser = MessageUser::where(function ($query) use ($user, $authenticatedUserId) {
                $query->where('sender_id', $authenticatedUserId)
                    ->where('reciever_id', $user->id);
            })->orWhere(function ($query) use ($user, $authenticatedUserId) {
                $query->where('reciever_id', $authenticatedUserId)
                    ->where('sender_id', $user->id);
            })->first();

            // Initialize variables
            $unreadCount = 0;
            $lastMessage = null;

            // Check if $messageUser is not null before fetching unreadCount and lastMessage
            if ($messageUser) {
                $unreadCount = Message::where(['message_users_id' => $messageUser->id, 'user_id' => $user->id])
                    ->where('read_at', null)
                    ->count();

                $lastMessage = Message::where(['message_users_id' => $messageUser->id, 'user_id' => $user->id,  'read_at' => null])
                    ->latest() // Order by the latest messages first
                    ->first();
            }

            // Add the user to the array
            $userWithMessageUser[] = [
                'user' => $user,
                'unreadCount' => $unreadCount,
                'lastMessage' => $lastMessage
            ];
        }

        // Sort the array based on the timestamp of the latest message
        $userWithMessageUser = collect($userWithMessageUser)->sortByDesc(function ($user) {
            return optional($user['lastMessage'])->created_at;
        })->values()->all();

        if (request()->ajax()) {
            return response()->json([
                'userWithMessageUser' => $userWithMessageUser,
            ]);
        } else {
            return view('Admin.support.chatSupport', [
                'userWithMessageUser' => $userWithMessageUser
            ]);
        }
    }

    public function check($recieverId)
    {
        $senderId = Auth::guard('admin')->user()->id;

        $checkExist = MessageUser::where(function ($query) use ($recieverId, $senderId) {
            $query->where('sender_id', $senderId)
                ->where('reciever_id', $recieverId);
        })->orWhere(function ($query) use ($recieverId, $senderId) {
            $query->where('reciever_id', $senderId)
                ->where('sender_id', $recieverId);
        })->first();

        $data = [
            'sender_id' => $senderId,
            'reciever_id' => $recieverId
        ];

        if (!$checkExist) {
            $createConvo = MessageUser::create($data);
            // $createConvo2 = MessageUser::create($data2);
            return $createConvo->id;
        } else {
            return $checkExist->id;
        }
    }

    public function store(Request $request)
    {
        $messageUser = MessageUser::find($request->convo_id);

        if ($messageUser->sender_id == Auth::guard('admin')->user()->id) {
            $user = User::where('id', $messageUser->reciever_id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            $sendMessage = Message::create([
                'message_users_id' => $messageUser->id,
                'user_id' => Auth::guard('admin')->user()->id,
                'message' => $request->message
            ]);

            $this->fcm('Message from ' . Auth::guard('admin')->user()->name . ': ' . $request->message, $user);

            if ($sendMessage) {
                return "Message Sent";
            } else {
                return "Error sending message.";
            }
        } else {
            $user = User::where('id', $messageUser->sender_id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            $sendMessage = Message::create([
                'message_users_id' => $messageUser->id,
                'user_id' => Auth::guard('admin')->user()->id,
                'message' => $request->message
            ]);

            $this->fcm('Message from ' . Auth::guard('admin')->user()->name . ': ' . $request->message, $user);

            if ($sendMessage) {
                return "Message Sent";
            } else {
                return "Error sending message.";
            }
        }
    }

    public function load($reciever, $sender)
    {
        $boxType = "";

        $checkExist = MessageUser::where(function ($query) use ($reciever, $sender) {
            $query->where('sender_id', $sender)
                ->where('reciever_id', $reciever);
        })->orWhere(function ($query) use ($reciever, $sender) {
            $query->where('reciever_id', $sender)
                ->where('sender_id', $reciever);
        })->first();

        $allMessages = Message::where('message_users_id', $checkExist->id)->orderBy('id', 'asc')->get();

        foreach ($allMessages as $message) {
            // Check if the message user ID is not equal to the authenticated user's ID or the sender's ID
            if ($message->user_id <> Auth::guard('admin')->user()->id) {
                // Check if the message has not been read
                if ($message->read_at == null) {
                    // Update the read_at field
                    $message->update([
                        'read_at' => now()
                    ]);
                }
            }
        }
        // foreach($allMessages as $row){
        //     if($id1[0]==$row['message_users_id']){$boxType = "p-2 recieverBox ml-auto";}else{$boxType = "float-left p-2 mb-2 senderBox";}
        //     echo "<div class='p-2 d-flex'>";
        //     echo "<div class='".$boxType."'>";
        //     echo "<p>".$row['message']."</p>";
        //     echo "</div>";
        //     echo "</div>";
        // }
        $tobePassed = [$allMessages, Auth::guard('admin')->user()->id];
        return $tobePassed;
    }

    public function retrieveNew($reciever, $sender, $lastId)
    {
        $checkExist = MessageUser::where(function ($query) use ($reciever, $sender) {
            $query->where('sender_id', $sender)
                ->where('reciever_id', $reciever);
        })->orWhere(function ($query) use ($reciever, $sender) {
            $query->where('reciever_id', $sender)
                ->where('sender_id', $reciever);
        })->first();

        $allMessages = Message::where('id', '>=', $lastId)->where(['message_users_id' => $checkExist->id, 'user_id' => $reciever])->orderBy('id', 'asc')->get();

        foreach ($allMessages as $message) {
            // Check if the message user ID is not equal to the authenticated user's ID or the sender's ID
            if ($message->user_id <> Auth::guard('admin')->user()->id) {
                // Check if the message has not been read
                if ($message->read_at == null) {
                    // Update the read_at field
                    $message->update([
                        'read_at' => now()
                    ]);
                }
            }
        }

        return $allMessages;
    }

    public function markMessageAsRead($messageId)
    {
        // Assuming you have a Message model with a read_at column
        $message = Message::find($messageId);

        // Check if the authenticated user is the recipient of the message
        if (Auth::guard('admin')->user()->id <> $message->message_users_id) {
            $message->update(['read_at' => now()]);
        }

        // You can return a response if needed
        return $message;
    }

    public function view_email_kits()
    {
        $admin_email_integrations = EmailKit::latest()->where(['account_id' => Auth::guard('admin')->user()->id, 'is_admin' => true])->get();

        return view('Admin.email-marketing.email-kits.index', [
            'admin_email_integrations' => $admin_email_integrations
        ]);
    }

    public function validate_email()
    {
        return view('Admin.email-marketing.email-kits.validate_email');
    }

    public function view_email_campaigns()
    {
        $email_campaigns = EmailCampaign::latest()->get();

        return view('Admin.email-marketing.email-campaigns.index', [
            'email_campaigns' => $email_campaigns
        ]);
    }

    public function sms_automation()
    {
        $smsAutomations = SmsCampaign::latest()->where('sms_type', 'plain')->get();
        return view('Admin.automation.smsAutomation', compact('smsAutomations'));
    }

    public function whatsapp_automation()
    {
        $whatsapp_campaigns = WaCampaigns::latest()->get();
        return view('Admin.automation.whatsappAutomation', compact('whatsapp_campaigns'));
    }

    public function integration()
    {
        return view('Admin.integration');
    }

    public function birthday_module()
    {
        $bm = BirthdayAutomation::latest()->get();
        return view('Admin.birthdayModule', compact('bm'));
    }

    public function notification()
    {
        return view('Admin.notification');
    }

    // sales analytics
    public function sales_analytics(Request $request)
    {
        $lms = [];
        $ecommerce = [];

        $year = now()->format('Y');

        $lms['January'] = ShopOrder::latest()->whereMonth('created_at', 1)->whereYear('created_at', $year)->sum('amount');
        $lms['February'] = ShopOrder::latest()->whereMonth('created_at', 2)->whereYear('created_at', $year)->sum('amount');
        $lms['March'] = ShopOrder::latest()->whereMonth('created_at', 3)->whereYear('created_at', $year)->sum('amount');
        $lms['April'] = ShopOrder::latest()->whereMonth('created_at', 4)->whereYear('created_at', $year)->sum('amount');
        $lms['May'] = ShopOrder::latest()->whereMonth('created_at', 5)->whereYear('created_at', $year)->sum('amount');
        $lms['June'] = ShopOrder::latest()->whereMonth('created_at', 6)->whereYear('created_at', $year)->sum('amount');
        $lms['July'] = ShopOrder::latest()->whereMonth('created_at', 7)->whereYear('created_at', $year)->sum('amount');
        $lms['August'] = ShopOrder::latest()->whereMonth('created_at', 8)->whereYear('created_at', $year)->sum('amount');
        $lms['September'] = ShopOrder::latest()->whereMonth('created_at', 9)->whereYear('created_at', $year)->sum('amount');
        $lms['October'] = ShopOrder::latest()->whereMonth('created_at', 10)->whereYear('created_at', $year)->sum('amount');
        $lms['November'] = ShopOrder::latest()->whereMonth('created_at', 11)->whereYear('created_at', $year)->sum('amount');
        $lms['December'] = ShopOrder::latest()->whereMonth('created_at', 12)->whereYear('created_at', $year)->sum('amount');


        $ecommerce['January'] = OrderItem::latest()->whereMonth('created_at', 1)->whereYear('created_at', $year)->sum('amount');
        $ecommerce['February'] = OrderItem::latest()->whereMonth('created_at', 2)->whereYear('created_at', $year)->sum('amount');
        $ecommerce['March'] = OrderItem::latest()->whereMonth('created_at', 3)->whereYear('created_at', $year)->sum('amount');
        $ecommerce['April'] = OrderItem::latest()->whereMonth('created_at', 4)->whereYear('created_at', $year)->sum('amount');
        $ecommerce['May'] = OrderItem::latest()->whereMonth('created_at', 5)->whereYear('created_at', $year)->sum('amount');
        $ecommerce['June'] = OrderItem::latest()->whereMonth('created_at', 6)->whereYear('created_at', $year)->sum('amount');
        $ecommerce['July'] = OrderItem::latest()->whereMonth('created_at', 7)->whereYear('created_at', $year)->sum('amount');
        $ecommerce['August'] = OrderItem::latest()->whereMonth('created_at', 8)->whereYear('created_at', $year)->sum('amount');
        $ecommerce['September'] = OrderItem::latest()->whereMonth('created_at', 9)->whereYear('created_at', $year)->sum('amount');
        $ecommerce['October'] = OrderItem::latest()->whereMonth('created_at', 10)->whereYear('created_at', $year)->sum('amount');
        $ecommerce['November'] = OrderItem::latest()->whereMonth('created_at', 11)->whereYear('created_at', $year)->sum('amount');
        $ecommerce['December'] = OrderItem::latest()->whereMonth('created_at', 12)->whereYear('created_at', $year)->sum('amount');


        $totalLMSSales = ShopOrder::latest()->sum('amount');
        $totalEcommerceSales = OrderItem::latest()->sum('amount');

        // return $lms;
        // return $ecommerce;

        return view('Admin.salesAnalytics', [
            'lms' => $lms,
            'ecommerce' => $ecommerce,
            'totalLMSSales' => $totalLMSSales,
            'totalEcommerceSales' => $totalEcommerceSales
        ]);
    }


    function getStats(){
        $dailyRecords = Broadcast::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->count();
        $weeklyRecords = Broadcast::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $monthlyRecords = Broadcast::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $yearlyRecords = Broadcast::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();
        $broadcasts = Broadcast::where('channel', '!=', 'whatsapp')->count();
        $smsBroadcst = Broadcast::where('channel', 'sms')->count();
        $emailBroadcst = Broadcast::where('channel', 'email')->count();

        $dailySubRecords = \App\Models\OjaSubscription::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->count();
        $weeklySubRecords = \App\Models\OjaSubscription::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $monthlySubRecords = \App\Models\OjaSubscription::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $yearlySubRecords = \App\Models\OjaSubscription::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();
        $subCounts = \App\Models\OjaSubscription::count();
        $activeSub = \App\Models\OjaSubscription::where('status', 'Active')->count();

        $dailyOptRecords = UpsellPageSubmission::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->groupBy('page_id')->count();
        $weeklyOptRecords = UpsellPageSubmission::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->groupBy('page_id')->count();
        $monthlyOptRecords = UpsellPageSubmission::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->groupBy('page_id')->count();
        $yearlyOptRecords = UpsellPageSubmission::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->groupBy('page_id')->count();
        $optCounts = UpsellPageSubmission::groupBy('page_id')->count();
        $pendingOpt = UpsellPageSubmission::where('status', 'Pending')->groupBy('page_id')->count();
        $paidOpt = UpsellPageSubmission::where('status', 'Paid')->groupBy('page_id')->count();
        $failedOpt = UpsellPageSubmission::where('status', 'Failed')->groupBy('page_id')->count();

        $data = [
            'daily'             => $dailyRecords,
            'weekly'            => $weeklyRecords,
            'monthly'           => $monthlyRecords,
            'yearly'            => $yearlyRecords,
            'broadcasts'        => $broadcasts,
            'smsBroadcst'       => $smsBroadcst,
            'emailBroadcst'     => $emailBroadcst,
            //////////////////////////////////////////
            'ojaSubDaily'       => $dailySubRecords,
            'ojaSubWeekly'      => $weeklySubRecords,
            'ojaSubMonthly'     => $monthlySubRecords,
            'ojaSubYearly'      => $yearlySubRecords,
            'ojaSub'            => $subCounts,
            'ojaActiveSub'      => $activeSub,
            //////////////////////////////////////////
            'ojaOptDaily'       => $dailyOptRecords,
            'ojaOptWeekly'      => $weeklyOptRecords,
            'ojaOptMonthly'     => $monthlyOptRecords,
            'ojaOptYearly'      => $yearlyOptRecords,
            'ojaOpt'            => $optCounts,
            'pendingOpt'        => $pendingOpt,
            'paidOpt'           => $paidOpt,
            'failedOpt'         => $failedOpt,
        ];
        return $data;
    }


    // sales analytics
    public function email_analytics(Request $request)
    {
        $data = $this->getStats();
        return view('Admin.emailAnalytics', $data);

    }


    public function getStatistics(Request $request)
    {
        $rules = [
            'sory_by'  => 'bail|required',
        ];
        $validator = \Validator::make($request->all(), $rules)->stopOnFirstFailure(true);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->all(),
            ],200);
        }

        return response()->json([
            'status' => 'success',
            'message' => "Data retrieved",
            'data' => $this->getStats()
        ],200);
    }


    public function add_users(Request $request)
    {
        $rules = [
            'fullname'      => 'bail|required|regex:/^[a-zA-Z]+(?:\s[a-zA-Z]+)+$/', // 2 words and space
            'email'         => 'required|email|string|unique:users,email',
            'password'      => 'required|string|min:8',
        ];
        $validator = \Validator::make($request->all(), $rules)->stopOnFirstFailure(true);

        // return $request->referral_link;

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->all(),
            ],200);
        }

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

            $plan = OjaPlan::where('name', 'Free Plan')->first();
            // Okay, create it
            if ($plan) {
                $user = $customer->adminCreateAccountAndUser($request);
            } else {

                return back()->with([
                    'type' => 'danger',
                    'message' => 'Admin yet to add plans! Try again later.'
                ])->withInput();
            }

        }

        if($user){
            $users = User::where("id", $user->id)->update([
                'customer_id' => $user->id
            ]);

            $email_message = "
            <p><b>Your Email:</b> {{ $request->email }}</p>
            <p><b>Your Password:</b> {{ $request->password }}</p>
            ";

            Mail::to($request->email)->send(new AccountInfoMail($request->email, $request->password, $email_message));

            return response()->json([
                'status' => 'success',
                'message' => "user added",
                'data' => ''
            ],200);
        }
        return response()->json([
            'status' => 'error',
            'message' => "Error in adding user",
            'data' => ''
        ],200);
    }


    public function update_prvdg(Request $request)
    {
        $rules = [
            'features'      => 'bail|required',
            'user_id'      => 'required',
        ];
        $validator = \Validator::make($request->all(), $rules)->stopOnFirstFailure(true);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->all(),
            ],200);
        }
        $features1 = $request->features;
        $all_fts = "";
        if(isset($features1) && count($features1) > 0){
            foreach($features1 as $fts){
                $all_fts .= "$fts,";
            }
        }
        $all_fts = substr($all_fts, 0, -1);

        $users = User::where("id", $request->user_id)->update([
            'feature_access' => $all_fts
        ]);

        if($users){
            return response()->json([
                'status' => 'success',
                'message' => "user priviledges changed",
                'data' => ''
            ],200);
        }
        return response()->json([
            'status' => 'error',
            'message' => "Error in updating user priviledges",
            'data' => ''
        ],200);
    }


    public function sendMessageMultitexter($data, $allDataPhones)
    {
        $contacts = User::whereNotNull('phone_number')->pluck('phone_number')->toArray();
        $integration = \App\Models\Integration::where('type', 'Multitexter')->first();
        $api_key = env('MULTITEXTER_API');

        try {
            foreach($allDataPhones as $phone)
            {
                $phoneNumber = trim("0" . ltrim(ltrim(ltrim(ltrim($phone, "0"), "2340"), "234"), "+234"));
                // $get_formatted_phone = "+234".(int)$phoneNumber."<br>";
                $phoneNumber = str_replace("+", "", $phoneNumber);

                $client = new Client(); //GuzzleHttp\Client
                $url = "https://app.multitexter.com/v2/app/sendsms";

                $params = [
                    "sender_name" => 'OjaFunnel',
                    "message" => $data['body'],
                    "recipients" => $phoneNumber
                    // "recipients" => "08161215848"
                ];

                $headers = [
                    'Authorization' => 'Bearer ' . $api_key
                ];

                $client->request('POST', $url, [
                    'json' => $params,
                    'headers' => $headers,
                ]);
            }
            // $responseBody = json_decode($response->getBody());
            $responseBody = true;
        } catch (Exception $e) {
            $responseBody = $e;
        }
        return $responseBody;
    }

    public function sendMessageTwilio($sms, $phones)
    {
        $integration = \App\Models\Integration::where('type', 'Multitexter')->first();
        $sid = env('TWILIO_SID');
        $auth_token = env('TWILIO_TOKEN');
        $from_number = env('TWILIO_FROM');
        $notify_sid = env('TWILIO_NOTIFY_SID');
        $message = $sms['body'];
        $sender_name = "OjaFunnel";

        $phones = ['+2348038204317'];

        // this below is working////
            /* $twilio = new twilio($sid, $auth_token);
            $verification = $twilio->verify
            ->v2->services(ENV('TWILIO_SERVICE_ID'))
            ->verifications
            ->create('+2348035204317', "sms");
            return $verification; */
        // this below is working////



        // $sid = getenv("TWILIO_ACCOUNT_SID");
        // $token = getenv("TWILIO_AUTH_TOKEN");
        // $notify_sid = getenv("TWILIO_NOTIFY_SID");

        // $twilio = new Client($sid, $token);
        $twilio = new twilio($sid, $auth_token);

        return $twilio->messages->create(
            $number,
            [
                'from' => $from_number,
                'body' => $message,
            ]);



        // return $twilio->messages->create(
        //     $number,
        //     [
        //         // 'from' => $from_number,
        //         'body' => $message,
        //     ]
        // );


        /* foreach( $phones as $number ){
            $twilio->messages->create(
            $number,
            [
                'from' => $from_number,
                'body' => $message,
            ]);
        } */



        // $users = User::where('user_type','user')->pluck('phone');
        $subscribers = [];
        foreach($phones as $user)
        {
            $subscribers[] = json_encode(['binding_type' => 'sms','address' => $user]);
        }

        $request_data = [
            'toBinding' => $subscribers,
            'body' => $message
        ];

        //Create a notification
        try
        {
            $notification = $twilio->notify->services($notify_sid)->notifications->create($request_data);

        }catch(\Exception $e)
        {
            //echo $e;
            $error = $e->getMessage();
            // Log::channel('daily')->error('Admin push notification failed, error message : ' . $error);
            return response()->json([
                'status' => 'failed',
                'message' => 'Error occured sending notification. error message ' . $error
            ],400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Message sent successfully'
        ],200);





        // try {
        //     $sid = $sid; // Your Account SID from www.twilio.com/console
        //     $auth_token = $auth_token; // Your Auth Token from www.twilio.com/console
        //     $from_number = $from_number; // Valid Twilio number

        //     $client = new twilio($sid, $auth_token);
        //     $count = 0;

        //     $message = $client->messages
        //     ->create("+447522097511", // to
        //         array(
        //         "from" => "+2348035204317",
        //         "body" => "this is a test"
        //         )
        //     );

        //     /* foreach( $phones as $number ){
        //         $count++;
        //         $client->messages->create(
        //             $number,
        //             [
        //                 'from' => $from_number,
        //                 'body' => $message,
        //             ]
        //         );
        //     } */
        //     return true;
        // }catch(Exception $e) {
        //     return $e->getMessage();
        // }
    }


    public function sendMessageToWhatsApp($sms, $phones)
    {
        // $date = Carbon::now();

        // $current_date = $date->format('Y-m-d');
        // $current_time = $date->format('H:i');

        $contacts = User::whereNotNull('phone_number')->get();

        // divide into 10 chunks and
        // delay each job between 10  - 20 sec in the queue
        $chunks = $contacts->chunk(10);
        $delay = mt_rand(10, 20);

        // dispatch job and delay
        foreach ($chunks as $key => $_chunk) {
            // dispatch job
            ProcessTemplate1BulkWAMessages::dispatch($_chunk, [
                'whatsapp_account' => $_chunk->phone_number,
                'full_jwt_session' => $_chunk->full_jwt_session,
                'template1_message' => $_campaign->template1_message,
                'wa_campaign_id' => $_campaign->id
            ])->onQueue('waTemplate1')->delay($delay);

            $delay += mt_rand(10, 20);
        }


        // update the campaign queue to waiting
        WaQueues::where(['wa_campaign_id' => $_campaign->id])->update([
            'status' => 'Waiting'
        ]);
    }



    public function send_broadcast(Request $request)
    {
        $rules = [
            'channel'      => 'required',
            'subject'      => 'required',
            'message'      => 'required',
            'list_id'      => 'required'
        ];
        $validator = \Validator::make($request->all(), $rules)->stopOnFirstFailure(true);
        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->all(),
            ],200);
        }


        $channels = $request->channel;
        $user_emails = [];
        $user_phones = [];
        $user_whatsapp = [];

        if($request->list_id == "all_users")
        {
            //if(in_array('emails', $user_channel)){
            if($request->channel == "emails"){
                // $user_emails = User::whereNotNull('email')->whereRaw("email LIKE '%chinny%' OR email LIKE '%chibobo%' OR email LIKE '%promiseezema11%'")->pluck('email')->toArray();
                $user_emails = User::whereNotNull('email')->pluck('email')->toArray();
            }
            //if(in_array('sms', $user_channel)){
            if($request->channel == "sms"){
                $user_phones = User::whereNotNull('phone_number')->pluck('phone_number')->toArray();
            }
            //if(in_array('whatsapp', $user_channel)){
            if($request->channel == "whatsapp"){
                $user_whatsapp = User::whereNotNull('phone_number')->pluck('phone_number')->toArray();
            }
        } elseif($request->list_id == "newsletter_subscribers") {
            if($request->channel == "emails"){
                $user_emails = Newsletter::whereNotNull('email')->pluck('email')->toArray();
            } else {
                return response()->json([
                    'message' => "Email channel is only available for newsletter.",
                ],200);
            }
        } else {
            if($request->channel == "emails"){
                $user_emails = ListManagementContact::where('list_management_id', $request->list_id)
                    ->whereNotNull('email')->pluck('email')->toArray();
            }

            if($request->channel == "sms"){
                $user_phones = ListManagementContact::where('list_management_id', $request->list_id)
                ->whereNotNull('phone')->pluck('phone')->toArray();
            }

            if($request->channel == "whatsapp"){
                $user_whatsapp = ListManagementContact::where('list_management_id', $request->list_id)
                    ->whereNotNull('phone')->pluck('phone')->toArray();
            }
        }

       $allDataEmails = array_merge($user_emails);
       $allDataPhones = array_merge($user_phones, $user_whatsapp);

       $all_emails = "";
       $all_phones = "";
       $send_emails = false;

        if(count($allDataEmails) > 0){
            $data = array(
                'name' => "OjaFunnel",
                'subject' => $request->subject,
                'body' => $request->message,
                'emails' => $allDataEmails
            );

            Broadcast::create([
                'subject' => $request->subject,
                'message' => $request->message,
                'channel' => 'email',
            ]);

            Mail::to(env('MAIL_FROM_ADDRESS'))->bcc($data['emails'])->send(new BroadcastEmail($data['subject'], $data['body']));

            SendBroadcastEmail::dispatch($data);
            $send_emails = true;
        }

        if(count($allDataPhones) > 0){
            // if(in_array('sms', $request->channel)){
            if($request->channel == "sms"){
                Broadcast::create([
                    'message' => $request->message,
                    'channel' => $request->channel,
                ]);
                $data = array(
                    'name' => "OjaFunnel",
                    'body' => $request->message,
                );
                $send_emails = $this->sendMessageMultitexter($data, $allDataPhones);
            }

            // if(in_array('whatsapp', $request->channel)){
            if($request->channel == "whatsapp"){
                Broadcast::create([
                    'subject' => $request->subject,
                    'message' => $request->message,
                    'channel' => $request->channel,
                ]);
                $data = array(
                    'name' => "OjaFunnel",
                    'subject' => $request->subject,
                    'body' => $request->message,
                );
                $send_emails = $this->sendMessageToWhatsApp($data, $allDataPhones);
            }
        }

        if($send_emails){
            return response()->json([
                'status' => 'success',
                'message' => "Broadcast sent",
                'data' => ''
            ],200);
        }

        return response()->json([
            'status' => 'error',
            'message' => "Error in sending broadcast",
            'data' => ''
        ],200);
    }


    public function renew_extend(Request $request)
    {
        // return $request->all();
        $attributes = [
            'sub_type'          => 'Subscription type',
            'start_date'        => 'Start date',
            'end_date'          => 'Extend date',
            'subscription_id'   => 'ID',

        ];
        $rules = [
            'subscription_id'   => 'bail|required',
            'sub_type'          => 'bail|required',
            'start_date'        => 'required|date',
            'end_date'          => 'date|required_if:sub_type,==,extend',
        ];
        $validator = \Validator::make($request->all(), $rules)->setAttributeNames($attributes)->stopOnFirstFailure(true);
        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->all(),
            ],200);
        }

        $ojaSub = OjaSubscription::find($request->subscription_id);

        $nowDate = Carbon::now();
        $toDate = Carbon::parse($request->end_date);
        $fromDate = Carbon::parse($request->start_date);
        $months = $toDate->diffInDays($fromDate);

        if($toDate <= $nowDate && $request->sub_type == "extend"){
            return response()->json([
                'message' => "Invalid date, cannot choose past or present date",
            ],200);
        }

        $toDate1 = Carbon::parse($request->end_date);
        $fromDate1 = Carbon::now();
        $extend_days = $toDate1->diffInDays($fromDate1);

        if($request->sub_duration == 'monthly')
        {
            $date = now()->addMonth();
            $expiryNotice = now()->addMonth()->subDays(7)->toDateString();
            // if($months <= 31 && $months >= 28){ // one month
                // $duration_timestamp = strtotime(Carbon::now()->addDays((int)$months)->toDateTimeString());
                // $expiryNotice = strtotime(Carbon::now()->addDays((int)$months)->subDays(7)->toDateTimeString());
            // }
        } else {
            $date = now()->addYear()->toDateString();
            $expiryNotice = now()->addYear()->subDays(7)->toDateString();
            // $duration_timestamp = strtotime(Carbon::now()->addYears(1)->toDateTimeString());
            // $expiryNotice = strtotime(Carbon::now()->addYears(1)->subDays(7)->toDateTimeString());
        }

        if($request->sub_type == "renew"){
            $subs = \App\Models\OjaSubscription::where("id", $request->subscription_id)->update([
                'started_at' => now(),
                'ends_at' => $date,
                'expiry_notify_at' => $expiryNotice,
                'renewed'=> \DB::raw('renewed+1'),
            ]);

            $caption1 = "renewed";

            return response()->json([
                'status' => 'success',
                'message' => "Subscription has been $caption1 $request->sub_duration",
                'data' => ''
            ],200);
        }else{ // extend
            // $duration_timestamp = strtotime(Carbon::now()->addDays((int)$request->extend_end_date));
            // $duration_timestamp1 = date("Y-m-d H:i:s", $request->extend_end_date);

            $dateTime = new DateTime($request->extend_end_date);
            // Set the specific time
            $dateTime->setTime(14, 3, 26);
            // Get the formatted result
            $result = $dateTime->format('Y-m-d H:i:s');

            // Subtract 7 days
            $dateTime->sub(new DateInterval('P7D'));
            // Get the formatted result
            $notifyresult = $dateTime->format('Y-m-d H:i:s');

            $subs = \App\Models\OjaSubscription::where("id", $request->subscription_id)->update([
                'ends_at' => $result,
                'expiry_notify_at' => $notifyresult,
                'extended'=> \DB::raw('extended+1'),
            ]);

            $caption1 = "extended";

            return response()->json([
                'status' => 'success',
                'message' => "Subscription has been $caption1",
                'data' => ''
            ],200);
        }

        if($request->sub_type == "renew"){
            $caption2 = "renewing";
        }else{
            $caption2 = "extending";
        }

        return response()->json([
            'status' => 'error',
            'message' => "Error in $caption2 subscription",
            'data' => ''
        ],200);
    }

    public function react_feature(Request $request)
    {
        $attributes = ['id'  => 'ID'];
        $rules = ['id'   => 'required'];
        $validator = \Validator::make($request->all(), $rules)->setAttributeNames($attributes)->stopOnFirstFailure(true);
        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->all(),
            ],200);
        }

        $site_features = SiteFeature::whereRaw("md5(id) = '$request->id'")->first();
        $site_features->update([
            'status' => $site_features->status == "enable" ? "disabled" : "enable"
        ]);

        if($site_features){
            return response()->json([
                'status' => 'success',
                'message' => "Successful",
                'data' => ''
            ],200);
        }
        return response()->json([
            'status' => 'error',
            'message' => "Error in reacting to feature",
            'data' => ''
        ],200);
    }

    public function generateAndValidateIfPromotionLinkNotExist()
    {
        $promotionLink = substr(sha1(mt_rand()), 17, 20);
        $user = User::where('promotion_link', $promotionLink);
        if ($user->exists()) $this->generateAndValidateIfPromotionLinkNotExist();
        return $promotionLink;
    }

    // EMAIL-MARKETING
    public function add_category(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string'],
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Category added successfully.',
        ]);
    }

    public function update_category(Request $request, $id)
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string'],
        ]);

        $Finder = Crypt::decrypt($id);
        $category = Category::find($Finder);

        $category->update([
            'name' => $request->name
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Category updated successfully.',
        ]);
    }

    public function delete_category($id)
    {
        $Finder = Crypt::decrypt($id);
        Category::find($Finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Category deleted successfully.',
        ]);
    }

    public function course_activate($id)
    {
        $course = Course::find($id);

        $course->update([
            'approved' => true
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Course activated successfully.',
        ]);
    }

    public function course_deactivate($id)
    {
        $course = Course::find($id);

        $course->update([
            'approved' => false
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Course suspended successfully.',
        ]);
    }

    public function read_notification($id)
    {
        $finder = Crypt::decrypt($id);
        $notification = OjafunnelNotification::findorfail($finder);

        $notification->status = 'Read';
        $notification->save();

        return back();
    }

    public function newsletter()
    {
        return view('Admin.frontend.newsletter');
    }

    public function delete_newsletter($id)
    {
        $Finder = Crypt::decrypt($id);
        Newsletter::find($Finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Deleted successfully.',
        ]);
    }

    public function view_faq()
    {
        return view('Admin.frontend.faq');
    }

    public function add_faq(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Faq added successfully.',
        ]);
    }

    public function update_faq(Request $request, $id)
    {
        //Validate Request
        $this->validate($request, [
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
        ]);

        $Finder = Crypt::decrypt($id);
        $faq = Faq::find($Finder);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Faq updated successfully.',
        ]);
    }

    public function delete_faq($id)
    {
        $Finder = Crypt::decrypt($id);
        Faq::find($Finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Faq deleted successfully.',
        ]);
    }

    public function view_contact_us()
    {
        return view('Admin.frontend.contact_us');
    }





    public function delete_contact_us($id)
    {
        $Finder = Crypt::decrypt($id);
        ContactUs::find($Finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Contact Us Form deleted successfully.',
        ]);
    }

    public function saveToken(Request $request)
    {
        $admin = Admin::find(Auth::guard('admin')->user()->id);

        $admin->update([
            'fcm_token' => $request->token
        ]);

        return response()->json(['Token successfully stored.']);
    }

    public function generatePageSlug($folder)
    {
        $slug = strtolower(implode('-', explode(' ', $folder)));

        $page = Page::where(['slug' => $slug]);

        if ($page->exists()) {
            if ($page->first()->admin_id == Auth::guard('admin')->user()->id) {
                return [true, $slug];
            } else return [false, $slug];
        }

        return [true, $slug];
    }


    public function page_builder_create(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'file_folder' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
        ]);

        $page_name = strtolower(implode('-', explode(' ', $request->file_name)));

        $res =  $this->generatePageSlug($request->file_folder);

        // check if sub domain name taken
        if (!$res[0]) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain already taken.'
            ]);
        }

        // check if subdomain contains .
        if (str_contains($res[1], '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain is invalid. Can\'t contain dot(s)'
            ]);
        }

        if (str_contains($page_name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Page name is invalid. Can\'t contain dot(s)'
            ]);
        }

        $file = $page_name . '.html';

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2); //2 Megabytes max html file size

        $data = file_get_contents(resource_path('views/builder/new-page-blank-template.blade.php'));

        $html = substr($data, 0, MAX_FILE_LIMIT);

        $file = $this->sanitizeFileName($file);

        // $datum = strval($request->file_folder);

        $_page = Page::where(['name' => $file, 'slug' => $res[1], 'admin_id' => Auth::guard('admin')->user()->id]);

        if ($_page->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'This page already exist on your subdomain.'
            ]);
        }

        $disk = Storage::build([
            'driver' => 'local',
            'root'   => public_path('pageBuilder') . '/' . $res[1],
            'permissions' => [
                'file' => [
                    'public' => 0777,
                    'private' => 0777,
                    'custom' => 0777
                ],
                'dir' => [
                    'public' => 0777,
                    'private' => 0777,
                    'custom' => 0777
                ],
            ],
        ]);

        if (!$disk->put($file, $html)) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            return back()->with([
                'type' => 'danger',
                'message' => 'Error saving file  ' . $file . '\nPossible causes are missing write permission or incorrect file path!'
            ]);
        } else {
            $page = Page::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'title' => $request->title,
                'name' => $file,
                'folder' => $request->file_folder,
                'file_location' => config('app.url') . '/pageBuilder/' . $res[1] . '/' . $file,
                'slug' => $res[1]
            ]);

            return back()->with([
                'type' => 'success',
                'message' => $page->name . ' created.'
            ]);
        };
    }

    function sanitizeFileName($file)
    {
        //sanitize, remove double dot .. and remove get parameters if any
        $file = preg_replace('@\?.*$@', '', preg_replace('@\.{2,}@', '', preg_replace('@[^\/\\a-zA-Z0-9\-\._]@', '', $file)));
        return $file;
    }

    public function viewEditor($id)
    {
        $finder = Crypt::decrypt($id);

        $page = Page::find($finder);

        return view('dashboard.editor', [
            'page' => $page
        ]);
    }

    public function viewPage($username, Request $request, Page $page)
    {
        return view('dashboard.page', compact('page'));
    }

    public function page_builder_save_page()
    {
        $page = Page::find($_POST['id']);

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2); //2 Megabytes max html file size

        $html = "";

        if (isset($_POST['html'])) {
            $html = substr($_POST['html'], 0, MAX_FILE_LIMIT);
        }

        $disk = public_path('pageBuilder/' . $page->slug . '/' . $page->name);

        if (file_put_contents($disk, $html)) {
            echo "File saved.";
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            echo "Error saving file. \nPossible causes are missing write permission or incorrect file path!";
        }
    }

    public function page_builder_update($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255']
        ]);

        if (str_contains($request->name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Page name can\'t contain dot(s).'
            ]);
        }

        $idFinder = Crypt::decrypt($id);
        $page = Page::find($idFinder);

        $file = $request->name . '.html';

        $disk = public_path('pageBuilder/' . $page->slug . '/' . $page->name);

        rename($disk, public_path('pageBuilder/' . $page->slug . '/' . $file));

        //Validate User
        if (request()->hasFile('thumbnail')) {
            $this->validate($request, [
                'thumbnail' => 'required|mimes:jpeg,png,jpg',
            ]);
            $filename = request()->thumbnail->getClientOriginalName();
            if ($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }
            request()->thumbnail->storeAs('pages', $filename, 'public');

            $page->update([
                'thumbnail' => '/storage/pages/' . $filename,
                'name' => $file,
                'title' => $request->title,
                'file_location' => config('app.url') . '/pageBuilder/' . $page->slug . '/' . $file
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Page updated successfully!'
            ]);
        }

        $page->update([
            'name' => $file,
            'title' => $request->title,
            'file_location' => config('app.url') . '/pageBuilder/' . $page->slug . '/' . $file
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Page Updated Successfully!'
        ]);
    }

    public function page_builder_delete($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if ($request->delete_field == "DELETE") {
            $idFinder = Crypt::decrypt($id);

            $page = Page::findorfail($idFinder);

            if ($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }

            if ($page->file_location) {
                File::deleteDirectory(public_path('pageBuilder/' . $page->slug));
            }

            $page->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Page deleted successfully!'
            ]);
        }

        return back()->with([
            'type' => 'danger',
            'message' => "Field doesn't match, Try Again!"
        ]);
    }

    public function page_publish(Request $request)
    {
        if ($request->action == 'Publish') {
            $page = Page::findorfail($request->id);

            $page->update([
                'published' => true
            ]);

            return back()->with([
                'type' => 'success',
                'message' => "Page Published"
            ]);
        } else {
            $page = Page::findorfail($request->id);

            $page->update([
                'published' => false
            ]);

            return back()->with([
                'type' => 'success',
                'message' => "Page Unpublish"
            ]);
        }
    }

    public function support_whatsapp()
    {
        return view('Admin.support.whatsappSupport');
    }

    public function add_support_whatsapp(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'phone_number' => ['required', 'numeric'],
        ]);

        WhatsappSupport::create([
            'phone_number' => $request->phone_number
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Whatapp number added successfully.',
        ]);
    }

    public function delete_support_whatsapp($id)
    {
        $Finder = Crypt::decrypt($id);
        WhatsappSupport::find($Finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Whatsapp number deleted successfully.',
        ]);
    }

    public function pending_payouts()
    {
        $withdrawals = Withdrawal::latest()->where('status', '!=', 'finalized')->get();
        return view('Admin.payouts.pending_payouts',[
            'withdrawals' => $withdrawals
        ]);
    }

    public function process_payouts($id, Request $request)
    {
        $Finder = Crypt::decrypt($id);

        $payout = Withdrawal::find($Finder);

        if ($request->status == 'finalized') {
            $payout->description = $request->description;
            $payout->status = $request->status;

            $transaction = Transaction::create([
                'user_id' => $payout->user_id,
                'amount' => $payout->wallet === 'Naira' ? '₦' : '$'.$payout->amount,
                'reference' => Str::random(6),
                'status' => 'Withdrawal'
            ]);

            $payout->transaction_id = $transaction->id;
            $payout->save();

            $administrator = Admin::latest()->first();
            $user = User::where('id', $payout->user_id)->first();

            // send processed withdraw email notification here
            Mail::to($administrator->email)->send(new AdminApprovedWithdrawNotification($user, $payout->amount));
            Mail::to($user->email)->send(new UserApprovedWithdrawNotification($user, $payout->amount));

            OjafunnelNotification::create([
                'to' => $payout->user_id,
                'title' => config('app.name') . ' Withdrawal Alert',
                'body' => $request->description,
            ]);

            $user = User::where('id', $payout->user_id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            $this->fcm('Withdrawal Alert', $user);

            return back()->with([
                'type' => 'success',
                'message' => 'Request processed successfully.',
            ]);
        }
        if ($request->status == 'refunded') {
            $payout->description = $request->description;
            $payout->status = $request->status;
            $payout->save();

            $user = User::find($payout->user_id);
            if($payout->wallet == 'Naira')
            {
                $user->wallet += $payout->amount;
            } else {
                $user->dollar_wallet += $payout->amount;
            }
            $user->save();

            Transaction::create([
                'user_id' => $payout->user_id,
                'amount' => $payout->wallet === 'Naira' ? '₦' : '$'.$payout->amount,
                'reference' => 'Withdrawal request of ' . $payout->wallet === 'Naira' ? '₦' : '$'.$payout->amount . ' has been refunded',
                'status' => 'Withdraw Refunded'
            ]);

            OjafunnelNotification::create([
                'to' => $payout->user_id,
                'title' => config('app.name') . ' Withdrawal Alert',
                'body' => $request->description,
            ]);

            $user = User::where('id', $payout->user_id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            $this->fcm('Withdrawal Alert', $user);

            return back()->with([
                'type' => 'success',
                'message' => 'Request processed successfully.',
            ]);
        }

        return back()->with([
            'type' => 'danger',
            'message' => 'Status should either be finalized or refunded.',
        ]);
    }


    public function finalized_payouts()
    {
        $withdrawals = Withdrawal::latest()->where('status', 'finalized')->get();

        return view('Admin.payouts.finalized_payouts', [
            'withdrawals' => $withdrawals
        ]);
    }

    public function add_plan(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required'],
        ]);

        $plan = OjaPlan::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        OjaPlanParameter::create([
            'plan_id' => $plan->id
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Plan added successfully.',
        ]);
    }

    public function update_plan($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required'],
        ]);

        $finder = Crypt::decrypt($id);

        $plan = OjaPlan::find($finder);

        $plan->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Plan updated successfully.',
        ]);
    }

    public function delete_plan($id)
    {
        $finder = Crypt::decrypt($id);

        $plan = OjaPlan::find($finder);

        $interval = OjaPlanInterval::where('plan_id', $plan->id)->get();

        if ($interval->count() > 0) {
            foreach ($interval as $inter) {
                $inter->delete();
            }
        }

        $parameters = OjaPlanParameter::where('plan_id', $plan->id)->get();

        if ($parameters->count() > 0) {
            foreach ($parameters as $para) {
                $para->delete();
            }
        }

        $plan->delete();
        return back()->with([
            'type' => 'success',
            'message' => 'Plan deleted successfully.',
        ]);
    }

    public function enable_plan($id)
    {
        $finder = Crypt::decrypt($id);

        $plan = OjaPlan::find($finder);

        $plan->update([
            'is_enabled' => true
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Plan enabled successfully.',
        ]);
    }

    public function disable_plan($id)
    {
        $finder = Crypt::decrypt($id);

        $plan = OjaPlan::find($finder);

        $plan->update([
            'is_enabled' => false
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Plan disabled successfully.',
        ]);
    }

    public function plan_parameters($id)
    {
        $finder = Crypt::decrypt($id);

        $plan = OjaPlan::find($finder);

        // return $plan;
        $parameters = OjaPlanParameter::where('plan_id', $plan->id)->first();

        if ($parameters == null) {
            $parameters = OjaPlanParameter::create([
                'plan_id' => $plan->id
            ]);

            return view('Admin.plan.plan_parameter', [
                'plan' => $plan,
                'parameters' => $parameters
            ]);
        } else {
            return view('Admin.plan.plan_parameter', [
                'plan' => $plan,
                'parameters' => $parameters
            ]);
        }
    }

    public function add_plan_parameter($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $parameters = OjaPlanParameter::find($finder);

        // return $parameters;

        $parameters->update([
            'page_builder' => $request->page_builder,
            'funnel_builder' => $request->funnel_builder,
            'wa_number' =>  $request->whatsapp_number,
            'sms_contact_list' => $request->sms_contact_list,
            'sms_automation' => $request->sms_automation,
            'whatsapp_automation' => $request->whatsapp_automation,
            'store' => $request->store,
            'shop' => $request->shop,
            'products' => $request->product,
            'courses' => $request->course,
            'birthday_contact_list' => $request->birthday_contact_list,
            'birthday_automation' => $request->birthday_automation
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Plan parameters updated successfully.',
        ]);
    }

    public function plan_interval($id)
    {
        $finder = Crypt::decrypt($id);

        $plan = OjaPlan::find($finder);

        return view('Admin.plan.plan_interval', [
            'plan' => $plan
        ]);
    }

    public function add_plan_interval($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $plan = OjaPlan::find($finder);

        if ($request->currency == 'NGN') {
            OjaPlanInterval::create([
                'plan_id' => $plan->id,
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => '₦'
            ]);
        }

        if ($request->currency == 'USD') {
            OjaPlanInterval::create([
                'plan_id' => $plan->id,
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => '$'
            ]);
        }

        // if ($request->currency == 'EUR') {
        //     OjaPlanInterval::create([
        //         'plan_id' => $plan->id,
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => '€'
        //     ]);
        // }

        // if ($request->currency == 'INR') {
        //     OjaPlanInterval::create([
        //         'plan_id' => $plan->id,
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => '₹'
        //     ]);
        // }

        // if ($request->currency == 'PKR') {
        //     OjaPlanInterval::create([
        //         'plan_id' => $plan->id,
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => 'PKR'
        //     ]);
        // }

        // if ($request->currency == 'AED') {
        //     OjaPlanInterval::create([
        //         'plan_id' => $plan->id,
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => 'د.إ'
        //     ]);
        // }

        // if ($request->currency == 'BRL') {
        //     OjaPlanInterval::create([
        //         'plan_id' => $plan->id,
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => 'R$'
        //     ]);
        // }

        // if ($request->currency == 'MYR') {
        //     OjaPlanInterval::create([
        //         'plan_id' => $plan->id,
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => 'RM'
        //     ]);
        // }

        // if ($request->currency == 'SGD') {
        //     OjaPlanInterval::create([
        //         'plan_id' => $plan->id,
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => 'S$'
        //     ]);
        // }

        // if ($request->currency == 'EUR') {
        //     OjaPlanInterval::create([
        //         'plan_id' => $plan->id,
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => '£'
        //     ]);
        // }


        return back()->with([
            'type' => 'success',
            'message' => 'Plan interval added successfully.',
        ]);
    }

    public function update_plan_interval($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $interval = OjaPlanInterval::find($finder);

        if ($request->currency == 'NGN') {
            $interval->update([
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => '₦'
            ]);
        }

        if ($request->currency == 'USD') {
            $interval->update([
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => '$'
            ]);
        }

        // if ($request->currency == 'EUR') {
        //     $interval->update([
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => '€'
        //     ]);
        // }

        // if ($request->currency == 'INR') {
        //     $interval->update([
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => '₹'
        //     ]);
        // }

        // if ($request->currency == 'PKR') {
        //     $interval->update([
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => 'PKR'
        //     ]);
        // }

        // if ($request->currency == 'AED') {
        //     $interval->update([
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => 'د.إ'
        //     ]);
        // }

        // if ($request->currency == 'BRL') {
        //     $interval->update([
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => 'R$'
        //     ]);
        // }

        // if ($request->currency == 'MYR') {
        //     $interval->update([
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => 'RM'
        //     ]);
        // }

        // if ($request->currency == 'SGD') {
        //     $interval->update([
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => 'S$'
        //     ]);
        // }

        // if ($request->currency == 'EUR') {
        //     $interval->update([
        //         'price' => $request->price,
        //         'type' => $request->type,
        //         'currency' => $request->currency,
        //         'currency_sign' => '£'
        //     ]);
        // }


        return back()->with([
            'type' => 'success',
            'message' => 'Plan interval updated successfully.',
        ]);
    }

    public function delete_plan_interval($id)
    {
        $finder = Crypt::decrypt($id);

        OjaPlanInterval::find($finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Plan interval deleted successfully.',
        ]);
    }

    public function update_birthday($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $bd = BirthdayAutomation::findOrFail($finder);
        $bd->title = $request->title;
        $bd->sms_type = $request->sms_type;
        $bd->message = $request->message;
        $bd->sender_name = $request->sender_name;
        $bd->start_date = $request->start_date;
        $bd->end_date = $request->end_date;
        $bd->action = $request->action;
        $bd->save();

        return back()->with([
            'type' => 'success',
            'message' => 'Birthday Automation updated.'
        ]);
    }

    public function delete_birthday(Request $request)
    {
        $bd = BirthdayAutomation::findOrFail($request->id)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Birthday Automation deleted.'
        ]);
    }

    public function integration_email_admin_create(Request $request)
    {
        $request->validate([
            'host' => 'required',
            'port' => 'required|numeric',
            'username' => 'required|string',
            'password' => 'required',
            'encryption' => 'required|string',
            'from_email' => 'required|email',
            'from_name' => 'required|string',
            'replyto_email' => 'required|string',
            'replyto_name' => 'required|string',
            'type' => 'required',
        ]);

        $kit = new EmailKit();
        $kit->account_id = Auth::guard('admin')->user()->id;
        $kit->is_admin = true;
        $kit->host = $request->host;
        $kit->port = $request->port;
        $kit->username = $request->username;
        $kit->password = $request->password;
        $kit->encryption = $request->encryption;
        $kit->from_email = $request->from_email;
        $kit->from_name = $request->from_name;
        $kit->replyto_email = $request->replyto_email;
        $kit->replyto_name = $request->replyto_name;
        $kit->type = $request->type;
        $kit->sent = 0;
        $kit->bounced = 0;
        $kit->save();

        return back()->with([
            'type' => 'success',
            'message' => $kit->type . ' Integration Created Successfully!'
        ]);
    }

    public function integration_email_admin_update(Request $request)
    {
        $request->validate([
            'host' => 'required',
            'port' => 'required|numeric',
            'username' => 'required|string',
            'password' => 'required',
            'encryption' => 'required|string',
            'from_email' => 'required|email',
            'from_name' => 'required|string',
            'replyto_name' => 'required|string',
            'replyto_email' => 'required|string',
        ]);

        $email_kit = EmailKit::where(['id' => $request->id, 'account_id' => Auth::guard('admin')->user()->id, 'is_admin' => true]);

        if (!$email_kit->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Error occured'
            ]);
        }

        $email_kit->update([
            'host' =>  $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_email' => $request->from_email,
            'from_name' => $request->from_name,
            'replyto_name' => $request->replyto_name,
            'replyto_email' => $request->replyto_email,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Email kit updated successfully'
        ]);
    }

    public function integration_email_admin_delete(Request $request)
    {
        $email_kit = EmailKit::where(['id' => $request->id, 'account_id' => Auth::guard('admin')->user()->id, 'is_admin' => true]);

        if ($request->delete != 'DELETE') {
            return back()->with([
                'type' => 'danger',
                'message' => 'Please type DELETE to confirm.'
            ]);
        }

        if (!$email_kit->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Error occured'
            ]);
        }

        $email_kit_in_use_emailcampaign = EmailCampaign::where('email_kit_id', $email_kit->first()->id)->get();
        $email_kit_in_use_birthdayauto = BirthdayAutomation::where('email_kit_id', $email_kit->first()->id)->get();

        if (count($email_kit_in_use_emailcampaign) > 0) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Email kit is in use in email campaign section. Please delete all the email campaign using this kit to continue.'
            ]);
        }

        if (count($email_kit_in_use_birthdayauto) > 0) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Email kit is in use in birthday module. Please delete all the birthday using this kit to continue.'
            ]);
        }

        // delete model
        $email_kit->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Email kit deleted successfully'
        ]);
    }

    public function integration_email_admin_master(Request $request)
    {
        $email_kit = EmailKit::where(['account_id' => Auth::guard('admin')->user()->id, 'is_admin' => true]);
        $_email_kit = EmailKit::where(['id' => $request->id, 'account_id' => Auth::guard('admin')->user()->id, 'is_admin' => true]);

        if (!$email_kit->exists() || !$_email_kit->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Error occured'
            ]);
        }

        $email_kit->update(['master' => false]);
        $_email_kit->update(['master' => true]);

        return back()->with([
            'type' => 'success',
            'message' => 'Email kit has been assigned master successfully'
        ]);
    }

    public function user_list()
    {
        $lists = ListManagement::latest()->get();

        return view('Admin.list-management.index', [
            'lists' => $lists
        ]);
    }

    public function view_list($id)
    {
        $finder = Crypt::decrypt($id);

        $list = ListManagement::find($finder);

        $lists = ListManagementContact::where('list_management_id', $finder)->get();
        $list_tags = "";
        foreach($lists as $list1){
            if($list1->tags !== null){
                $list_tags .= $list1->tags.",";
            }
        }
        $list_tags = str_replace(", ", ",", $list_tags);
        $list_tags = array_unique(explode(',', $list_tags));

        $arrs=[];
        foreach($list_tags as $list_tag){
            if($list_tag !== ""){
                $arrs[] = $list_tag;
            }
        }
        $data['tags'] = $arrs;

        return view('Admin.list-management.view')->with([
            'list' => $list,
            'tags1' => $data
        ]);
    }

    public function edit_list($id)
    {
        $finder = Crypt::decrypt($id);

        $list = ListManagement::find($finder);

        return view('Admin.list-management.edit')->with([
            'list' => $list
        ]);
    }

    public function enable_list($id)
    {
        $finder = Crypt::decrypt($id);

        $list = ListManagement::find($finder);

        $list->update([
            'status' => true
        ]);


        $names = User::find($list->user_id)->first_name.' '.User::find($list->user_id)->first_name;
        $email = User::find($list->user_id)->email;
        // $email = "donchibobo@gmail.com";
        $list_name = ucwords($list->name);
        $message = "Your list $list_name has been approved and is now available for other subscribers";
        $title = "List activated successfully.";

        Mail::to($email)->send(new UserApprovedNotification($names, $message, $title));

        return back()->with([
            'type' => 'success',
            'message' => 'List activated successfully.',
        ]);
    }

    public function disable_list($id)
    {
        $finder = Crypt::decrypt($id);

        $list = ListManagement::find($finder);

        $list->update([
            'status' => false
        ]);

        $names = User::find($list->user_id)->first_name.' '.User::find($list->user_id)->first_name;
        $email = User::find($list->user_id)->email;
        // $email = "donchibobo@gmail.com";
        $list_name = ucwords($list->name);
        $message = "Your list $list_name has been declined. Please contact the admin for any enquiries, thank you!";
        $title = "List disactivated successfully.";

        Mail::to($email)->send(new UserApprovedNotification($names, $message, $title));

        return back()->with([
            'type' => 'success',
            'message' => 'List disactivated successfully.',
        ]);
    }

    public function update_list($id, Request $request)
    {
        $this->validate($request, [
            'name'         => 'required|max:250',
            'display_name' => 'required|max:250',
            'description' => 'required|max:250',
        ]);

        $finder = Crypt::decrypt($id);

        $list = ListManagement::find($finder);

        if (empty($request->slug))
        {
            $list->update([
                'uid' => Str::slug($request->display_name),
                'name' => $request->name,
                'display_name' => $request->display_name,
                'slug' => $request->slug,
                'description' => $request->description
            ]);
        } else {
            if($list->slug == $request->slug)
            {
                $list->update([
                    'uid' => Str::slug($request->display_name),
                    'name' => $request->name,
                    'display_name' => $request->display_name,
                    'slug' => Str::slug($request->display_name).mt_rand(1000, 9999),
                    'description' => $request->description
                ]);
            } else {
                $this->validate($request, [
                    'slug' => 'max:250|alpha_dash|unique:list_management',
                ]);

                $list->update([
                    'uid' => Str::slug($request->display_name),
                    'name' => $request->name,
                    'display_name' => $request->display_name,
                    'slug' => Str::slug($request->display_name).mt_rand(1000, 9999),
                    'description' => $request->description
                ]);
            }
        }

        return redirect()->route('admin.user.list')->with([
            'type' => 'success',
            'message' => 'List updated!'
        ]);
    }

    public function delete_list($id)
    {
        $finder = Crypt::decrypt($id);

        $list = ListManagement::find($finder);
        $contact = ListManagementContact::where('list_management_id', $list->id)->get()->count();

        if ($contact > 0) {
            $contact->delete();
        }

        $list->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'List deleted!'
        ]);
    }

    public function edit_contact($id)
    {
        $finder = Crypt::decrypt($id);

        $contact = ListManagementContact::find($finder);

        return view('Admin.list-management.contacts.edit')->with([
            'contact' => $contact
        ]);
    }

    function email_veriication($email)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=$email",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: hh1kBNxCPLAwYaePOR55kuyy3mT7zxow"
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $json = json_decode($response, true);

        // dd($json);

        if ($json !== null) {
            if (in_array('format_valid', $json)) {
                if ($json['format_valid'] == true) {
                    return 'true';
                }
            }
            if (in_array('success', $json)) {
                if ($json['success'] == false) {
                    return 'invalid';
                }
            }
        }

        return 'invalid';
    }

    public function update_contact($id, Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:250',
            'email' => 'required|email|max:250',
            'phone' => 'required|numeric',
        ]);

        $finder = Crypt::decrypt($id);

        $contact = ListManagementContact::find($finder);

        $emailVerification = $this->email_veriication($request->email);

        if ($emailVerification !== 'true') {
            return back()->with([
                'type' => 'danger',
                'message' => 'The email address is not valid.'
            ]);
        }

        $contact->update([
            'name' => $request->name,
            'email' => $request->email,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'country' => $request->country,
            'state' => $request->state,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'anniv_date' => $request->anniv_date,
        ]);

        return redirect()->route('admin.view.user.list', Crypt::encrypt($contact->list_management_id))->with([
            'type' => 'success',
            'message' => 'Contact updated!'
        ]);
    }

    public function delete_contact($id)
    {
        $finder = Crypt::decrypt($id);

        ListManagementContact::find($finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Contact deleted!'
        ]);
    }

    public function lms_xrate()
    {
        $xrates = CurrencyRate::all();

        return view('Admin.lms.xrate')->with([
            'records' => $xrates
        ]);
    }

    public function lms_xrate_submit(Request $request)
    {
        $records = CurrencyRate::all();

        if(sizeof($records) > 0) {

            CurrencyRate::where(['fx_symbol' => 'USD'])
                ->update(['fiat' => $request->dollar]);

            CurrencyRate::where(['fx_symbol' => 'GBP'])
                ->update(['fiat' => $request->pounds]);
        } else {
            $cur = new CurrencyRate;
            $cur->fx_symbol = 'USD';
            $cur->fx_amount = '1.00';
            $cur->fiat =  $request->dollar;
            $cur->save();

            $cur = new CurrencyRate;
            $cur->fx_symbol = 'GBP';
            $cur->fx_amount = '1.00';
            $cur->fiat =  $request->pounds;
            $cur->save();
        }

        return back()->with([
            'type' => 'success',
            'message' => 'Exchang rate updated!'
        ]);
    }


    public function integration_enable($id)
    {
        $idFinder = Crypt::decrypt($id);

        $integration = \App\Models\Integration::findorfail($idFinder);

        // $allIntegration = \App\Models\Integration::where('user_id', $integration->user_id)->where('status', 'Active')->get();

        // if($allIntegration->count() > 0)
        // {
        //     return back()->with([
        //         'type' => 'danger',
        //         'message' => 'User already have an active SMS Integration, deactivate and try again!'
        //     ]);
        // }

        $integration->update([
            'status' => 'Active'
        ]);

        return back()->with([
            'type' => 'success',
            'message' => $integration->type . ' Integration Enabled Successfully!'
        ]);
    }

    public function integration_disable($id)
    {
        $idFinder = Crypt::decrypt($id);

        $integration = \App\Models\Integration::findorfail($idFinder);

        $integration->update([
            'status' => 'Inactive'
        ]);

        return back()->with([
            'type' => 'success',
            'message' => $integration->type . ' Integration Disabled Successfully!'
        ]);
    }

    public function integration_delete($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if ($request->delete_field == "DELETE") {
            $idFinder = Crypt::decrypt($id);

            \App\Models\Integration::findorfail($idFinder)->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Integration Deleted Successfully!'
            ]);
        }

        return back()->with([
            'type' => 'danger',
            'message' => "Field doesn't match, Try Again!"
        ]);
    }

    public function sendNewsletter(Request $request)
    {
        $this->validate($request, [
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required'],
            'attachment' => ['nullable', 'file', 'max:5120'], // Max size in kilobytes (5MB = 5120KB)
        ]);

        $subscribers = Newsletter::all();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewsletterMail($request->subject, $request->message, $request->file('attachment')));
        }

        return back()->with([
            'type' => 'success',
            'message' => 'Newsletter sent successfully!'
        ]);
    }

    public function download($filename)
    {
        $path = 'attachment/' . $filename;

        return response()->download(storage_path('app/public/' . $path), $filename);
    }

    public function payment_gateway()
    {
        $gateways = PaymentGateway::latest()->get();

        return view('Admin.gateway.payment_gateway', [
            'gateways' => $gateways
        ]);
    }

    public function viewPaymentGateway($id)
    {
        // Fetch PaymentGateway details from the database
        $paymentGateway = PaymentGateway::find($id);

        // You can return a view or JSON response based on your needs
        return response()->json($paymentGateway);
    }

    public function updatePaymentGateway(Request $request)
    {
        $this->validate($request, [
            'id' => ['required', 'integer'],
        ]);

        $gateway = PaymentGateway::find($request->id);

        $gateway->update([
            'PAYSTACK_PUBLIC_KEY' => $request->PAYSTACK_PUBLIC_KEY,
            'PAYSTACK_SECRET_KEY' => $request->PAYSTACK_SECRET_KEY,
            'FLW_PUBLIC_KEY' => $request->FLW_PUBLIC_KEY,
            'FLW_SECRET_KEY' => $request->FLW_SECRET_KEY,
            'PAYPAL_MODE' => $request->PAYPAL_MODE,
            'PAYPAL_CURRENCY' => $request->PAYPAL_CURRENCY,
            'PAYPAL_SANDBOX_API_CERTIFICATE' => $request->PAYPAL_SANDBOX_API_CERTIFICATE,
            'PAYPAL_CLIENT_ID' => $request->PAYPAL_CLIENT_ID,
            'PAYPAL_CLIENT_SECRET' => $request->PAYPAL_CLIENT_SECRET,
            'STRIPE_KEY' => $request->STRIPE_KEY,
            'STRIPE_SECRET' => $request->STRIPE_SECRET,
            'status' => $request->status,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => $gateway->name .' update successful.'
        ]);
    }

    public function general_exchange_rate()
    {
        $xrates = GeneralExchangeRate::all();

        return view('admin.general_xrate', [
            'records' => $xrates
        ]);
    }

    public function add_general_exchange_rate(Request $request)
    {
        $this->validate($request, [
            'from_currency' => ['required'],
            'from_amount' => ['required', 'integer'],
            'to_currency' => ['required'],
            'to_amount' => ['required', 'integer'],
        ]);

        $check = GeneralExchangeRate::where(['primary_currency' => $request->from_currency, 'secondary_currency' => $request->to_currency])->exists();

        if($check > 0)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'Exchange currency already exist.'
            ]);
        }

        GeneralExchangeRate::create([
            'primary_currency' => $request->from_currency,
            'fx_amount' => $request->from_amount,
            'secondary_currency' => $request->to_currency,
            'fiat' => $request->to_amount,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Rate Added.'
        ]);
    }

    public function update_general_exchange_rate(Request $request, $id)
    {
        $finder = Crypt::decrypt($request->id);

        $rate = GeneralExchangeRate::find($finder)->update([
            'fx_amount' => $request->from_amount,
            'fiat' => $request->to_amount,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Rate Updated.'
        ]);
    }

    public function explainer_contents()
    {
        $explainers = ExplainerContent::latest()->get();

        return view('Admin.explainer.index', [
            'explainers' => $explainers
        ]);
    }

    public function update_explainer_content($id, Request $request)
    {
        $this->validate($request, [
            'video' => [
                'nullable',
                'mimes:mp4,avi,mov,wmv,flv,webm',
                'max:20480', // 20 megabytes (20 * 1024 KB)
            ],
            'text' => ['required'],
        ]);

        $finder = Crypt::decrypt($id);

        $explainer = ExplainerContent::find($finder);

        if (request()->hasFile('video')) {
            $filename = request()->video->getClientOriginalName();
            if($explainer->video) {
                Storage::delete(str_replace("storage", "public", $explainer->video));
            }
            request()->video->storeAs('explainer_videos', $filename, 'public');

            $explainer->update([
                'text' => $request->text,
                'video' => '/storage/explainer_videos/'.$filename,
            ]);
        } else {
            $explainer->update([
                'text' => $request->text,
            ]);
        }

        return back()->with([
            'type' => 'success',
            'message' => 'Updated successfully.'
        ]);
    }

    public function demoVideo()
    {
        $demo = DemoVideo::latest()->get();

        return view('Admin.explainer.demo', [
            'demo' => $demo
        ]);
    }

    public function updateDemoVideo(Request $request)
    {
        $this->validate($request, [
            'video' => [
                'nullable',
                'mimes:mp4',
                'max:30720', // 30 megabytes (30 * 1024 KB)
            ],
        ]);

        $demo = DemoVideo::first();

        if($demo)
        {
            $filename = request()->video->getClientOriginalName();

            if($demo->video) {
                Storage::delete(str_replace("storage", "public", $demo->video));
            }

            request()->video->storeAs('demo_videos', $filename, 'public');

            $demo->update([
                'video' => '/storage/demo_videos/'.$filename,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Updated successfully.'
            ]);
        }

        $filename = request()->video->getClientOriginalName();
        request()->video->storeAs('demo_videos', $filename, 'public');

        DemoVideo::create([
            'video' => '/storage/demo_videos/'.$filename,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Updated successfully.'
        ]);

    }

    public function wa_automation(Request $request)
    {
        $admin_id = Auth::guard('admin')->user()->id;

        $whatsapp_numbers = WhatsappNumber::where('user_id', $admin_id)->orderBy('id', 'DESC')->get();

        $_whatsapp_numbers = $whatsapp_numbers->map(function ($whatsapp_number) {
            $full_jwt_session = explode(':', $whatsapp_number->full_jwt_session);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $full_jwt_session[1]
            ])->get(env('WA_BASE_ENDPOINT') . '/api/' . $full_jwt_session[0] . '/check-connection-session');
            $data = $response->json();

            // re-generate jwt
            if (array_key_exists('error', $data)) {
                $response = Http::post(
                    env('WA_BASE_ENDPOINT') . '/api/' . $whatsapp_number->phone_number . '/8KtworSulXYbbXKej0e9SjlcT3Y3UAeZsLx42Jx1CByXw4Fose/generate-token'
                );
                $data = $response->json();

                // update full_jwt_session
                $wa_number = WhatsappNumber::find($whatsapp_number->id);
                $wa_number->update([
                    'full_jwt_session' => $data['full']
                ]);

                $full_jwt_session = explode(':', $data['full']);
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $full_jwt_session[1]
                ])->get(env('WA_BASE_ENDPOINT') . '/api/' . $full_jwt_session[0] . '/check-connection-session');

                $data = $response->json();

                return [
                    'id' => $whatsapp_number->id,
                    'phone_number' => $whatsapp_number->phone_number,
                    'full_jwt_session' => $whatsapp_number->full_jwt_session,
                    'status' => $data['message'],
                    'created_at' => $whatsapp_number->created_at,
                    'updated_at' => $whatsapp_number->updated_at
                ];
            }

            return [
                'id' => $whatsapp_number->id,
                'phone_number' => $whatsapp_number->phone_number,
                'full_jwt_session' => $whatsapp_number->full_jwt_session,
                'status' => $data['message'],
                'created_at' => $whatsapp_number->created_at,
                'updated_at' => $whatsapp_number->updated_at
            ];
        })->all();


        return view('Admin.automation.broadcast.wa-automation', ['whatsapp_numbers' => $_whatsapp_numbers]);
    }

    public function generate_wa_qr(Request $request)
    {
        $full_jwt_session = explode(':', $request->full_jwt_session);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $full_jwt_session[1]
        ])->post(env('WA_BASE_ENDPOINT') . '/api/' . $full_jwt_session[0] . '/start-session');
        $data = $response->json();

        return response()->json($data, 200);
    }

    public function logout_wa_session(Request $request)
    {
        $full_jwt_session = explode(':', $request->full_jwt_session);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $full_jwt_session[1]
        ])->post(env('WA_BASE_ENDPOINT') . '/api/' . $full_jwt_session[0] . '/logout-session');
        $data = $response->json();

        return response()->json($data, 200);
    }

    public function check_wa_session_connection(Request $request)
    {
        $full_jwt_session = explode(':', $request->full_jwt_session);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $full_jwt_session[1]
        ])->get(env('WA_BASE_ENDPOINT') . '/api/' . $full_jwt_session[0] . '/check-connection-session');

        $data = $response->json();

        return response()->json($data, 200);
    }

    public function create_wa_number(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|unique:whatsapp_numbers'
        ]);

        // if (WhatsappNumber::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->wa_number) {
        //     return back()->with([
        //         'type' => 'danger',
        //         'message' => 'Upgrade to enjoy more access'
        //     ]);
        // }

        $wa_number = new WhatsappNumber();
        $wa_number->phone_number = $request->phone_number;

        $response = Http::post(
            env('WA_BASE_ENDPOINT') . '/api/' . $request->phone_number . '/8KtworSulXYbbXKej0e9SjlcT3Y3UAeZsLx42Jx1CByXw4Fose/generate-token'
        );
        $data = $response->json();

        $wa_number->full_jwt_session = $data['full'];
        $wa_number->user_id = Auth::guard('admin')->user()->id;

        $wa_number->save();

        return back()->with([
            'type' => 'success',
            'message' => 'The WA Number added successfully.'
        ]);
    }

    public function update_wa_number(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|unique:whatsapp_numbers'
        ]);

        $wa_number = WhatsappNumber::find($request->id);

        $response = Http::post(
            env('WA_BASE_ENDPOINT') . '/api/' . $request->phone_number . '/8KtworSulXYbbXKej0e9SjlcT3Y3UAeZsLx42Jx1CByXw4Fose/generate-token'
        );
        $data = $response->json();

        $wa_number->update([
            'phone_number' => $request->phone_number,
            'full_jwt_session' => $data['full'],
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'The WA Number updated successfully.'
        ]);
    }

    public function delete_wa_number(Request $request)
    {
        $wa_number = WhatsappNumber::find($request->id);

        $wa_number->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'The WA Number deleted successfully.'
        ]);
    }

    public function broadcast_wa_message(Request $request)
    {
        $admin_id = Auth::guard('admin')->user()->id;
        $broadcasts = \App\Models\WhatappBroadcast::where(['user_id' => $admin_id])->orderBy('id', 'DESC')->get();

        return view('Admin.automation.broadcast.whatsappBroadcast', [
            'broadcasts' => $broadcasts
        ]);
    }

    public function broadcast_wa_message_create(Request $request)
    {

        $admin_id = Auth::guard('admin')->user()->id;

        if($request->method() == 'POST')
        {
            $whatsapp_account = explode('-', $request->whatsapp_account);

            if ($whatsapp_account[2] != "Connected") return back()->with([
                'type' => 'danger',
                'message' => 'The WA account is not connected. Connect and try again'
            ])->withInput();


            // get contact list
            // $contacts = ContactNumber::latest()->where('contact_list_id', $request->contact_list)->get();
            $contacts = ListManagementContact::latest()->where('list_management_id', $request->contact_list)->whereNotNull('phone')->where('subscribe', true)->get();

            $new_time = Carbon::now()->addMinute(2)->format('h:i:s');

            $broadcast = new \App\Models\WhatappBroadcast;
            $broadcast->user_id = Auth::guard('admin')->user()->id; //auth()->user()->id;
            $broadcast->list_mgt_id = $request->contact_list;
            $broadcast->sender_id = $whatsapp_account[1];
            $broadcast->message = $request->template1_msg_series;
            $broadcast->date = date('Y-m-d');
            $broadcast->time = $new_time; //date('h:i:s');
            $broadcast->ContactCount = sizeof($contacts);
            $broadcast->save();


            return back()->with([
                'type' => 'success',
                'message' => 'Broadcast message sent successfully.'
            ]);
        }

        $whatsapp_numbers = WhatsappNumber::where('user_id', $admin_id)->orderBy('id', 'DESC')->get();

        $_whatsapp_numbers = $whatsapp_numbers->map(function ($whatsapp_number) {
            $full_jwt_session = explode(':', $whatsapp_number->full_jwt_session);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $full_jwt_session[1]
            ])->get(env('WA_BASE_ENDPOINT') . '/api/' . $full_jwt_session[0] . '/check-connection-session');
            $data = $response->json();

            // re-generate jwt
            if (array_key_exists('error', $data)) {
                $response = Http::post(
                    env('WA_BASE_ENDPOINT') . '/api/' . $whatsapp_number->phone_number . '/8KtworSulXYbbXKej0e9SjlcT3Y3UAeZsLx42Jx1CByXw4Fose/generate-token'
                );
                $data = $response->json();

                // update full_jwt_session
                $wa_number = WhatsappNumber::find($whatsapp_number->id);
                $wa_number->update([
                    'full_jwt_session' => $data['full']
                ]);

                $full_jwt_session = explode(':', $data['full']);
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $full_jwt_session[1]
                ])->get(env('WA_BASE_ENDPOINT') . '/api/' . $full_jwt_session[0] . '/check-connection-session');

                $data = $response->json();

                return [
                    'id' => $whatsapp_number->id,
                    'phone_number' => $whatsapp_number->phone_number,
                    'full_jwt_session' => $whatsapp_number->full_jwt_session,
                    'status' => $data['message'],
                    'created_at' => $whatsapp_number->created_at,
                    'updated_at' => $whatsapp_number->updated_at
                ];
            }

            return [
                'id' => $whatsapp_number->id,
                'phone_number' => $whatsapp_number->phone_number,
                'full_jwt_session' => $whatsapp_number->full_jwt_session,
                'status' => $data['message'],
                'created_at' => $whatsapp_number->created_at,
                'updated_at' => $whatsapp_number->updated_at
            ];
        })->all();

        $contact_lists = \App\Models\ListManagement::all();


        return view('Admin.automation.broadcast.whatsappBroadcast-create', [
            'whatsapp_numbers' => $_whatsapp_numbers,
            'contact_lists' => $contact_lists,
        ]);
    }
}
