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
use App\Models\SmsAutomation;
use App\Models\WhatsappNumber;
use Illuminate\Support\Carbon;
use App\Models\PersonalChatroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ProcessTemplate1BulkWAMessages;
use App\Jobs\ProcessTemplate2BulkWAMessages;
use App\Jobs\ProcessTemplate3BulkWAMessages;

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

    public function wa_number($username)
    {
        $whatsapp_numbers = WhatsappNumber::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        $_whatsapp_numbers = $whatsapp_numbers->map(function ($whatsapp_number) {
            $full_jwt_session = explode(':', $whatsapp_number->full_jwt_session);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $full_jwt_session[1]
            ])->get('http://localhost:1000/api/' . $full_jwt_session[0] . '/check-connection-session');
            $data = $response->json();

            // re-generate jwt
            if (array_key_exists('error', $data)) {
                $response = Http::post(
                    'http://localhost:1000/api/' . $whatsapp_number->phone_number . '/8KtworSulXYbbXKej0e9SjlcT3Y3UAeZsLx42Jx1CByXw4Fose/generate-token'
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
                ])->get('http://localhost:1000/api/' . $full_jwt_session[0] . '/check-connection-session');

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
        ])->post('http://localhost:1000/api/' . $full_jwt_session[0] . '/start-session');
        $data = $response->json();

        return response()->json($data, 200);
    }

    public function logout_wa_session(Request $request, $username)
    {
        $full_jwt_session = explode(':', $request->full_jwt_session);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $full_jwt_session[1]
        ])->post('http://localhost:1000/api/' . $full_jwt_session[0] . '/logout-session');
        $data = $response->json();

        return response()->json($data, 200);
    }

    public function check_wa_session_connection(Request $request, $username)
    {
        $full_jwt_session = explode(':', $request->full_jwt_session);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $full_jwt_session[1]
        ])->get('http://localhost:1000/api/' . $full_jwt_session[0] . '/check-connection-session');

        $data = $response->json();

        return response()->json($data, 200);
    }

    public function create_wa_number(Request $request, $username)
    {
        // validate
        $request->validate([
            'phone_number' => 'required|unique:whatsapp_numbers'
        ]);

        $wa_number = new WhatsappNumber();
        $wa_number->phone_number = $request->phone_number;

        $response = Http::post(
            'http://localhost:1000/api/' . $request->phone_number . '/8KtworSulXYbbXKej0e9SjlcT3Y3UAeZsLx42Jx1CByXw4Fose/generate-token'
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
            'http://localhost:1000/api/' . $request->phone_number . '/8KtworSulXYbbXKej0e9SjlcT3Y3UAeZsLx42Jx1CByXw4Fose/generate-token'
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
        $contact_lists = \App\Models\ContactList::where('user_id', Auth::user()->id)->get();
        $integrations = Integration::latest()->where('user_id', Auth::user()->id)->get();

        $whatsapp_numbers = WhatsappNumber::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        $_whatsapp_numbers = $whatsapp_numbers->map(function ($whatsapp_number) {
            $full_jwt_session = explode(':', $whatsapp_number->full_jwt_session);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $full_jwt_session[1]
            ])->get('http://localhost:1000/api/' . $full_jwt_session[0] . '/check-connection-session');
            $data = $response->json();

            // re-generate jwt
            if (array_key_exists('error', $data)) {
                $response = Http::post(
                    'http://localhost:1000/api/' . $whatsapp_number->phone_number . '/8KtworSulXYbbXKej0e9SjlcT3Y3UAeZsLx42Jx1CByXw4Fose/generate-token'
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
                ])->get('http://localhost:1000/api/' . $full_jwt_session[0] . '/check-connection-session');

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
        $this->template_validate($request);
        $request->validate(['message_timing' => 'required']);

        $whatsapp_account = explode('-', $request->whatsapp_account);

        if ($whatsapp_account[2] != "Connected") return back()->with([
            'type' => 'danger',
            'message' => 'The WA account is not connected. Connect and try again'
        ]);

        // get contact list
        $contacts = ContactNumber::latest()->where('contact_list_id', $request->contact_list)->get();
        $wa_campaign_receivers = $contacts->map(function ($_contact) {
            return $_contact->phone_number;
        });

        if ($request->message_timing == 'Immediately') {
            if ($request->template == 'template1') {
                // create new row on campaign table
                $waCaimpagn = new WaCampaigns();
                $waCaimpagn->name = $request->campaign_name;
                $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                $waCaimpagn->user_id = Auth::user()->id;
                $waCaimpagn->receivers = $wa_campaign_receivers;
                $waCaimpagn->template = $request->template;
                $waCaimpagn->template1_message = $request->template1_message;
                $waCaimpagn->message_timing = $request->message_timing;
                $waCaimpagn->save();

                // build each wa queue data based on contacts
                $wa_queue = $contacts->map(function ($_contact) use ($waCaimpagn) {
                    $timestamp = Carbon::now();

                    return [
                        'wa_campaign_id' => $waCaimpagn->id,
                        'phone_number' => $_contact->phone_number,
                        'status' => 'Waiting',
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                    ];
                })->toArray();
                // bulk insert
                WaQueues::insert($wa_queue);

                // dispatch job
                ProcessTemplate1BulkWAMessages::dispatch($contacts, $request->whatsapp_account, [
                    'template1_message' => $request->template1_message,
                    'wa_campaign_id' => $waCaimpagn->id
                ])->onQueue('waTemplate1');

                return back()->with([
                    'type' => 'success',
                    'message' => 'The WA campaign has been created and execution will begin soon.'
                ]);
            }

            if ($request->template == 'template2') {
                // create new row on campaign table
                $waCaimpagn = new WaCampaigns();
                $waCaimpagn->name = $request->campaign_name;
                $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                $waCaimpagn->user_id = Auth::user()->id;
                $waCaimpagn->receivers = $wa_campaign_receivers;
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
                        'phone_number' => $_contact->phone_number,
                        'status' => 'Waiting',
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                    ];
                })->toArray();
                // bulk insert
                WaQueues::insert($wa_queue);

                // dispatch job
                ProcessTemplate2BulkWAMessages::dispatch($contacts, $request->whatsapp_account, [
                    'template2_message' => $request->template2_message,
                    'template2_file' => $path,
                    'wa_campaign_id' => $waCaimpagn->id
                ])->onQueue('waTemplate2');

                return back()->with([
                    'type' => 'success',
                    'message' => 'The WA campaign has been created and execution will begin soon.'
                ]);
            }

            if ($request->template == 'template3') {
                // create new row on campaign table
                // create new row on campaign table
                $waCaimpagn = new WaCampaigns();
                $waCaimpagn->name = $request->campaign_name;
                $waCaimpagn->whatsapp_account = $whatsapp_account[1];
                $waCaimpagn->user_id = Auth::user()->id;
                $waCaimpagn->receivers = $wa_campaign_receivers;
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
                        'phone_number' => $_contact->phone_number,
                        'status' => 'Waiting',
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                    ];
                })->toArray();
                // bulk insert
                WaQueues::insert($wa_queue);

                // dispatch job
                ProcessTemplate3BulkWAMessages::dispatch($contacts, $request->whatsapp_account, [
                    'template3_header' => $request->template3_header,
                    'template3_message' => $request->template3_message,
                    'template3_footer' => $request->template3_footer,
                    'template3_link_url' => $request->template3_link_url,
                    'template3_link_cta' => $request->template3_link_cta,
                    'template3_phone_number' => $request->template3_phone_number,
                    'template3_phone_cta' => $request->template3_phone_cta,
                    'wa_campaign_id' => $waCaimpagn->id
                ])->onQueue('waTemplate3');

                return back()->with([
                    'type' => 'success',
                    'message' => 'The WA campaign has been created and execution will begin soon.'
                ]);
            }
        }

        if ($request->message_timing == 'Schedule') {
            if ($request->template == 'template1') {
            }

            if ($request->template == 'template2') {
            }

            if ($request->template == 'template3') {
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
        // // $user_id = Auth::user()->id;
        // $stores = Store::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        // foreach ($stores as $key => $value) {
        //     # code...
        // }
        $products = StoreProduct::orderBy('id', 'DESC')->get();

        return view('dashboard.promotion.Product', [
            'username' => $username,
            'products' => $products
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
