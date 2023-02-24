<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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

        $admin = Admin::latest()->where('name', 'Administrator')->first();

        OjafunnelNotification::create([
            'to' => $admin->id,
            'title' => $request->title,
            'body' => $request->message,
            'image' => 'https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png',
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
