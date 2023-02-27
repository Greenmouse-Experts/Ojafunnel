<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\OjafunnelMailSupport;
use App\Models\OjafunnelNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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

        $admin = Admin::latest()->where('name', 'Admin')->first();

        OjafunnelMailSupport::create([
            'user_id' => Auth::user()->id,
            'admin_id' => $admin->id,
            'title' => $request->subject,
            'body' => $request->message,
            'by_who' => 'User'
        ]);

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
}
