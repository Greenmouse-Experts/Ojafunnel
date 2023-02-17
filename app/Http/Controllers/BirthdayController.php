<?php

namespace App\Http\Controllers;

use App\Models\BirthdayAutomation;
use App\Models\BirthdayContact;
use App\Models\BirthdayContactList;
use App\Models\Integration;
use App\Models\SendingServer;
use Illuminate\Http\Request;
use Auth;

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
        return view('dashboard.birthday.birthdayManage', [
            'username' => $username,
            'bm' => $bm,
        ]);
    }

    public function create_birthday($username)
    {
        $birthlist = BirthdayContactList::where('user_id', Auth::user()->id)->get();
        $sendingServer = SendingServer::where('customer_id', Auth::user()->id)->get();
        $smsServer = Integration::where('user_id', Auth::user()->id)->where('status', 'Active')->get();
        return view('dashboard.birthday.birthdayCreate', [
            'username' => $username,
            'birthlist' => $birthlist,
            'sendingServer' => $sendingServer,
            'smsServer' => $smsServer
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
        //dd($request->automation);
        $contact = BirthdayContactList::findOrFail($request->birthday_list_id)->get();
        $bm = new BirthdayAutomation();
        $bm->user_id = Auth::user()->id;
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
        $bm->sending_server = $request->sending_server || '';
        $bm->sender_id = $request->sender_id || '';
        $bm->integration = $request->integration || '';
        $bm->start_date = $request->start_date;
        $bm->end_date = $request->end_date;
        $bm->save();

        return back()->with([
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
}
