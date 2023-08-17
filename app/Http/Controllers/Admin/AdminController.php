<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
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
use App\Mail\AdminApprovedWithdrawNotification;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AdminController extends Controller
{
    function fcm($body, $firebaseToken)
    {
        $SERVER_API_KEY = config('app.fcm_token');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => config('app.name'),
                "body" => $body,
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
        $result = curl_exec($ch);

        return $result;
    }

    public function profile_update(Request $request)
    {
        $ad = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $ad->name = $request->name;
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
        return view('Admin.user.view-users');
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
        return view('Admin.affiliateList');
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
        $data = array(
            'name' => User::find($user->user_id)->first_name.' '.User::find($user->user_id)->first_name,
            'email' => User::find($user->user_id)->email,
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
        // $data = [];

        // $users = User::get();

        // foreach($users as $user)
        // {

        //     $id1 = MessageUser::where('sender_id', $user->id)->where('reciever_id', Auth::guard('admin')->user()->id)->pluck('id');
        //     $id2 = MessageUser::where('reciever_id', Auth::guard('admin')->user()->id)->where('sender_id', $user->id)->pluck('id');

        // $data['unread'] = $id1;
        // }

        // $allMessages[] = Message::where('message_users_id', $id1)->orWhere('message_users_id', $id2)->orderBy('id', 'asc')->get();

        // return $id2;

        return view('Admin.support.chatSupport');
    }

    public function check($recieverId)
    {
        $senderId = Auth::guard('admin')->user()->id;

        $data = [
            'sender_id' => $senderId,
            'reciever_id' => $recieverId
        ];
        $data2 = [
            'sender_id' => $recieverId,
            'reciever_id' => $senderId
        ];

        $checkExist = MessageUser::where('sender_id', $senderId)->where('reciever_id', $recieverId)->first();

        if (!$checkExist) {
            $createConvo = MessageUser::create($data);
            $createConvo2 = MessageUser::create($data2);
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

            $data = [
                'message_users_id' => $request->convo_id,
                'message' => $request->message
            ];

            $sendMessage = Message::create($data);

            $this->fcm('Message from ' . Auth::guard('admin')->user()->name . ': ' . $request->message, $user);

            if ($sendMessage) {
                return "Message Sent";
            } else {
                return "Error sending message.";
            }
        } else {
            $user = User::where('id', $messageUser->sender_id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            $data = [
                'message_users_id' => $request->convo_id,
                'message' => $request->message
            ];

            $sendMessage = Message::create($data);

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

        $id1 = MessageUser::where('sender_id', $sender)->where('reciever_id', $reciever)->pluck('id');
        $id2 = MessageUser::where('reciever_id', $sender)->where('sender_id', $reciever)->pluck('id');

        $allMessages = Message::where('message_users_id', $id1)->orWhere('message_users_id', $id2)->orderBy('id', 'asc')->get();

        // foreach($allMessages as $row){
        //     if($id1[0]==$row['message_users_id']){$boxType = "p-2 recieverBox ml-auto";}else{$boxType = "float-left p-2 mb-2 senderBox";}
        //     echo "<div class='p-2 d-flex'>";
        //     echo "<div class='".$boxType."'>";
        //     echo "<p>".$row['message']."</p>";
        //     echo "</div>";
        //     echo "</div>";
        // }
        $tobePassed = [$allMessages, $id1];
        return $tobePassed;
    }

    public function retrieveNew($reciever, $sender, $lastId)
    {
        $id1 = MessageUser::where('sender_id', $sender)->where('reciever_id', $reciever)->pluck('id');
        $id2 = MessageUser::where('reciever_id', $sender)->where('sender_id', $reciever)->pluck('id');

        $allMessages = Message::where('id', '>=', $lastId)->where('message_users_id', $id2)->orderBy('id', 'asc')->get();

        return $allMessages;
    }

    public function view_email_kits()
    {
        $admin_email_integrations = EmailKit::latest()->where(['account_id' => Auth::guard('admin')->user()->id, 'is_admin' => true])->get();

        return view('Admin.email-marketing.email-kits.index', [
            'admin_email_integrations' => $admin_email_integrations
        ]);
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
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);

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
        return view('Admin.payouts.pending_payouts');
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
                'amount' => $payout->amount,
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

            $user->wallet += $payout->amount;
            $user->save();

            Transaction::create([
                'user_id' => $payout->user_id,
                'amount' => $payout->amount,
                'reference' => 'Withdrawal request of ' . $payout->amount . ' has been refunded',
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
            'message' => 'Action failed.',
        ]);
    }

    public function transaction_confirm($id, $response, $status, $description)
    {
        $payout = Withdrawal::find($id);
        $user = User::find($payout->user_id);

        if ($payout->amount > $user->wallet) {
            return back()->with([
                'type' => 'danger',
                'message' => 'This user balance is not up to the requested withdrawal amount.'
            ]);
        }

        if ($status == 'finalized') {
            $payout->description = $description;
            $payout->status = 'finalized';

            $transaction = Transaction::create([
                'user_id' => $payout->user_id,
                'amount' => $payout->amount,
                'reference' => $response,
                'status' => 'Withdrawal'
            ]);

            $payout->transaction_id = $transaction->id;
            $payout->save();

            $user->wallet -= $payout->amount;
            $user->save();

            Transaction::create([
                'user_id' => $payout->user_id,
                'amount' => $payout->amount,
                'reference' => 'Withdrawal request of ' . $payout->amount . ' has been paid',
                'status' => 'Withdrawal Paid'
            ]);

            OjafunnelNotification::create([
                'to' => $payout->user_id,
                'title' => config('app.name') . ' Withdrawal Alert',
                'body' => $description,
            ]);

            $user = User::where('id', $payout->user_id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            $this->fcm('Withdrawal Alert', $user);

            return back()->with([
                'type' => 'success',
                'message' => 'Request processed successfully.',
            ]);
        }
        if ($status == 'refunded') {
            $payout->description = $description;
            $payout->status = 'refunded';
            $payout->save();

            $user->wallet += $payout->amount;
            $user->save();

            Transaction::create([
                'user_id' => $payout->user_id,
                'amount' => $payout->amount,
                'reference' => 'Withdrawal request of ' . $payout->amount . ' has been refunded',
                'status' => 'Withdrawal Refunded'
            ]);

            OjafunnelNotification::create([
                'to' => $payout->user_id,
                'title' => config('app.name') . ' Withdrawal Alert',
                'body' => $description,
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
            'message' => 'Payment can be finalized or refunded.',
        ]);
    }

    public function finalized_payouts()
    {
        return view('Admin.payouts.finalized_payouts');
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

        if ($request->currency == 'EUR') {
            OjaPlanInterval::create([
                'plan_id' => $plan->id,
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => '€'
            ]);
        }

        if ($request->currency == 'INR') {
            OjaPlanInterval::create([
                'plan_id' => $plan->id,
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => '₹'
            ]);
        }

        if ($request->currency == 'PKR') {
            OjaPlanInterval::create([
                'plan_id' => $plan->id,
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => 'PKR'
            ]);
        }

        if ($request->currency == 'AED') {
            OjaPlanInterval::create([
                'plan_id' => $plan->id,
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => 'د.إ'
            ]);
        }

        if ($request->currency == 'BRL') {
            OjaPlanInterval::create([
                'plan_id' => $plan->id,
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => 'R$'
            ]);
        }

        if ($request->currency == 'MYR') {
            OjaPlanInterval::create([
                'plan_id' => $plan->id,
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => 'RM'
            ]);
        }

        if ($request->currency == 'SGD') {
            OjaPlanInterval::create([
                'plan_id' => $plan->id,
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => 'S$'
            ]);
        }

        if ($request->currency == 'EUR') {
            OjaPlanInterval::create([
                'plan_id' => $plan->id,
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => '£'
            ]);
        }


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

        if ($request->currency == 'EUR') {
            $interval->update([
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => '€'
            ]);
        }

        if ($request->currency == 'INR') {
            $interval->update([
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => '₹'
            ]);
        }

        if ($request->currency == 'PKR') {
            $interval->update([
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => 'PKR'
            ]);
        }

        if ($request->currency == 'AED') {
            $interval->update([
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => 'د.إ'
            ]);
        }

        if ($request->currency == 'BRL') {
            $interval->update([
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => 'R$'
            ]);
        }

        if ($request->currency == 'MYR') {
            $interval->update([
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => 'RM'
            ]);
        }

        if ($request->currency == 'SGD') {
            $interval->update([
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => 'S$'
            ]);
        }

        if ($request->currency == 'EUR') {
            $interval->update([
                'price' => $request->price,
                'type' => $request->type,
                'currency' => $request->currency,
                'currency_sign' => '£'
            ]);
        }


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

        return view('Admin.list-management.view')->with([
            'list' => $list
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

}
