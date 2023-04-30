<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Page;
use App\Models\Plan;
use App\Models\Shop;
use App\Models\User;
use App\Models\Admin;
use App\Models\Store;
use App\Models\Course;
use App\Models\Funnel;
use App\Models\OjaPlan;
use App\Models\Category;
use App\Models\EmailKit;
use App\Models\SmsQueue;
use App\Models\WaQueues;
use App\Models\ShopOrder;
use Tzsk\Sms\Facades\Sms;
use App\Models\BankDetail;
use App\Models\Enrollment;
use App\Models\FunnelPage;
use App\Models\StoreOrder;
use App\Models\Subscriber;
use App\Models\Integration;
use App\Models\Mailinglist;
use App\Models\SmsCampaign;
use App\Models\Transaction;
use App\Models\WaCampaigns;
use App\Models\StoreProduct;
use Illuminate\Http\Request;
use App\Models\ContactNumber;
use App\Models\EmailCampaign;
use App\Models\SmsAutomation;
use App\Models\WhatsappNumber;
use Illuminate\Support\Carbon;
use App\Models\OjaSubscription;
use App\Models\OjaPlanParameter;
use App\Models\PersonalChatroom;
use App\Models\EmailCampaignQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\ListManagementContact;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use App\Jobs\ProcessTemplate1BulkWAMessages;
use App\Jobs\ProcessTemplate2BulkWAMessages;
use App\Jobs\ProcessTemplate3BulkWAMessages;
use App\Models\Domain;

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
        $sunday = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        $monday = $sunday->copy()->addDays(1);
        $tuesday = $monday->copy()->addDays(1);
        $wednesday = $tuesday->copy()->addDays(1);
        $thursday = $wednesday->copy()->addDays(1);
        $friday = $thursday->copy()->addDays(1);
        $saturday = $friday->copy()->addDays(1);

        // $weekdays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        $days = [
            $sunday->toDateTimeString(),
            $monday->toDateTimeString(),
            $tuesday->toDateTimeString(),
            $wednesday->toDateTimeString(),
            $thursday->toDateTimeString(),
            $friday->toDateTimeString(),
            $saturday->toDateTimeString()
        ];

        $sales = [];
        $sent_mails = [];

        foreach ($days as $index => $date) {
            $result = Transaction::where(['user_id' => Auth::user()->id])
                ->whereIn('status', ['Course Purchase', 'Product Purchase'])
                ->whereDate('created_at', '<=', $date)
                ->whereDate('created_at', '>=', $date)->get();

            $sales[$index] = count($result);
        }

        foreach ($days as $index => $date) {
            $campaigns = EmailCampaign::where('user_id', Auth::user()->id)->get();

            $result = $campaigns->map(function ($_campaign) use ($date) {
                $_result = EmailCampaignQueue::where(['email_campaign_id' => $_campaign->id, 'status' => 'Sent'])
                    ->whereDate('updated_at', '<=', $date)
                    ->whereDate('updated_at', '>=', $date)->get();

                return count($_result);
            })->sum();

            $sent_mails[$index] = $result;
        }

        return view('dashboard.dashboard', [
            'sales' => json_encode($sales),
            'sent_mails' => json_encode($sent_mails)
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
        $plans = OjaPlan::latest()->where('is_enabled', true)->get();

        return view('dashboard.upgrade', [
            'username' => $username,
            'plan' => $plan,
            'plans' => $plans
        ]);
    }

    public function upgrade_account($username, $plan_id, $currency, $price)
    {
        $subscription = OjaSubscription::where('user_id', Auth::user()->id)->where('status', 'Active')->first();

        if ($subscription !== null) {
            return back()->with([
                'type' => 'danger',
                'message' => 'You have an active plan.'
            ]);
        }

        $plan_id = Crypt::decrypt($plan_id);
        $currency = Crypt::decrypt($currency);
        $price = Crypt::decrypt($price);

        // dd($plan_id, $currency, $price);

        $plan = OjaPlan::where('id', $plan_id)->first();

        // $data = explode(',',  $plan->description);

        // dd($data);

        return view('dashboard.makePayment', [
            'price' => $price,
            'currency' => $currency,
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

    public function add_funnel_custom_domain(Request $request, $username)
    {
        $funnel = Funnel::where(['id' => $request->id, 'user_id' => Auth::user()->id]);
        if (!$funnel->exists()) {
            return redirect(route('user.choose.temp', ['username' => Auth::user()->username]));
        }

        $index = FunnelPage::where(['name' => 'index.html', 'user_id' => Auth::user()->id, 'folder_id' => $funnel->first()->id]);
        if (!$index->exists()) {
            return redirect(route('user.choose.temp', ['username' => Auth::user()->username]))->with([
                'type' => 'danger',
                'message' => 'You are required to have index page name in your funnel to use custom domain feature'
            ]);
        }

        $domain = Domain::where(['type' => 'funnel', 'slug' => $funnel->first()->slug, 'user_id' => Auth::user()->id]);

        return view('dashboard.funnelCustomDomain', [
            'funnel' => $funnel->first(),
            'domain' => $domain->first()
        ]);
    }

    public function save_funnel_custom_domain(Request $request, $username)
    {
        $request->validate([
            'request_type' => 'required'
        ]);

        if ($request->request_type == 'save') {
            $request->validate([
                'id' => 'required',
                'file_folder' => 'required',
                'domain' => 'unique:domains,domain,except,id|regex:/^(?!\-)(?:(?:[a-zA-Z\d][a-zA-Z\d\-]{0,61})?[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/',
            ]);

            $funnel = Funnel::where(['id' => $request->id, 'user_id' => Auth::user()->id]);

            if (!$funnel->exists()) {
                return redirect(route('user.choose.temp', ['username' => Auth::user()->username]));
            }

            $domain = Domain::where('domain', $request->domain);

            if ($domain->exists()) {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'The domain name is in use by another user.'
                ]);
            }

            $domain = new Domain();
            $domain->user_id = Auth::user()->id;
            $domain->type = 'funnel';
            $domain->subdomain = $funnel->first()->slug . '-funnel';
            $domain->slug = $funnel->first()->slug;
            $domain->domain = $request->domain;
            $domain->status = 'pending';
            $domain->save();

            return back()->with([
                'type' => 'success',
                'message' => 'The domain name has been added successfully.'
            ]);
        }

        if ($request->request_type == 'update') {
            $request->validate([
                'id' => 'required',
                'file_folder' => 'required',
                'domain' => 'regex:/^(?!\-)(?:(?:[a-zA-Z\d][a-zA-Z\d\-]{0,61})?[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/',
            ]);

            $funnel = Funnel::where(['id' => $request->id, 'user_id' => Auth::user()->id]);

            if (!$funnel->exists()) {
                return redirect(route('user.choose.temp', ['username' => Auth::user()->username]));
            }

            $domain = Domain::where(['type' => 'funnel', 'slug' => $funnel->first()->slug, 'user_id' => Auth::user()->id]);

            $domain->update([
                'user_id' => Auth::user()->id,
                'type' => 'funnel',
                'subdomain' => $funnel->first()->slug . '-funnel',
                'slug' => $funnel->first()->slug,
                'domain' => $request->domain,
                'status' => 'pending'
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'The domain name has been updated successfully.'
            ]);
        }
    }

    public function remove_funnel_custom_domain(Request $request)
    {
        $request->validate(['id' => 'required']);

        if ($request->delete != 'DELETE') {
            return back()->with([
                'type' => 'danger',
                'message' => 'Please type DELETE to confirm.'
            ]);
        }

        $domain = Domain::where(['id' => $request->id, 'type' => 'funnel', 'user_id' => Auth::user()->id]);

        $domain->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'The domain name has been removed successfully.'
        ]);
    }

    public function view_funnel_pages($username, $id)
    {
        $id = Crypt::decrypt($id);

        $funnel = Funnel::findorfail($id);

        $pages = FunnelPage::latest()->where(['user_id' => Auth::user()->id, 'folder_id' => $funnel->id])->get();

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

    public function view_use_page_builder_template(Request $request)
    {
        $page = Page::where('id', $request->id);

        if (!$page->exists()) {
            return redirect(route('user.page.builder', ['username' => Auth::user()->username]))->with([
                'type' => 'danger',
                'message' => 'The page you are trying to use it template doesn\'t exists. Thank you.'
            ]);
        }

        return view('dashboard.pageBuilder-viewUseTemplate', [
            'page' => $page->first()
        ]);
    }

    public function generatePageSlug($folder)
    {
        $slug = strtolower(implode('-', explode(' ', $folder)));

        $page = Page::where(['slug' => $slug]);

        if ($page->exists()) {
            if ($page->first()->user_id == Auth::user()->id) {
                return [true, $slug];
            } else return [false, $slug];
        }

        return [true, $slug];
    }

    public function create_use_page_builder_template(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'file_folder' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
            'selected_page' => ['required']
        ]);

        if (Page::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->page_builder) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access'
            ]);
        }

        $selected_page = Page::where('id', $request->selected_page)->first();

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

        $data = file_get_contents(public_path("pageBuilder/$selected_page->slug/$selected_page->name"));

        $html = substr($data, 0, MAX_FILE_LIMIT);

        $file = $this->sanitizeFileName($file);

        // $datum = strval($request->file_folder);

        $_page = Page::where(['name' => $file, 'slug' => $res[1], 'user_id' => Auth::user()->id]);

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
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'name' => $file,
                'folder' => $request->file_folder,
                'file_location' => config('app.url') . '/pageBuilder/' . $res[1] . '/' . $file,
                'slug' => $res[1]
            ]);

            return redirect(route('user.page.builder', ['username' => Auth::user()->username]))->with([
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
        $contact_lists = \App\Models\ListManagement::where('user_id', Auth::user()->id)->where('status', true)->get();
        $integrations = Integration::latest()->where('user_id', Auth::user()->id)->get();
        return view('dashboard.newsms', [
            'username' => $username,
            'contact_lists' => $contact_lists,
            'integrations' => $integrations
        ]);
    }

    public function delete_sms_campaign($id)
    {
        $Finder = Crypt::decrypt($id);

        $smsAutomations = SmsCampaign::find($Finder);

        $smsQueue = SmsQueue::where('sms_campaign_id', $smsAutomations->id)->get();

        foreach ($smsQueue as $sms) {
            $sms->delete();
        }

        $smsAutomations->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Sms Campaign deleted succesfully.'
        ]);
    }

    public function update_sms_campaign($id, Request $request)
    {
        $Finder = Crypt::decrypt($id);

        $smsAutomations = SmsCampaign::find($Finder);

        $smsAutomations->update([
            'title' => $request->campaign_name,
            'message' => $request->message,
            'sender_name' => $request->sender_name,
            'integration' => $request->integration,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Sms Campaign updated succesfully.'
        ]);
    }

    public function wa_number($username)
    {
        $whatsapp_numbers = WhatsappNumber::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

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

        return view('dashboard.wa-number.index', ['whatsapp_numbers' => $_whatsapp_numbers]);
    }

    public function generate_wa_qr(Request $request, $username)
    {
        $full_jwt_session = explode(':', $request->full_jwt_session);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $full_jwt_session[1]
        ])->post(env('WA_BASE_ENDPOINT') . '/api/' . $full_jwt_session[0] . '/start-session');
        $data = $response->json();

        return response()->json($data, 200);
    }

    public function logout_wa_session(Request $request, $username)
    {
        $full_jwt_session = explode(':', $request->full_jwt_session);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $full_jwt_session[1]
        ])->post(env('WA_BASE_ENDPOINT') . '/api/' . $full_jwt_session[0] . '/logout-session');
        $data = $response->json();

        return response()->json($data, 200);
    }

    public function check_wa_session_connection(Request $request, $username)
    {
        $full_jwt_session = explode(':', $request->full_jwt_session);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $full_jwt_session[1]
        ])->get(env('WA_BASE_ENDPOINT') . '/api/' . $full_jwt_session[0] . '/check-connection-session');

        $data = $response->json();

        return response()->json($data, 200);
    }

    public function create_wa_number(Request $request, $username)
    {
        // validate
        $request->validate([
            'phone_number' => 'required|unique:whatsapp_numbers'
        ]);

        if (WhatsappNumber::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->wa_number) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access'
            ]);
        }

        $wa_number = new WhatsappNumber();
        $wa_number->phone_number = $request->phone_number;

        $response = Http::post(
            env('WA_BASE_ENDPOINT') . '/api/' . $request->phone_number . '/8KtworSulXYbbXKej0e9SjlcT3Y3UAeZsLx42Jx1CByXw4Fose/generate-token'
        );
        $data = $response->json();

        $wa_number->full_jwt_session = $data['full'];
        $wa_number->user_id = Auth::user()->id;

        $wa_number->save();

        return back()->with([
            'type' => 'success',
            'message' => 'The WA Number added successfully.'
        ]);
    }

    public function update_wa_number(Request $request, $username)
    {
        // validate
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

    public function delete_wa_number(Request $request, $username)
    {
        $wa_number = WhatsappNumber::find($request->id);

        $wa_number->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'The WA Number deleted successfully.'
        ]);
    }

    public function whatsapp_automation($username)
    {
        $whatsapp_campaigns = WaCampaigns::where('user_id', Auth::user()->id)->get();

        return view('dashboard.whatsappAutomation', [
            'username' => $username,
            'whatsapp_campaigns' => $whatsapp_campaigns
        ]);
    }

    public function whatsapp_automation_campaign(Request $request, $username)
    {
        $wa_campaign = WaCampaigns::find($request->campaign_id);
        $wa_queues = WaQueues::where('wa_campaign_id', $request->campaign_id)->orderBy('updated_at', 'DESC')->get();

        return view('dashboard.whatsappAutomationOverview', [
            'username' => $username,
            'wa_campaign' => $wa_campaign,
            'wa_queues' => $wa_queues,
        ]);
    }

    public function sendbroadcast($username)
    {
        $contact_lists = \App\Models\ListManagement::where('user_id', Auth::user()->id)->where('status', true)->get();
        $integrations = Integration::latest()->where('user_id', Auth::user()->id)->get();

        $whatsapp_numbers = WhatsappNumber::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

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



        return view('dashboard.sendbroadcast', [
            'username' => $username,
            'contact_lists' => $contact_lists,
            'whatsapp_numbers' => $_whatsapp_numbers,
            'integrations' => $integrations
        ]);
    }

    public function sendbroadcastcreate(Request $request, $username)
    {
        // validations
        $request->validate([
            'campaign_name' => 'required',
            'whatsapp_account' => 'required',
            'contact_list' => 'required',
            'template' => 'required',
        ]);

        if (WaCampaigns::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->whatsapp_automation) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access'
            ])->withInput();
        }

        $this->template_validate($request);
        $request->validate(['message_timing' => 'required']);

        $whatsapp_account = explode('-', $request->whatsapp_account);

        if ($whatsapp_account[2] != "Connected") return back()->with([
            'type' => 'danger',
            'message' => 'The WA account is not connected. Connect and try again'
        ])->withInput();

        // get contact list
        // $contacts = ContactNumber::latest()->where('contact_list_id', $request->contact_list)->get();
        $contacts = ListManagementContact::latest()->where('list_management_id', $request->contact_list)->get();

        if ($request->message_timing == 'Immediately') {
            if ($request->template == 'template1') {
                // for data integrity and consistency
                DB::transaction(function () use ($request, $whatsapp_account, $contacts) {
                    // create new row on campaign table
                    $waCaimpagn = new WaCampaigns();
                    $waCaimpagn->name = $request->campaign_name;
                    $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                    $waCaimpagn->user_id = Auth::user()->id;
                    $waCaimpagn->contact_list_id = $request->contact_list;
                    $waCaimpagn->template = $request->template;
                    $waCaimpagn->template1_message = $request->template1_message;
                    $waCaimpagn->message_timing = $request->message_timing;
                    $waCaimpagn->save();

                    // build each wa queue data based on contacts
                    $wa_queue = $contacts->map(function ($_contact) use ($waCaimpagn) {
                        $timestamp = Carbon::now();

                        return [
                            'wa_campaign_id' => $waCaimpagn->id,
                            'phone_number' => $_contact->phone,
                            'status' => 'Waiting',
                            'created_at' => $timestamp,
                            'updated_at' => $timestamp,
                        ];
                    })->toArray();

                    // bulk insert
                    WaQueues::insert($wa_queue);

                    // divide into 10 chunks and
                    // delay each job between 10  - 20 sec in the queue
                    $chunks = $contacts->chunk(10);
                    $delay = mt_rand(10, 20);

                    // dispatch job and delay
                    foreach ($chunks as $key => $_chunk) {
                        // dispatch job
                        ProcessTemplate1BulkWAMessages::dispatch($_chunk, [
                            'whatsapp_account' => $whatsapp_account[1],
                            'full_jwt_session' => $whatsapp_account[3],
                            'template1_message' => $request->template1_message,
                            'wa_campaign_id' => $waCaimpagn->id
                        ])->afterCommit()->onQueue('waTemplate1')->delay($delay);

                        $delay += mt_rand(10, 20);
                    }
                });

                return back()->with([
                    'type' => 'success',
                    'message' => 'The WA campaign has been created and execution will begin soon.'
                ]);
            }

            if ($request->template == 'template2') {
                // for data integrity and consistency
                DB::transaction(function () use ($request, $whatsapp_account, $contacts) {
                    // create new row on campaign table
                    $waCaimpagn = new WaCampaigns();
                    $waCaimpagn->name = $request->campaign_name;
                    $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                    $waCaimpagn->user_id = Auth::user()->id;
                    $waCaimpagn->contact_list_id = $request->contact_list;
                    $waCaimpagn->template = $request->template;
                    $waCaimpagn->template2_message = $request->template2_message;

                    // filename
                    $file = $request->file('template2_file');
                    $path = $file->storeAs(
                        '/public/WAfiles',
                        substr(md5(mt_rand()), 0, 7) . '-' . $file->getClientOriginalName()
                    );

                    $waCaimpagn->template2_file = $path;
                    $waCaimpagn->message_timing = $request->message_timing;
                    $waCaimpagn->save();

                    // build each wa queue data based on contacts
                    $wa_queue = $contacts->map(function ($_contact) use ($waCaimpagn) {
                        $timestamp = Carbon::now();

                        return [
                            'wa_campaign_id' => $waCaimpagn->id,
                            'phone_number' => $_contact->phone,
                            'status' => 'Waiting',
                            'created_at' => $timestamp,
                            'updated_at' => $timestamp,
                        ];
                    })->toArray();

                    // bulk insert
                    WaQueues::insert($wa_queue);

                    // divide into 10 chunks and
                    // delay each job between 10  - 20 sec in the queue
                    $chunks = $contacts->chunk(10);
                    $delay = mt_rand(10, 20);

                    // dispatch job and delay
                    foreach ($chunks as $key => $_chunk) {
                        // dispatch job
                        ProcessTemplate2BulkWAMessages::dispatch($_chunk, [
                            'whatsapp_account' => $whatsapp_account[1],
                            'full_jwt_session' => $whatsapp_account[3],
                            'template2_message' => $request->template2_message,
                            'template2_file' => $path,
                            'wa_campaign_id' => $waCaimpagn->id
                        ])->afterCommit()->onQueue('waTemplate2')->delay($delay);

                        $delay += mt_rand(10, 20);
                    }
                });

                return back()->with([
                    'type' => 'success',
                    'message' => 'The WA campaign has been created and execution will begin soon.'
                ]);
            }

            if ($request->template == 'template3') {
                // for data integrity and consistency
                DB::transaction(function () use ($request, $whatsapp_account, $contacts) {
                    // create new row on campaign table
                    $waCaimpagn = new WaCampaigns();
                    $waCaimpagn->name = $request->campaign_name;
                    $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                    $waCaimpagn->user_id = Auth::user()->id;
                    $waCaimpagn->contact_list_id = $request->contact_list;
                    $waCaimpagn->template = $request->template;
                    $waCaimpagn->template3_header = $request->template3_header;
                    $waCaimpagn->template3_message = $request->template3_message;
                    $waCaimpagn->template3_footer = $request->template3_footer;
                    $waCaimpagn->template3_link_url = $request->template3_link_url;
                    $waCaimpagn->template3_link_cta = $request->template3_link_cta;
                    $waCaimpagn->template3_phone_number = $request->template3_phone_number;
                    $waCaimpagn->template3_phone_cta = $request->template3_phone_cta;
                    $waCaimpagn->message_timing = $request->message_timing;
                    $waCaimpagn->save();

                    // build each wa queue data based on contacts
                    $wa_queue = $contacts->map(function ($_contact) use ($waCaimpagn) {
                        $timestamp = Carbon::now();

                        return [
                            'wa_campaign_id' => $waCaimpagn->id,
                            'phone_number' => $_contact->phone,
                            'status' => 'Waiting',
                            'created_at' => $timestamp,
                            'updated_at' => $timestamp,
                        ];
                    })->toArray();

                    // bulk insert
                    WaQueues::insert($wa_queue);

                    // divide into 10 chunks and
                    // delay each job between 10  - 20 sec in the queue
                    $chunks = $contacts->chunk(10);
                    $delay = mt_rand(10, 20);

                    // dispatch job and delay
                    foreach ($chunks as $key => $_chunk) {
                        // dispatch job
                        ProcessTemplate3BulkWAMessages::dispatch($_chunk, [
                            'whatsapp_account' => $whatsapp_account[1],
                            'full_jwt_session' => $whatsapp_account[3],
                            'template3_header' => $request->template3_header,
                            'template3_message' => $request->template3_message,
                            'template3_footer' => $request->template3_footer,
                            'template3_link_url' => $request->template3_link_url,
                            'template3_link_cta' => $request->template3_link_cta,
                            'template3_phone_number' => $request->template3_phone_number,
                            'template3_phone_cta' => $request->template3_phone_cta,
                            'wa_campaign_id' => $waCaimpagn->id
                        ])->afterCommit()->onQueue('waTemplate3')->delay($delay);

                        $delay += mt_rand(10, 20);
                    }
                });

                return back()->with([
                    'type' => 'success',
                    'message' => 'The WA campaign has been created and execution will begin soon.'
                ]);
            }
        }

        if ($request->message_timing == 'Schedule') {
            $request->validate([
                'start_date' => 'required',
                'start_time' => 'required',
                'frequency_cycle' => 'required'
            ]);

            if ($request->start_date < Carbon::now()->format('Y-m-d')) return back()->with([
                'type' => 'danger',
                'message' => 'The WA campaign schedule start date is invalid'
            ])->withInput();

            if ($request->start_date == Carbon::now()->format('Y-m-d')) {
                if ($request->start_time <= Carbon::now()->format('H:i'))  return back()->with([
                    'type' => 'danger',
                    'message' => 'The WA campaign schedule start time is invalid'
                ])->withInput();
            }

            if ($request->frequency_cycle == 'onetime') {
                if ($request->template == 'template1') {
                    // for data integrity and consistency
                    DB::transaction(function () use ($request, $whatsapp_account, $contacts) {
                        // create new row on campaign table
                        $waCaimpagn = new WaCampaigns();
                        $waCaimpagn->name = $request->campaign_name;
                        $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                        $waCaimpagn->user_id = Auth::user()->id;
                        $waCaimpagn->contact_list_id = $request->contact_list;
                        $waCaimpagn->template = $request->template;
                        $waCaimpagn->template1_message = $request->template1_message;
                        $waCaimpagn->message_timing = $request->message_timing;
                        // frequency
                        $waCaimpagn->start_date = $request->start_date;
                        $waCaimpagn->start_time = $request->start_time;
                        $waCaimpagn->next_due_date = $request->start_date;
                        $waCaimpagn->frequency_cycle = $request->frequency_cycle;

                        $waCaimpagn->save();

                        // build each wa queue data based on contacts
                        $wa_queue = $contacts->map(function ($_contact) use ($waCaimpagn) {
                            $timestamp = Carbon::now();

                            return [
                                'wa_campaign_id' => $waCaimpagn->id,
                                'phone_number' => $_contact->phone,
                                'status' => 'Scheduled',
                                'created_at' => $timestamp,
                                'updated_at' => $timestamp,
                            ];
                        })->toArray();

                        // bulk insert
                        WaQueues::insert($wa_queue);
                    });

                    return back()->with([
                        'type' => 'success',
                        'message' => 'The WA campaign has been scheduled successfully'
                    ]);
                }

                if ($request->template == 'template2') {
                    // for data integrity and consistency
                    DB::transaction(function () use ($request, $whatsapp_account, $contacts) {
                        // create new row on campaign table
                        $waCaimpagn = new WaCampaigns();
                        $waCaimpagn->name = $request->campaign_name;
                        $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                        $waCaimpagn->user_id = Auth::user()->id;
                        $waCaimpagn->contact_list_id = $request->contact_list;
                        $waCaimpagn->template = $request->template;
                        $waCaimpagn->template2_message = $request->template2_message;

                        // filename
                        $file = $request->file('template2_file');
                        $path = $file->storeAs(
                            '/public/WAfiles',
                            substr(md5(mt_rand()), 0, 7) . '-' . $file->getClientOriginalName()
                        );

                        $waCaimpagn->template2_file = $path;
                        $waCaimpagn->message_timing = $request->message_timing;

                        // frequency
                        $waCaimpagn->start_date = $request->start_date;
                        $waCaimpagn->start_time = $request->start_time;
                        $waCaimpagn->next_due_date = $request->start_date;
                        $waCaimpagn->frequency_cycle = $request->frequency_cycle;

                        // save
                        $waCaimpagn->save();

                        // build each wa queue data based on contacts
                        $wa_queue = $contacts->map(function ($_contact) use ($waCaimpagn) {
                            $timestamp = Carbon::now();

                            return [
                                'wa_campaign_id' => $waCaimpagn->id,
                                'phone_number' => $_contact->phone,
                                'status' => 'Waiting',
                                'created_at' => $timestamp,
                                'updated_at' => $timestamp,
                            ];
                        })->toArray();

                        // bulk insert
                        WaQueues::insert($wa_queue);
                    });

                    return back()->with([
                        'type' => 'success',
                        'message' => 'The WA campaign has been scheduled successfully'
                    ]);
                }

                if ($request->template == 'template3') {
                    // for data integrity and consistency
                    DB::transaction(function () use ($request, $whatsapp_account, $contacts) {
                        // create new row on campaign table
                        $waCaimpagn = new WaCampaigns();
                        $waCaimpagn->name = $request->campaign_name;
                        $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                        $waCaimpagn->user_id = Auth::user()->id;
                        $waCaimpagn->contact_list_id = $request->contact_list;
                        $waCaimpagn->template = $request->template;
                        $waCaimpagn->template3_header = $request->template3_header;
                        $waCaimpagn->template3_message = $request->template3_message;
                        $waCaimpagn->template3_footer = $request->template3_footer;
                        $waCaimpagn->template3_link_url = $request->template3_link_url;
                        $waCaimpagn->template3_link_cta = $request->template3_link_cta;
                        $waCaimpagn->template3_phone_number = $request->template3_phone_number;
                        $waCaimpagn->template3_phone_cta = $request->template3_phone_cta;
                        $waCaimpagn->message_timing = $request->message_timing;

                        // frequency
                        $waCaimpagn->start_date = $request->start_date;
                        $waCaimpagn->start_time = $request->start_time;
                        $waCaimpagn->next_due_date = $request->start_date;
                        $waCaimpagn->frequency_cycle = $request->frequency_cycle;

                        $waCaimpagn->save();

                        // build each wa queue data based on contacts
                        $wa_queue = $contacts->map(function ($_contact) use ($waCaimpagn) {
                            $timestamp = Carbon::now();

                            return [
                                'wa_campaign_id' => $waCaimpagn->id,
                                'phone_number' => $_contact->phone,
                                'status' => 'Waiting',
                                'created_at' => $timestamp,
                                'updated_at' => $timestamp,
                            ];
                        })->toArray();

                        // bulk insert
                        WaQueues::insert($wa_queue);
                    });

                    return back()->with([
                        'type' => 'success',
                        'message' => 'The WA campaign has been scheduled successfully'
                    ]);
                }
            }

            if ($request->frequency_cycle == 'daily' || $request->frequency_cycle == 'weekly' || $request->frequency_cycle == 'monthly' || $request->frequency_cycle == 'yearly') {
                $request->validate([
                    'end_date' => 'required',
                ]);

                if ($request->end_date <= $request->start_date) return back()->with([
                    'type' => 'danger',
                    'message' => 'The WA campaign schedule end date is invalid'
                ])->withInput();

                if ($request->template == 'template1') {
                    // for data integrity and consistency
                    DB::transaction(function () use ($request, $whatsapp_account, $contacts) {
                        // create new row on campaign table
                        $waCaimpagn = new WaCampaigns();
                        $waCaimpagn->name = $request->campaign_name;
                        $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                        $waCaimpagn->user_id = Auth::user()->id;
                        $waCaimpagn->contact_list_id = $request->contact_list;
                        $waCaimpagn->template = $request->template;
                        $waCaimpagn->template1_message = $request->template1_message;
                        $waCaimpagn->message_timing = $request->message_timing;

                        // frequency
                        $waCaimpagn->start_date = $request->start_date;
                        $waCaimpagn->start_time = $request->start_time;
                        $waCaimpagn->next_due_date = $request->start_date;
                        $waCaimpagn->frequency_cycle = $request->frequency_cycle;
                        $waCaimpagn->end_date = $request->end_date;

                        $waCaimpagn->save();

                        // build each wa queue data based on contacts
                        $wa_queue = $contacts->map(function ($_contact) use ($waCaimpagn) {
                            $timestamp = Carbon::now();

                            return [
                                'wa_campaign_id' => $waCaimpagn->id,
                                'phone_number' => $_contact->phone,
                                'status' => 'Scheduled',
                                'created_at' => $timestamp,
                                'updated_at' => $timestamp,
                            ];
                        })->toArray();

                        // bulk insert
                        WaQueues::insert($wa_queue);
                    });

                    return back()->with([
                        'type' => 'success',
                        'message' => 'The WA campaign has been scheduled successfully'
                    ]);
                }

                if ($request->template == 'template2') {
                    // for data integrity and consistency
                    DB::transaction(function () use ($request, $whatsapp_account, $contacts) {
                        // create new row on campaign table
                        $waCaimpagn = new WaCampaigns();
                        $waCaimpagn->name = $request->campaign_name;
                        $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                        $waCaimpagn->user_id = Auth::user()->id;
                        $waCaimpagn->contact_list_id = $request->contact_list;
                        $waCaimpagn->template = $request->template;
                        $waCaimpagn->template2_message = $request->template2_message;

                        // filename
                        $file = $request->file('template2_file');
                        $path = $file->storeAs(
                            '/public/WAfiles',
                            substr(md5(mt_rand()), 0, 7) . '-' . $file->getClientOriginalName()
                        );

                        $waCaimpagn->template2_file = $path;
                        $waCaimpagn->message_timing = $request->message_timing;

                        // frequency
                        $waCaimpagn->start_date = $request->start_date;
                        $waCaimpagn->start_time = $request->start_time;
                        $waCaimpagn->next_due_date = $request->start_date;
                        $waCaimpagn->frequency_cycle = $request->frequency_cycle;
                        $waCaimpagn->end_date = $request->end_date;

                        // save
                        $waCaimpagn->save();

                        // build each wa queue data based on contacts
                        $wa_queue = $contacts->map(function ($_contact) use ($waCaimpagn) {
                            $timestamp = Carbon::now();

                            return [
                                'wa_campaign_id' => $waCaimpagn->id,
                                'phone_number' => $_contact->phone,
                                'status' => 'Waiting',
                                'created_at' => $timestamp,
                                'updated_at' => $timestamp,
                            ];
                        })->toArray();

                        // bulk insert
                        WaQueues::insert($wa_queue);
                    });

                    return back()->with([
                        'type' => 'success',
                        'message' => 'The WA campaign has been scheduled successfully'
                    ]);
                }

                if ($request->template == 'template3') {
                    // for data integrity and consistency
                    DB::transaction(function () use ($request, $whatsapp_account, $contacts) {
                        // create new row on campaign table
                        $waCaimpagn = new WaCampaigns();
                        $waCaimpagn->name = $request->campaign_name;
                        $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                        $waCaimpagn->user_id = Auth::user()->id;
                        $waCaimpagn->contact_list_id = $request->contact_list;
                        $waCaimpagn->template = $request->template;
                        $waCaimpagn->template3_header = $request->template3_header;
                        $waCaimpagn->template3_message = $request->template3_message;
                        $waCaimpagn->template3_footer = $request->template3_footer;
                        $waCaimpagn->template3_link_url = $request->template3_link_url;
                        $waCaimpagn->template3_link_cta = $request->template3_link_cta;
                        $waCaimpagn->template3_phone_number = $request->template3_phone_number;
                        $waCaimpagn->template3_phone_cta = $request->template3_phone_cta;
                        $waCaimpagn->message_timing = $request->message_timing;

                        // frequency
                        $waCaimpagn->start_date = $request->start_date;
                        $waCaimpagn->start_time = $request->start_time;
                        $waCaimpagn->next_due_date = $request->start_date;
                        $waCaimpagn->frequency_cycle = $request->frequency_cycle;
                        $waCaimpagn->end_date = $request->end_date;

                        $waCaimpagn->save();

                        // build each wa queue data based on contacts
                        $wa_queue = $contacts->map(function ($_contact) use ($waCaimpagn) {
                            $timestamp = Carbon::now();

                            return [
                                'wa_campaign_id' => $waCaimpagn->id,
                                'phone_number' => $_contact->phone,
                                'status' => 'Waiting',
                                'created_at' => $timestamp,
                                'updated_at' => $timestamp,
                            ];
                        })->toArray();

                        // bulk insert
                        WaQueues::insert($wa_queue);
                    });

                    return back()->with([
                        'type' => 'success',
                        'message' => 'The WA campaign has been scheduled successfully'
                    ]);
                }
            }

            if ($request->frequency_cycle == 'custom') {
                $request->validate([
                    'frequency_amount' => 'required|numeric',
                    'frequency_unit' => 'required',
                    'end_date' => 'required',
                ]);

                if ($request->end_date <= $request->start_date) return back()->with([
                    'type' => 'danger',
                    'message' => 'The WA campaign schedule end date is invalid'
                ])->withInput();


                if ($request->template == 'template1') {
                    // for data integrity and consistency
                    DB::transaction(function () use ($request, $whatsapp_account, $contacts) {
                        // create new row on campaign table
                        $waCaimpagn = new WaCampaigns();
                        $waCaimpagn->name = $request->campaign_name;
                        $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                        $waCaimpagn->user_id = Auth::user()->id;
                        $waCaimpagn->contact_list_id = $request->contact_list;
                        $waCaimpagn->template = $request->template;
                        $waCaimpagn->template1_message = $request->template1_message;
                        $waCaimpagn->message_timing = $request->message_timing;

                        // frequency
                        $waCaimpagn->start_date = $request->start_date;
                        $waCaimpagn->start_time = $request->start_time;
                        $waCaimpagn->next_due_date = $request->start_date;
                        $waCaimpagn->frequency_cycle = $request->frequency_cycle;
                        $waCaimpagn->frequency_amount = $request->frequency_amount;
                        $waCaimpagn->frequency_unit = $request->frequency_unit;
                        $waCaimpagn->end_date = $request->end_date;

                        $waCaimpagn->save();

                        // build each wa queue data based on contacts
                        $wa_queue = $contacts->map(function ($_contact) use ($waCaimpagn) {
                            $timestamp = Carbon::now();

                            return [
                                'wa_campaign_id' => $waCaimpagn->id,
                                'phone_number' => $_contact->phone,
                                'status' => 'Scheduled',
                                'created_at' => $timestamp,
                                'updated_at' => $timestamp,
                            ];
                        })->toArray();

                        // bulk insert
                        WaQueues::insert($wa_queue);
                    });

                    return back()->with([
                        'type' => 'success',
                        'message' => 'The WA campaign has been scheduled successfully'
                    ]);
                }

                if ($request->template == 'template2') {
                    // for data integrity and consistency
                    DB::transaction(function () use ($request, $whatsapp_account, $contacts) {
                        // create new row on campaign table
                        $waCaimpagn = new WaCampaigns();
                        $waCaimpagn->name = $request->campaign_name;
                        $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                        $waCaimpagn->user_id = Auth::user()->id;
                        $waCaimpagn->contact_list_id = $request->contact_list;
                        $waCaimpagn->template = $request->template;
                        $waCaimpagn->template2_message = $request->template2_message;

                        // filename
                        $file = $request->file('template2_file');
                        $path = $file->storeAs(
                            '/public/WAfiles',
                            substr(md5(mt_rand()), 0, 7) . '-' . $file->getClientOriginalName()
                        );

                        $waCaimpagn->template2_file = $path;
                        $waCaimpagn->message_timing = $request->message_timing;

                        // frequency
                        $waCaimpagn->start_date = $request->start_date;
                        $waCaimpagn->start_time = $request->start_time;
                        $waCaimpagn->next_due_date = $request->start_date;
                        $waCaimpagn->frequency_cycle = $request->frequency_cycle;
                        $waCaimpagn->frequency_amount = $request->frequency_amount;
                        $waCaimpagn->frequency_unit = $request->frequency_unit;
                        $waCaimpagn->end_date = $request->end_date;

                        // save
                        $waCaimpagn->save();

                        // build each wa queue data based on contacts
                        $wa_queue = $contacts->map(function ($_contact) use ($waCaimpagn) {
                            $timestamp = Carbon::now();

                            return [
                                'wa_campaign_id' => $waCaimpagn->id,
                                'phone_number' => $_contact->phone,
                                'status' => 'Waiting',
                                'created_at' => $timestamp,
                                'updated_at' => $timestamp,
                            ];
                        })->toArray();

                        // bulk insert
                        WaQueues::insert($wa_queue);
                    });

                    return back()->with([
                        'type' => 'success',
                        'message' => 'The WA campaign has been scheduled successfully'
                    ]);
                }

                if ($request->template == 'template3') {
                    // for data integrity and consistency
                    DB::transaction(function () use ($request, $whatsapp_account, $contacts) {
                        // create new row on campaign table
                        $waCaimpagn = new WaCampaigns();
                        $waCaimpagn->name = $request->campaign_name;
                        $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                        $waCaimpagn->user_id = Auth::user()->id;
                        $waCaimpagn->contact_list_id = $request->contact_list;
                        $waCaimpagn->template = $request->template;
                        $waCaimpagn->template3_header = $request->template3_header;
                        $waCaimpagn->template3_message = $request->template3_message;
                        $waCaimpagn->template3_footer = $request->template3_footer;
                        $waCaimpagn->template3_link_url = $request->template3_link_url;
                        $waCaimpagn->template3_link_cta = $request->template3_link_cta;
                        $waCaimpagn->template3_phone_number = $request->template3_phone_number;
                        $waCaimpagn->template3_phone_cta = $request->template3_phone_cta;
                        $waCaimpagn->message_timing = $request->message_timing;

                        // frequency
                        $waCaimpagn->start_date = $request->start_date;
                        $waCaimpagn->start_time = $request->start_time;
                        $waCaimpagn->next_due_date = $request->start_date;
                        $waCaimpagn->frequency_cycle = $request->frequency_cycle;
                        $waCaimpagn->frequency_amount = $request->frequency_amount;
                        $waCaimpagn->frequency_unit = $request->frequency_unit;
                        $waCaimpagn->end_date = $request->end_date;

                        $waCaimpagn->save();

                        // build each wa queue data based on contacts
                        $wa_queue = $contacts->map(function ($_contact) use ($waCaimpagn) {
                            $timestamp = Carbon::now();

                            return [
                                'wa_campaign_id' => $waCaimpagn->id,
                                'phone_number' => $_contact->phone,
                                'status' => 'Waiting',
                                'created_at' => $timestamp,
                                'updated_at' => $timestamp,
                            ];
                        })->toArray();

                        // bulk insert
                        WaQueues::insert($wa_queue);
                    });

                    return back()->with([
                        'type' => 'success',
                        'message' => 'The WA campaign has been scheduled successfully'
                    ]);
                }
            }
        }
    }

    public function editWAbroadcast(Request $request, $username)
    {
        $request->validate(['name' => 'required']);

        $whatsapp_campaign = WaCampaigns::find($request->id);

        $whatsapp_campaign->update([
            'name' => $request->name
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'The WA campaign has been updated successfully.'
        ]);
    }

    public function deleteWAbroadcast(Request $request, $username)
    {
        $whatsapp_campaign = WaCampaigns::find($request->id);

        if (count($whatsapp_campaign->wa_queues->where('status', 'Waiting')) > 0) {
            return back()->with([
                'type' => 'danger',
                'message' => 'The WA campaign can\'t be deleted during execution.'
            ]);
        }

        // delete all related wa_queues
        $whatsapp_campaign->wa_queues()->delete();

        // delete campaign
        $whatsapp_campaign->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'The WA campaign has been deleted successfully.'
        ]);
    }

    public function template_validate(Request $request)
    {
        // validation for template 1
        if ($request->template == 'template1') $request->validate([
            'template1_message' => 'required',
        ]);

        // validation for template 2
        if ($request->template == 'template2') $request->validate([
            'template2_message' => 'required',
            'template2_file' => 'required|file'
        ]);

        // validation for template 3
        if ($request->template == 'template3') $request->validate([
            'template3_header' => 'required',
            'template3_message' => 'required',
            'template3_footer' => 'required',
            'template3_link_url' => 'required',
            'template3_link_cta' => 'required',
            'template3_phone_number' => 'required',
            'template3_phone_cta' => 'required'
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

    public function withdrawal($username)
    {
        return view('dashboard.withdrawal.withdrawal', [
            'username' => $username
        ]);
    }

    public function bank($username)
    {
        $bank_details = BankDetail::latest()->where('user_id', Auth::user()->id)->where('type', 'NGN')->get();

        return view('dashboard.withdrawal.bank', [
            'username' => $username,
            'bank_details' => $bank_details
        ]);
    }

    public function other_payment_method($username)
    {
        $bank_details = BankDetail::latest()->where('user_id', Auth::user()->id)->where('type', '!=', 'NGN')->get();

        return view('dashboard.withdrawal.other_payment_method', [
            'username' => $username,
            'bank_details' => $bank_details
        ]);
    }

    public function direct_us_bank($username)
    {
        return view('dashboard.withdrawal.direct_us_bank', [
            'username' => $username
        ]);
    }

    public function paystack($username)
    {
        return view('dashboard.withdrawal.paystack', [
            'username' => $username
        ]);
    }

    public function paypal($username)
    {
        return view('dashboard.withdrawal.paypal', [
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

    public function update_course_commission(Request $request)
    {
        $request->validate([
            'level1_comm' => 'required|numeric',
            'level2_comm' => 'required|numeric',
        ]);

        $idFinder = Crypt::decrypt($request->id);
        $course = Course::find($idFinder);

        if ($request->level1_comm < 0 || $request->level2_comm < 0) return back()->with([
            'type' => 'danger',
            'message' => 'Negative value are not allowed for commission fields'
        ]);

        if ($request->level1_comm != 0 && $request->level2_comm != 0) {
            // check if level1_comm <= level2_comm... then fail
            if ($request->level1_comm <= $request->level2_comm) return back()->with([
                'type' => 'danger',
                'message' => 'Level 1 commission must be greater than level 2 commision'
            ]);
        }

        $course->update([
            'level1_comm' => $request->level1_comm,
            'level2_comm' => $request->level2_comm,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'The commission has been updated successfully.'
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
        $products = StoreProduct::latest()->where('quantity', '>', 0)->where('level1_comm', '>', 0)->orderBy('id', 'DESC')->get();
        $lms = Course::latest()->where('level1_comm', '>', 0)->where('approved', true)->get();

        return view('dashboard.promotion.Product', [
            'products' => $products,
            'lms' => $lms
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
        $sms_integrations = Integration::latest()->where('user_id', Auth::user()->id)->get();
        $email_integrations = EmailKit::latest()->where(['account_id' => Auth::user()->id, 'is_admin' => false])->get();

        return view('dashboard.manageintegration', [
            'username' => $username,
            'sms_integrations' => $sms_integrations,
            'email_integrations' => $email_integrations,
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

        if ($store != null) {
            $storeOrderCount = StoreOrder::where('store_id', $store->id)->get()->count();
        } else {
            $storeOrderCount = 0;
        }

        if ($shop != null) {
            $shopOrderCount = ShopOrder::where('shop_id', $shop->id)->get()->count();
            $students = Enrollment::where('shop_id', $shop->id)->get()->count();
        } else {
            $shopOrderCount = 0;
            $students = 0;
        }

        return view('dashboard.salesAnalytics', [
            'username' => $username,
            'storeOrderCount' => $storeOrderCount,
            'shopOrderCount' => $shopOrderCount,
            'students' => $students
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
