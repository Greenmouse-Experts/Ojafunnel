<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\OjafunnelNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function get_all_notifications()
    {
        // $userNotifications = Notification::join('users', 'notifications.from', '=', 'users.id')
        //     ->latest()->where('to', Auth::user()->id)
        //     ->get(['users.first_name', 'users.last_name', 'users.account_type', 'notifications.*']);

        $userNotifications = OjafunnelNotification::latest()->where('to', Auth::user()->id)->get();

        if ($userNotifications->isEmpty()) {
            return response()->json([
                'success' => false,
                'data' => null
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'All Notifications Retrieved!',
            'data' => $userNotifications
        ]);
    }

    public function get_all_unread_notifications()
    {
        // $userUnreadNotifications = Notification::join('users', 'notifications.from', '=', 'users.id')
        //     ->latest()->where('to', Auth::user()->id)->where('notifications.status', 'Unread')
        //     ->get(['users.first_name', 'users.last_name', 'users.account_type', 'notifications.*']);

        $userUnreadNotifications = OjafunnelNotification::latest()->where('to', Auth::user()->id)->where('notifications.status', 'Unread')->get();

        if ($userUnreadNotifications->isEmpty()) {
            return response()->json([
                'success' => false,
                'data' => null
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'All Unread Notifications Retrieved!',
            'data' => $userUnreadNotifications
        ]);
    }

    public function count_unread_notifications()
    {
        $userCountUnreadNotifications = OjafunnelNotification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();

        return response()->json([
            'success' => true,
            'message' => 'All Unread Notifications Retrieved!',
            'data' => $userCountUnreadNotifications
        ]);
    }

    public function read_notification($id)
    {
        $notification = OjafunnelNotification::findorfail($id);

        $notification->status = 'Read';
        $notification->save();

        return response()->json([
            'success' => true,
            'message' => 'Notification Read Successfully'
        ]);
    }
}
