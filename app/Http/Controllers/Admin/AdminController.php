<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BirthdayAutomation;
use App\Models\OjafunnelMailSupport;
use App\Models\ReplyMailSupport;
use App\Models\SmsCampaign;
use App\Models\StoreOrder;
use App\Models\StoreProduct;
use App\Models\User;
use App\Models\Faq;
use App\Models\ContactUs;
use App\Models\Category;
use App\Models\Course;
use App\Models\Message;
use App\Models\MessageUser;
use App\Models\OjafunnelNotification;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

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
        $result = curl_exec ( $ch );

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

    public function transactions()
    {
        return view('Admin.transaction');
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

    public function course_detail()
    {
        return view('Admin.lms.viewCourse');
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

        return back()->with([
            'type' => 'success',
            'message' => 'Message replied successfully.',
        ]); 
    }

    public function send_email_to_user(Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required','string', 'max:255'],
            'subject' => ['required','string', 'max:255'],
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

    public function check($recieverId){
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

        if(!$checkExist){
            $createConvo = MessageUser::create($data);
            $createConvo2 = MessageUser::create($data2);
            return $createConvo->id;
        }else{
            return $checkExist->id;
        }
    }

    public function store(Request $request)
    {
        $messageUser = MessageUser::find($request->convo_id);

        if($messageUser->sender_id == Auth::guard('admin')->user()->id)
        {
            $user = User::where('id', $messageUser->reciever_id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            $data = [
                'message_users_id' => $request->convo_id,
                'message' => $request->message
            ];

            $sendMessage = Message::create($data);

            $this->fcm('Message from '.Auth::guard('admin')->user()->name.': '.$request->message, $user);

            if($sendMessage){
                return "Message Sent";
            }else{
                return "Error sending message.";
            }
        } else {
            $user = User::where('id', $messageUser->sender_id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            $data = [
                'message_users_id' => $request->convo_id,
                'message' => $request->message
            ];

            $sendMessage = Message::create($data);

            $this->fcm('Message from '.Auth::guard('admin')->user()->name.': '.$request->message, $user);

            if($sendMessage){
                return "Message Sent";
            }else{
                return "Error sending message.";
            }

        }
    }

    public function load($reciever, $sender){
        $boxType = "";

        $id1 = MessageUser::where('sender_id', $sender)->where('reciever_id',$reciever)->pluck('id');
        $id2 = MessageUser::where('reciever_id', $sender)->where('sender_id',$reciever)->pluck('id');

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

    public function retrieveNew($reciever, $sender, $lastId){
        $id1 = MessageUser::where('sender_id', $sender)->where('reciever_id',$reciever)->pluck('id');
        $id2 = MessageUser::where('reciever_id', $sender)->where('sender_id',$reciever)->pluck('id');

        $allMessages = Message::where('id','>=',$lastId)->where('message_users_id', $id2)->orderBy('id', 'asc')->get();

        return $allMessages;
    }

    public function sms_automation()
    {
        $smsAutomations = SmsCampaign::latest()->where('sms_type', 'plain')->get();
        return view('Admin.automation.smsAutomation', compact('smsAutomations'));
    }

    public function whatsapp_automation()
    {
        $whatsappAutomations = SmsCampaign::latest()->where('sms_type', 'whatsapp')->get();
        return view('Admin.automation.whatsappAutomation', compact('whatsappAutomations'));
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

    public function sales_analytics()
    {
        return view('Admin.salesAnalytics');
    }

    // EMAIL-MARKETING

    public function index()
    {
        return view('Admin.emailmarketing.SendingServer');
    }

    public function new_server()
    {
        return view('Admin.emailmarketing.NewServer');
    }

    public function choose_server()
    {
        return view('Admin.emailmarketing.ChooseServer');
    }

    public function main_bounce()
    {
        return view('Admin.emailmarketing.BounceHandler');
    }

    public function new_bounce()
    {
        return view('Admin.emailmarketing.NewBounce');
    }

    public function main_email()
    {
        return view('Admin.emailmarketing.EmailVerification');
    }

    public function create_new()
    {
        return view('Admin.emailmarketing.CreateNew');
    }

    public function backlist()
    {
        return view('Admin.emailmarketing.Backlist');
    }

    public function import_backlist()
    {
        return view('Admin.emailmarketing.ImportBacklist');
    }

    public function delivery_log()
    {
        return view('Admin.emailmarketing.DeliveryLog');
    }

    public function bounce_log()
    {
        return view('Admin.emailmarketing.BounceLog');
    }

    public function open_log()
    {
        return view('Admin.emailmarketing.OpenLog');
    }

    public function click_log()
    {
        return view('Admin.emailmarketing.ClickLog');
    }

    public function unsubscribe_log()
    {
        return view('Admin.emailmarketing.Unsubscribe');
    }

    public function generall()
    {
        return view('Admin.emailmarketing.General');
    }

    public function payment_gateway()
    {
        return view('Admin.emailmarketing.Payment');
    }

    public function plugin()
    {
        return view('Admin.emailmarketing.Plugin');
    }

    public function install_plugin()
    {
        return view('Admin.emailmarketing.AddPlugin');
    }

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

    public function page_builder_create(Request $request)
    {   
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'file_folder' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
        ]);

        if (str_contains($request->file_name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'file name invalid.'
            ]);
        }

        $file = $request->file_name.'.html';
        
        define('MAX_FILE_LIMIT', 1024 * 1024 * 2);//2 Megabytes max html file size
        
        $data = file_get_contents(resource_path('views/builder/new-page-blank-template.blade.php'));

        $html = substr($data, 0, MAX_FILE_LIMIT);

        $file = $this->sanitizeFileName($file);

        // $datum = strval($request->file_folder);

        $disk = Storage::build([
            'driver' => 'local',
            'root'   => public_path('pageBuilder') . '/'.$request->file_folder,
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
        
        if(!$disk->put($file, $html)){
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            return back()->with([
                'type' => 'danger',
                'message' => 'Error saving file  '.$file.'\nPossible causes are missing write permission or incorrect file path!'
            ]);
        } else {
            $page = Page::create([
                'user_id' => Auth::guard('admin')->user()->id,
                'title' => $request->title,
                'name' => $file,
                'folder' => $request->file_folder,
                'file_location' => config('app.url').'/pageBuilder/'.$request->file_folder.'/'.$file
            ]);

            return back()->with([
                'type' => 'success',
                'message' => $page->name.' created.'
            ]);
        };
    }

    function sanitizeFileName($file)
    {
        //sanitize, remove double dot .. and remove get parameters if any
        $file = preg_replace('@\?.*$@' , '', preg_replace('@\.{2,}@' , '', preg_replace('@[^\/\\a-zA-Z0-9\-\._]@', '', $file)));
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

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2);//2 Megabytes max html file size

        $html = "";

        if (isset($_POST['html']))
        {
            $html = substr($_POST['html'], 0, MAX_FILE_LIMIT);
        }

        $disk = public_path('pageBuilder/'.$page->folder.'/'.$page->name);

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
                'message' => 'file name invalid.'
            ]);
        }
         
        $idFinder = Crypt::decrypt($id);
        $page = Page::find($idFinder);

        $file = $request->name.'.html';
        
        $disk = public_path('pageBuilder/'.$page->folder.'/'.$page->name);

        rename ($disk, public_path('pageBuilder/'.$page->folder.'/'.$file));

        //Validate User
        if (request()->hasFile('thumbnail')) {
            $this->validate($request, [
                'thumbnail' => 'required|mimes:jpeg,png,jpg',
            ]);
            $filename = request()->thumbnail->getClientOriginalName();
            if($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }
            request()->thumbnail->storeAs('pages', $filename, 'public');

            $page->update([
                'thumbnail' => '/storage/pages/'.$filename,
                'name' => $file,
                'title' => $request->title,
                'file_location' => config('app.url').'/pageBuilder/'.$page->folder.'/'.$file
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Page updated successfully!'
            ]);
        }

        $page->update([
            'name' => $file,
            'title' => $request->title,
            'file_location' => config('app.url').'/pageBuilder/'.$page->folder.'/'.$file
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

        if($request->delete_field == "DELETE")
        {
            $idFinder = Crypt::decrypt($id);

            $page = Page::findorfail($idFinder);

            if($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }

            if($page->file_location) {
                File::deleteDirectory(public_path('pageBuilder/'.$page->folder));
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
        if($request->action == 'Publish')
        {
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

}
