<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\EmailKit;
use App\Models\Integration;
use Illuminate\Http\Request;
use App\Models\SendingServer;
use App\Models\WhatsappNumber;
use App\Models\BirthdayContact;
use App\Models\BirthdayWAQueue;
use App\Models\OjaPlanParameter;
use App\Models\BirthdayAutomation;
use Illuminate\Support\Facades\DB;
use App\Models\BirthdayContactList;
use App\Models\BirthdayEmailQueue;
use App\Models\ListManagement;
use App\Models\ListManagementContact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class BirthdayController extends Controller
{
    public function main_module($username)
    {
        return view('dashboard.birthday.birthdayMain', [
            'username' => $username
        ]);
    }

    public function manage_birthday($username)
    {
        $bm = BirthdayAutomation::latest()->where('user_id', Auth::user()->id)->get();
        $birthlist = ListManagement::where('user_id', Auth::user()->id)->where('status', true)->get();
        $smsServer = Integration::where('user_id', Auth::user()->id)->where('status', 'Active')->get();

        return view('dashboard.birthday.birthdayManage', [
            'username' => $username,
            'bm' => $bm,
            'birthlist' => $birthlist,
            'smsServer' => $smsServer
        ]);
    }

    public function create_birthday($username)
    {
        $birthlist = ListManagement::where('user_id', Auth::user()->id)->where('status', true)->get();
        $smsServer = Integration::where('user_id', Auth::user()->id)->where('status', 'Active')->get();
        $email_integrations = EmailKit::latest()->where(['account_id' => Auth::user()->id, 'is_admin' => false])->get();

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

        return view('dashboard.birthday.birthdayCreate', [
            'username' => $username,
            'birthlist' => $birthlist,
            'smsServer' => $smsServer,
            'email_integrations' => $email_integrations,
            'whatsapp_numbers' => $_whatsapp_numbers,
        ]);
    }

    public function edit_birthday($username)
    {
        return view('dashboard.birthday.birthdayEdit', [
            'username' => $username
        ]);
    }

    public function create_birthday_automation(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sender_name' => 'required',
            'automation' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        if (\App\Models\BirthdayAutomation::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->birthday_automation) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access.'
            ]);
        }

        // 
        foreach ($request->automation as $key => $automation) {
            if ($automation == 'whatsapp automation') {
                $request->validate([
                    'birthday_list_id' => 'required',
                    'sms_type' => 'required',
                    'message' => 'required',
                    'sender_id' => 'required',
                ]);

                $whatsapp_account = explode('-', $request->sender_id);

                if ($whatsapp_account[2] != "Connected") return back()->with([
                    'type' => 'danger',
                    'message' => 'The WA account is not connected. Connect and try again'
                ]);

                $contact = ListManagement::findOrFail($request->birthday_list_id)->get();

                // for data integrity and consistency
                DB::transaction(function () use ($request, $contact, $whatsapp_account, $automation) {
                    $waAutomation = new BirthdayAutomation();

                    $waAutomation->user_id = Auth::user()->id;
                    $waAutomation->birthday_contact_list_id = $request->birthday_list_id;
                    $waAutomation->title = $request->title;
                    $waAutomation->sms_type = $request->sms_type;
                    $waAutomation->message = $request->message;
                    $waAutomation->automation = $automation;
                    $waAutomation->cache = json_encode([
                        'ContactCount' => $contact->count(),
                        'DeliveredCount' => 0,
                        'FailedDeliveredCount' => 0,
                        'NotDeliveredCount' => 0,
                    ]);
                    $waAutomation->sender_name = $request->sender_name;
                    $waAutomation->sending_server = $request->sending_server ?? '';
                    $waAutomation->sender_id = $whatsapp_account[1];
                    $waAutomation->integration = $request->integration ?? '';
                    $waAutomation->email_kit_id = $request->email_kit ?? '';
                    $waAutomation->start_date = $request->start_date;
                    $waAutomation->end_date = $request->end_date;
                    $waAutomation->save();

                    $contacts = ListManagementContact::latest()->where(['list_management_id' => $contact->first()->id])->get();

                    // build each wa queue data based on contacts
                    $queue = $contacts->map(function ($_contact) use ($waAutomation) {
                        $timestamp = Carbon::now();

                        return [
                            'birthday_automation_id' => $waAutomation->id,
                            'phone_number' => $_contact->phone,
                            'status' => 'Scheduled',
                            'created_at' => $timestamp,
                            'updated_at' => $timestamp,
                        ];
                    })->toArray();

                    // bulk insert
                    BirthdayWAQueue::insert($queue);
                });
            }

            if ($automation == 'sms automation') {
                $contact = ListManagementContact::where('list_management_id', $request->birthday_list_id)->select('phone')->get();
                $bm = new BirthdayAutomation();
                $bm->user_id = Auth::user()->id;
                $bm->birthday_contact_list_id = $request->birthday_list_id;
                $bm->title = $request->title;
                $bm->sms_type = $request->sms_type;
                $bm->message = $request->message;
                $bm->automation = $automation;
                $bm->cache = json_encode([
                    'ContactCount' => $contact->count(),
                    'DeliveredCount' => 0,
                    'FailedDeliveredCount' => 0,
                    'NotDeliveredCount' => 0,
                ]);
                $bm->sender_name = $request->sender_name;
                $bm->sending_server = $request->sending_server ?? '';
                $bm->sender_id = $request->sender_id ?? '';
                $bm->integration = $request->integration ?? '';
                $bm->email_kit_id = $request->email_kit ?? '';
                $bm->start_date = $request->start_date;
                $bm->end_date = $request->end_date;
                $bm->save();
            }

            if ($automation == 'email automation') {
                $request->validate([
                    'birthday_list_id' => 'required',
                    'sms_type' => 'required',
                    'message' => 'required',
                    // 'email_kit' => 'required'
                ]);

                $email_kit = EmailKit::where(['account_id' => Auth::user()->id, 'is_admin' => false, 'master' => true]);
                if (!$email_kit->exists()) {
                    $email_kit = EmailKit::where(['is_admin' => true, 'master' => true]);

                    if (!$email_kit->exists()) {
                        return back()->with([
                            'type' => 'danger',
                            'message' => 'You currently have no master email kit. Likewise Ojafunnel team have no master email kit. Please set up email kit and it make master. Thanks.'
                        ])->withInput();
                    }

                    $email_kit = $email_kit->first();
                } else $email_kit = $email_kit->first();

                //
                $contact = ListManagement::findOrFail($request->birthday_list_id)->get();

                // for data integrity and consistency
                DB::transaction(function () use ($request, $email_kit, $contact, $automation) {
                    $emAutomation = new BirthdayAutomation();
                    $emAutomation->user_id = Auth::user()->id;
                    $emAutomation->birthday_contact_list_id = $request->birthday_list_id;
                    $emAutomation->title = $request->title;
                    $emAutomation->sms_type = $request->sms_type;
                    $emAutomation->message = $request->message;
                    $emAutomation->automation = $automation;
                    $emAutomation->cache = json_encode([
                        'ContactCount' => $contact->count(),
                        'DeliveredCount' => 0,
                        'FailedDeliveredCount' => 0,
                        'NotDeliveredCount' => 0,
                    ]);
                    $emAutomation->sender_name = $request->sender_name;
                    $emAutomation->sending_server = $request->sending_server ?? '';
                    $emAutomation->sender_id = $request->sender_id ?? '';
                    $emAutomation->integration = $request->integration ?? '';
                    $emAutomation->email_kit_id = $email_kit->id;
                    $emAutomation->start_date = $request->start_date;
                    $emAutomation->end_date = $request->end_date;
                    $emAutomation->save();

                    $contacts = ListManagementContact::latest()->where(['list_management_id' => $contact->first()->id])->get();

                    // build each wa queue data based on contacts
                    $queue = $contacts->map(function ($_contact) use ($emAutomation) {
                        $timestamp = Carbon::now();

                        return [
                            'birthday_automation_id' => $emAutomation->id,
                            'email' => $_contact->email,
                            'status' => 'Scheduled',
                            'created_at' => $timestamp,
                            'updated_at' => $timestamp,
                        ];
                    })->toArray();

                    // bulk insert
                    BirthdayEmailQueue::insert($queue);
                });
            }
        }

        return redirect(route('user.manage.birthday', ['username' => Auth::user()->username]))->with([
            'type' => 'success',
            'message' => 'Birthday Automation Created.'
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

    public function update_birthday($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $bd = BirthdayAutomation::findOrFail($finder);
        $bd->birthday_contact_list_id = $request->birthday_list_id;
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
}
