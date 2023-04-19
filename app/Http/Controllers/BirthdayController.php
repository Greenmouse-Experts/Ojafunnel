<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Integration;
use Illuminate\Http\Request;
use App\Models\SendingServer;
use App\Models\WhatsappNumber;
use App\Models\BirthdayContact;
use App\Models\BirthdayWAQueue;
use App\Models\BirthdayAutomation;
use Illuminate\Support\Facades\DB;
use App\Models\BirthdayContactList;
use App\Models\OjaPlanParameter;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class BirthdayController extends Controller
{
    public function main_module($username)
    {
        return view('dashboard.birthday.birthdayMain', [
            'username' => $username
        ]);
    }

    public function manage_list($username)
    {
        $bl = BirthdayContactList::latest()->where('user_id', Auth::user()->id)->get();
        return view('dashboard.birthday.createList', [
            'username' => $username,
            'bl' => $bl
        ]);
    }

    public function individual_list(Request $request, $username)
    {
        $bd = BirthdayContactList::where('id', $request->id)->first();
        $bdc = BirthdayContact::latest()->where('birthday_contact_list_id', $request->id)->get();
        return view('dashboard.birthday.individualList', [
            'username' => $username,
            'bd' => $bd,
            'bdc' => $bdc,
        ]);
    }

    public function birthday_create_contact_list(Request $request)
    {
        $bdc = new BirthdayContact();
        $bdc->name = $request->name;
        $bdc->date_of_birth = $request->dob;
        $bdc->anniv_date = $request->aniDate;
        $bdc->phone_number = $request->phone;
        $bdc->email = $request->email;
        $bdc->birthday_contact_list_id = $request->birthday_id;
        $bdc->save();

        return back()->with([
            'type' => 'success',
            'message' => 'Birthday Contact List Added.'
        ]);
    }

    public function birthday_update_contact_list(Request $request)
    {
        $bdc = BirthdayContact::findOrFail($request->id);
        $bdc->name = $request->name;
        $bdc->date_of_birth = $request->dob;
        $bdc->anniv_date = $request->aniDate;
        $bdc->phone_number = $request->phone;
        $bdc->email = $request->email;
        $bdc->update();

        return back()->with([
            'type' => 'success',
            'message' => 'Birthday Contact List Updated.'
        ]);
    }

    public function birthday_delete_contact_list(Request $request)
    {
        $bdc = BirthdayContact::findOrFail($request->id)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Birthday Contact List Deleted.'
        ]);
    }

    public function manage_birthday($username)
    {
        $bm = BirthdayAutomation::latest()->where('user_id', Auth::user()->id)->get();
        $birthlist = BirthdayContactList::where('user_id', Auth::user()->id)->get();
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
        $birthlist = BirthdayContactList::where('user_id', Auth::user()->id)->get();
        $smsServer = Integration::where('user_id', Auth::user()->id)->where('status', 'Active')->get();

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
            'whatsapp_numbers' => $_whatsapp_numbers,
        ]);
    }

    public function edit_birthday($username)
    {
        return view('dashboard.birthday.birthdayEdit', [
            'username' => $username
        ]);
    }

    public function create_list(Request $request)
    {
        if(\App\Models\BirthdayContactList::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->birthday_contact_list)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'Subscribe to enjoy more access.'
            ]);
        }
        $bl = new BirthdayContactList();
        $bl->name = $request->name;
        $bl->status = $request->status;
        $bl->user_id = Auth::user()->id;
        $bl->save();
        return back()->with([
            'type' => 'success',
            'message' => 'Birthday List Created.'
        ]);
    }

    public function update_list(Request $request)
    {
        $bl = BirthdayContactList::findOrFail($request->id);
        $bl->name = $request->name;
        $bl->status = $request->status;
        $bl->update();
        return back()->with([
            'type' => 'success',
            'message' => 'Birthday List Updated.'
        ]);
    }

    public function delete_list(Request $request)
    {
        $bl = BirthdayContactList::findOrFail($request->id)->delete();
        return back()->with([
            'type' => 'success',
            'message' => 'Birthday List Deleted.'
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

        if(\App\Models\BirthdayAutomation::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->birthday_automation)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'Subscribe to enjoy more access.'
            ]);
        }

        if ($request->automation == 'whatsapp automation') {
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

            $contact = BirthdayContactList::findOrFail($request->birthday_list_id)->get();

            // for data integrity and consistency
            DB::transaction(function () use ($request, $contact, $whatsapp_account) {
                $waAutomation = new BirthdayAutomation();

                $waAutomation->user_id = FacadesAuth::user()->id;
                $waAutomation->birthday_contact_list_id = $request->birthday_list_id;
                $waAutomation->title = $request->title;
                $waAutomation->sms_type = $request->sms_type;
                $waAutomation->message = $request->message;
                $waAutomation->automation = $request->automation;
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
                $waAutomation->start_date = $request->start_date;
                $waAutomation->end_date = $request->end_date;
                $waAutomation->save();

                $contacts = BirthdayContact::latest()->where(['birthday_contact_list_id' => $contact->first()->id])->get();

                // build each wa queue data based on contacts
                $queue = $contacts->map(function ($_contact) use ($waAutomation) {
                    $timestamp = Carbon::now();

                    return [
                        'birthday_automation_id' => $waAutomation->id,
                        'phone_number' => $_contact->phone_number,
                        'status' => 'Scheduled',
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                    ];
                })->toArray();

                // bulk insert
                BirthdayWAQueue::insert($queue);
            });

            return back()->with([
                'type' => 'success',
                'message' => 'Birthday Automation Created.'
            ]);
        }

        if ($request->automation == 'sms automation') {
            $contact = BirthdayContactList::findOrFail($request->birthday_list_id)->get();
            $bm = new BirthdayAutomation();
            $bm->user_id = FacadesAuth::user()->id;
            $bm->birthday_contact_list_id = $request->birthday_list_id;
            $bm->title = $request->title;
            $bm->sms_type = $request->sms_type;
            $bm->message = $request->message;
            $bm->automation = json_encode($request->automation);
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
            $bm->start_date = $request->start_date;
            $bm->end_date = $request->end_date;
            $bm->save();

            return back()->with([
                'type' => 'success',
                'message' => 'Birthday Automation Created.'
            ]);
        }

        if ($request->automation == 'email automation') {
            $contact = BirthdayContactList::findOrFail($request->birthday_list_id)->get();
            $bm = new BirthdayAutomation();
            $bm->user_id = FacadesAuth::user()->id;
            $bm->birthday_contact_list_id = $request->birthday_list_id;
            $bm->title = $request->title;
            $bm->sms_type = $request->sms_type;
            $bm->message = $request->message;
            $bm->automation = json_encode($request->automation);
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
            $bm->start_date = $request->start_date;
            $bm->end_date = $request->end_date;
            $bm->save();

            return back()->with([
                'type' => 'success',
                'message' => 'Birthday Automation Created.'
            ]);
        }
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
