<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\ReceiveMessage;
use App\Events\SendChat;
use App\Models\Admin;
use App\Models\Chat;
use App\Models\Message;
use App\Models\MessageUser;
use App\Models\OjafunnelNotification;
use App\Models\PersonalChatroom;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ChatController extends Controller
{
    function fcm($body, $firebaseToken)
    {
        $SERVER_API_KEY = config('app.fcm_token');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => config('app.name'),
                "body" => $body,
                'image' => URL::asset('assets/images/Logo-fav.png'),
            ],
            'vibrate' => 1,
            'sound' => 1
        ];

        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $result = curl_exec ( $ch );

        return $result;
    }

    public function check($recieverId)
    {
        $senderId = Auth::user()->id;

        $checkExist = MessageUser::where(function ($query) use ($recieverId, $senderId) {
            $query->where('sender_id', $senderId)
                ->where('reciever_id', $recieverId);
        })->orWhere(function ($query) use ($recieverId, $senderId) {
            $query->where('reciever_id', $senderId)
                ->where('sender_id', $recieverId);
        })->first();

        $data = [
            'sender_id' => $senderId,
            'reciever_id' => $recieverId
        ];

        if (!$checkExist) {
            $createConvo = MessageUser::create($data);
            return $createConvo->id;
        } else {
            return $checkExist->id;
        }
    }

    public function store(Request $request)
    {
        $messageUser = MessageUser::find($request->convo_id);

        if($messageUser->sender_id == Auth::user()->id)
        {
            $admin = Admin::where('id', $messageUser->reciever_id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            $adminProfile = Admin::where('id', $messageUser->reciever_id)->first();

            $data = [
                'message_users_id' => $request->convo_id,
                'user_id' => Auth::user()->id,
                'message' => $request->message
            ];

            $sendMessage = Message::create($data);

            // OjafunnelNotification::create([
            //     'admin_id' => $adminProfile->id,
            //     'title' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            //     'body' => $request->message
            // ]);

            $this->fcm('Message from '.Auth::user()->first_name.' '.Auth::user()->last_name.': '.$request->message, $admin);

            if($sendMessage){
                return "Message Sent";
            }else{
                return "Error sending message.";
            }
        } else {
            $admin = Admin::where('id', $messageUser->sender_id)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            $adminProfile = Admin::where('id', $messageUser->sender_id)->first();

            $data = [
                'message_users_id' => $request->convo_id,
                'user_id' => Auth::user()->id,
                'message' => $request->message
            ];

            $sendMessage = Message::create($data);

            // OjafunnelNotification::create([
            //     'admin_id' => $adminProfile->id,
            //     'title' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            //     'body' => $request->message
            // ]);

            $this->fcm('Message from '.Auth::user()->first_name.' '.Auth::user()->last_name.': '.$request->message, $admin);

            if($sendMessage){
                return "Message Sent";
            } else {
                return "Error sending message.";
            }

        }
    }

    public function load($reciever, $sender)
    {
        $boxType = "";

        $checkExist = MessageUser::where(function ($query) use ($reciever, $sender) {
            $query->where('sender_id', $sender)
                ->where('reciever_id', $reciever);
        })->orWhere(function ($query) use ($reciever, $sender) {
            $query->where('reciever_id', $sender)
                ->where('sender_id', $reciever);
        })->first();

        $allMessages = Message::where('message_users_id', $checkExist->id)->orderBy('id', 'asc')->get();

        foreach ($allMessages as $message) {
            // Check if the message user ID is not equal to the authenticated user's ID or the sender's ID
            if ($message->user_id <> Auth::user()->id) {
                // Check if the message has not been read
                if ($message->read_at == null) {
                    // Update the read_at field
                    $message->update([
                        'read_at' => now()
                    ]);
                }
            }
        }

        // foreach($allMessages as $row){
        //     if($id1[0]==$row['message_users_id']){$boxType = "p-2 recieverBox ml-auto";}else{$boxType = "float-left p-2 mb-2 senderBox";}
        //     echo "<div class='p-2 d-flex'>";
        //     echo "<div class='".$boxType."'>";
        //     echo "<p>".$row['message']."</p>";
        //     echo "</div>";
        //     echo "</div>";
        // }
        $tobePassed = [$allMessages, Auth::user()->id];
        return $tobePassed;
    }

    public function markMessageAsRead($messageId)
    {
        // Assuming you have a Message model with a read_at column
        $message = Message::find($messageId);

        // Check if the authenticated user is the recipient of the message
        if (Auth::user()->id <> $message->message_users_id) {
            $message->update(['read_at' => now()]);
        }

        // You can return a response if needed
        return $message;
    }

    public function retrieveNew($reciever, $sender, $lastId)
    {
        $checkExist = MessageUser::where(function ($query) use ($reciever, $sender) {
            $query->where('sender_id', $sender)
                ->where('reciever_id', $reciever);
        })->orWhere(function ($query) use ($reciever, $sender) {
            $query->where('reciever_id', $sender)
                ->where('sender_id', $reciever);
        })->first();

        $allMessages = Message::where('id', '>=', $lastId)->where(['message_users_id' => $checkExist->id, 'user_id' => $reciever])->orderBy('id', 'asc')->get();

        foreach ($allMessages as $message) {
            // Check if the message user ID is not equal to the authenticated user's ID or the sender's ID
            if ($message->user_id <> Auth::user()->id) {
                // Check if the message has not been read
                if ($message->read_at == null) {
                    // Update the read_at field
                    $message->update([
                        'read_at' => now()
                    ]);
                }
            }
        }

        return $allMessages;
    }
}
