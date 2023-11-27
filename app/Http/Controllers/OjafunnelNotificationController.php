<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\OjafunnelMailSupport;
use App\Models\OjafunnelNotification;
use App\Models\ReplyMailSupport;
use App\Notifications\AdminMessageReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class OjafunnelNotificationController extends Controller
{
    //
    public function user_send_message(Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'subject' => ['required','string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $admin = Admin::latest()->first();

        $name = Auth::user()->first_name . ' ' .Auth::user()->last_name;

        $message = OjafunnelMailSupport::create([
            'user_id' => Auth::user()->id,
            'admin_id' => $admin->id,
            'title' => $request->subject,
            'body' => $request->message,
            'by_who' => 'User'
        ]);

        //  Send notification to the admin
        $admin->notify(new AdminMessageReceived($message));

        $firebaseToken = Admin::where('id', $admin->id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

        $this->fcm( 'New support mail from '.$name, $firebaseToken);
     
        return back()->with([
            'type' => 'success',
            'message' => 'Message sent successfully to Admin',
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


    public function reply_email_support($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'message' => ['required', 'string'],
        ]);

        $finder = Crypt::decrypt($id);
        $MailSupport = OjafunnelMailSupport::find($finder);

        ReplyMailSupport::create([
            'mail_id' => $MailSupport->id,
            'user_id' => $MailSupport->user_id,
            'admin_id' => $MailSupport->admin_id,
            'title' => 'Reply',
            'body' => $request->message,
            'replied_by' => 'user',
        ]);

        $name = Auth::user()->first_name . ' ' .Auth::user()->last_name;

        $firebaseToken = Admin::where('id', $MailSupport->admin_id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

        $this->fcm( 'Replied support mail from '.$name, $firebaseToken);

        return back()->with([
            'type' => 'success',
            'message' => 'Message replied successfully.',
        ]);
    }
}
