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
use App\Models\Chat;
use App\Models\PersonalChatroom;
use App\Events\AdminReceiveMessage;
use App\Events\AdminSendChat;
use App\Models\Category;
use App\Models\Course;
use App\Models\OjafunnelNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
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
        return view('Admin.support.chatSupport');
    }

    public function fetchAllusers()
    {
        $users = User::latest()->get(['id', 'first_name', 'last_name', 'email', 'photo']);

        return $users;
    }

    public function fetchAllRecentChats () 
    {
        // prepare an array to contain all of the responses
        $result = [];

        // get the chatroom record from this user
        $query = PersonalChatroom::where('user_id', Auth::user()->id)
                ->orWhere('admin_id', Auth::user()->id)
                ->get();

        if ($query) {
            foreach ($query as $chatroom) {

                // get the interlocutor's data
                if ($chatroom->admin_id == Auth::guard('admin')->user()->id) {
                    $friend = User::where('id', $chatroom->user_id)->first();
                } else {
                    $friend = Admin::where('id', $chatroom->admin_id)->first();
                }

                // get the most recent chat from the chatroom
                $latestChat = Chat::where('room_id', $chatroom['room_id'])
                                    ->latest()
                                    ->first();
                            
                // check how many unread chats
                $unreadChats = Chat::where('user_id', $friend['id'])
                                    ->where('room_id', $chatroom['room_id'])
                                    ->where('read_at', null)
                                    ->count();

                // if they already have chatted before
                if ($latestChat) {
                    $result[] = [
                        'user' => $friend,
                        'chat' => $latestChat,
                        'unread' => $unreadChats
                    ];
                    $result = array_reverse(array_values(Arr::sort($result, function ($key) {
                        return $key['chat']['created_at'];
                    })));
                } else {
                    // if this is the first time they create the chatroom
                    $result[] = [
                        'user' => $friend,
                        'chat' => [
                            'message' => null,
                            'created_at' => null,
                            'updated_at' => null,
                        ],
                        'unread' => 0
                    ];
                }
            }
    
            return $result;
        } else {
            return ['error' => 'You dont have any chat yet.'];
        }
    }

    public function startChat ($id, Request $request) 
    {
        $user = User::find($id);

        // check whether if this user and the targeted user already has a chatroom
        $isExist = PersonalChatroom::whereIn('user_id', [Auth::guard('admin')->user()->id, $user->id])
                                    ->whereIn('admin_id', [Auth::guard('admin')->user()->id, $user->id])
                                    ->count();

        if ($isExist > 0) 
        {
            // get the room id
            $room_id = PersonalChatroom::whereIn('user_id', [Auth::guard('admin')->user()->id, $user->id])
                                        ->whereIn('admin_id', [Auth::guard('admin')->user()->id, $user->id])
                                        ->first('room_id');
                                  
            // update the state of interlocutor's chat from unread to read
            Chat::where('user_id', $user->id)
                ->where('room_id', $room_id['room_id'])
                ->where('read_at', null)
                ->update(['read_at' => now()]);
                                        
            // fetch all of the chats from this chatroom
            $chats = Chat::where('room_id', $room_id['room_id'])->orderBy('created_at', 'asc')->get();

            // create an array to be sent as a HTTP response
            $data = [];
            $data['room_id'] = $room_id['room_id'];
            $data['user'] = User::find($user->id);
            
            if (count($chats) > 0) {
                foreach ($chats as $chat) {
                    $data['messages'][] = [
                        'id' => $chat->id,
                        'sender' => User::find($chat->user_id) ?? Admin::find($chat->admin_id),
                        'message' => $chat->message,
                        'attachment' => $chat->attachment,
                        'read_at' => $chat->read_at,
                        'time' => $chat->created_at
                    ];
                }    
            } else {
                $data['messages'] = [];
            }

            $data['exist'] = 1;
            
            return $data;
        } else 
        {
            // if they don't have a chatroom, then create one.
            $room_id = Auth::guard('admin')->user()->id . 'CHAT' . $user->id;
            PersonalChatroom::create([
                'room_id' => $room_id,
                'user_id' => $user->id,
                'admin_id' => Auth::guard('admin')->user()->id
            ]);

            $data = [];
            $data['room_id'] = $room_id;
            $data['user'] = User::find($user->id);
            $data['messages'] = [];
            $data['exist'] = 0;

            return $data;
        }
    }

    public function markAsRead (Request $request) 
    {
        if ($request->target_model == 'chat') {
            // set a value to the 'read_at' column
            Chat::where('id', $request->target_id)
                ->update(['read_at' => now()]);

            return ['message' => 'Chat with id ' . $request->target_id . ' has been updated.'];
        }

        if ($request->target_model == 'read') {
            // set a value to the 'read_at' column
            Chat::where('user_id', $request->target_id)
                ->update(['read_at' => now()]);

            return ['message' => 'Chat with id ' . $request->target_id . ' has been updated.'];
        }
    }

    public function sendMessage (Request $request) 
    {
        if($request->attachment == null)
        {
            $payload = Chat::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'room_id' => $request->room_id,
                'message' => $request->message
            ]);
    
            broadcast(new AdminSendChat($payload))->toOthers();
            // broadcast(new AdminReceiveMessage($payload))->toOthers();
    
            return ['status' => 'success'];
        } else {
            $this->validate($request, [
                'attachment' => 'required|mimes:jpeg,png,bmp,jpg,mp4,mov,ogg,qt,wmv,avi,m3u8,doc,docx,pdf,csv,xlsx,xlsb,xls,xlsm |max:50000',
            ]);

            $file = request()->attachment->getClientOriginalName();

            $filename = pathinfo($file, PATHINFO_FILENAME);
    
            $response = cloudinary()->uploadFile($request->file('attachment')->getRealPath(),
                            [
                                'folder' => config('app.name'),
                                "public_id" => $filename,
                                "use_filename" => TRUE,
                            ])->getSecurePath();
            
            $payload = $request->admin()->chats()->create([
                'room_id' => $request->room_id,
                'message' => $request->message,
                'attachment' => $response
            ]);
    
            broadcast(new SendChat($payload->load('admin')))->toOthers();
            broadcast(new ReceiveMessage($payload->load('admin')))->toOthers();
    
            return ['status' => 'success'];
        }
    }
    

    public function clearChat (Request $request) 
    {
        // if (Auth::check() && $request->csrf_token == csrf_token()) {
            $chats = Chat::where('room_id', $request->room_id)->get();

            foreach($chats as $chat)
            {
                // $token = explode('/', $chat->attachment);
                // $token2 = explode('.', $token[sizeof($token)-1]);

                // if($chat->attachment)
                // {
                //     cloudinary()->destroy('Trivhunt/'.$token2[0]);
                // }

                $chat->delete();
                
            }
            return ['message' => 'Chats have been deleted successfully.'];
        // }
    }

    public function deleteSingleChat (Request $request) 
    {
        $chat = Chat::find($request->id);

        // $token = explode('/', $chat->attachment);
        // $token2 = explode('.', $token[sizeof($token)-1]);

        // if($chat->attachment)
        // {
        //     cloudinary()->destroy('Trivhunt/'.$token2[0]);
        // }

        $chat->delete();

        return ['message' => 'Chat has been deleted successfully.'];
    }

    public function deleteChatroom (Request $request) 
    {
        // delete all chats in the particular chatroom
        $chats = Chat::where('room_id', $request->room_id)->get();

        foreach($chats as $chat)
        {
            // $token = explode('/', $chat->attachment);
            // $token2 = explode('.', $token[sizeof($token)-1]);

            // if($chat->attachment)
            // {
            //     cloudinary()->destroy('Trivhunt/'.$token2[0]);
            // }

            $chat->delete();
        }

        // delete the chatroom
        PersonalChatroom::where('room_id', $request->room_id)->delete();

        // return
        return ['status' => 'Chatroom has been deleted successfully.'];
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
}
