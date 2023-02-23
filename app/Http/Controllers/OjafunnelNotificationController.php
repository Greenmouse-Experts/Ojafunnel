<?php

namespace App\Http\Controllers;

use App\Models\OjafunnelNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OjafunnelNotificationController extends Controller
{
    //
    public function user_send_message($user_id, Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'subject' => ['required','string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $id = Crypt::decrypt($user_id);

        $user = User::findorfail($id);

        Notification::create([
            'to' => $user->id,
            'title' => config('app.name'),
            'body' => 'Your '.config('app.name').' account has been verified.',
            'image' => config('app.url').'assets/images/icon.png',
        ]);

        FCMService::send(
            $user->fcm_token,
            [
                'title' => config('app.name'),
                'body' => $request->message,
                'image' => $request->subject,
                'sound' => 'default', 
                'badge' => '1',
            ]
        );

        /** Store information to include in mail in $data as an array */
        $data = array(
            'name' => $user->first_name.' '.$user->last_name,
            'email' => $user->email
        );
        
        /** Send message to the user */
        Mail::send('emails.notification', $data, function ($m) use ($data) {
            $m->to($data['email'])->subject(config('app.name'));
        });

        return back()->with([
            'type' => 'success',
            'icon' => 'mdi-check-all',
            'message' => 'Message sent successfully to '.$user->first_name.' '.$user->last_name,
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
