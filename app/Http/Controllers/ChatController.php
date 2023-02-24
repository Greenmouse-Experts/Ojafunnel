<?php

namespace App\Http\Controllers;

use Acelle\Model\User;
use App\Events\ReceiveMessage;
use App\Events\SendChat;
use App\Models\Chat;
use App\Models\PersonalChatroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //
    public function startChat ($id, Request $request) 
    {
        if (Auth::user()->id == $request->id) 
        {
            return response()->json([
                'success' => false,
                'message' => 'Cannot talk to yourself.'
            ]);
        }

        // check whether if this user and the targeted user already has a chatroom
        $isExist = PersonalChatroom::whereIn('user_id', [Auth::user()->id, $id])
                                    ->whereIn('friend_id', [Auth::user()->id, $id])
                                    ->count();

        if ($isExist > 0) 
        {
            // get the room id
            $room_id = PersonalChatroom::whereIn('user_id', [Auth::user()->id, $id])
                                        ->whereIn('friend_id', [Auth::user()->id, $id])
                                        ->first('room_id');
                                  
            // update the state of interlocutor's chat from unread to read
            Chat::where('user_id', $id)
                ->where('room_id', $room_id['room_id'])
                ->where('read_at', null)
                ->update(['read_at' => now()]);
                                        
            // fetch all of the chats from this chatroom
            $chats = Chat::where('room_id', $room_id['room_id'])->orderBy('created_at', 'asc')->get();

            // create an array to be sent as a HTTP response
            $data = [];
            $data['room_id'] = $room_id['room_id'];
            $data['user'] = User::find($id);
            
            if (count($chats) > 0) {
                foreach ($chats as $chat) {
                    $data['messages'][] = [
                        'sender' => User::find($chat->user_id),
                        'message' => $chat->message,
                        'attachment' => $chat->attachment,
                        'read_at' => $chat->read_at,
                        'time' => $chat->created_at
                    ];
                }    
            } else {
                $data['messages'] = [];
            }

            $data['exist'] = 1;
            
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } else 
        {
            // if they don't have a chatroom, then create one.
            $room_id = Auth::user()->id . 'CHAT' . $id;
            PersonalChatroom::create([
                'room_id' => $room_id,
                'user_id' => Auth::user()->id,
                'friend_id' => $id
            ]);

            $data = [];
            $data['room_id'] = $room_id;
            $data['user'] = User::find($id);
            $data['messages'] = [];
            $data['exist'] = 0;

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }
    }

    public function fetchAllRecentChats () 
    {
        // prepare an array to contain all of the responses
        $result = [];

        // get the chatroom record from this user
        $query = PersonalChatroom::where('user_id', Auth::user()->id)
        ->orWhere('friend_id', Auth::user()->id)
        ->get();

        if ($query) {
            foreach ($query as $chatroom) {

                // get the interlocutor's data
                if ($chatroom->user_id == Auth::user()->id) {
                    $friend = User::where('id', $chatroom->friend_id)->first();
                } else {
                    $friend = User::where('id', $chatroom->user_id)->first();
                }

                // get the most recent chat from the chatroom
                $latestChat = Chat::where('room_id', $chatroom['room_id'])
                                    ->latest()
                                    ->first();
                            
                // check how many unread chats
                $unreadChats = Chat::where('user_id', $friend['id'])
                                    ->where('room_id', $chatroom['room_id'])
                                    ->where('read_at', null)
                                    ->count();

                // if they already have chatted before
                if ($latestChat) {
                    $result[] = [
                        'connection' => $friend,
                        'chat' => $latestChat,
                        'unread' => $unreadChats
                    ];
                    $result = array_reverse(array_values(Arr::sort($result, function ($key) {
                        return response()->json([
                            'success' => true,
                            'message' => 'Chat retrieved.',
                            'data' => $key['chat']['created_at']
                        ]);
                    })));
                } else {
                    // if this is the first time they create the chatroom
                    $result[] = [
                        'connection' => $friend,
                        'chat' => [
                            'message' => null,
                            'created_at' => null,
                            'updated_at' => null,
                        ],
                        'unread' => 0
                    ];
                }
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Chat retrieved.',
                'data' => $result
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You dont have any chat yet.'
            ]);
        }
    }

    public function sendMessage (Request $request) 
    {
        if($request->attachment == null)
        {
            $payload = $request->user()->chats()->create([
                'room_id' => $request->room_id,
                'message' => $request->message
            ]);
    
            broadcast(new SendChat($payload->load('user')))->toOthers();
            broadcast(new ReceiveMessage($payload->load('user')))->toOthers();
    
            return response()->json([
                'success' => true,
            ]);
        } else {
            $validator = Validate::make(request()->all(), [
                'attachment' => 'required|mimes:jpeg,png,bmp,jpg,mp4,mov,ogg,qt,wmv,avi,m3u8,doc,docx,pdf,csv,xlsx,xlsb,xls,xlsm |max:50000',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please see errors parameter for all errors.',
                    'errors' => $validator->errors()
                ]);
            }

            $file = request()->attachment->getClientOriginalName();

            $filename = pathinfo($file, PATHINFO_FILENAME);
    
            $response = cloudinary()->uploadFile($request->file('attachment')->getRealPath(),
                            [
                                'folder' => config('app.name'),
                                "public_id" => $filename,
                                "use_filename" => TRUE,
                            ])->getSecurePath();
            
            $payload = $request->user()->chats()->create([
                'room_id' => $request->room_id,
                'message' => $request->message,
                'attachment' => $response
            ]);
    
            broadcast(new SendChat($payload->load('user')))->toOthers();
            broadcast(new ReceiveMessage($payload->load('user')))->toOthers();
    
            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function clearChat (Request $request) 
    {
        if (Auth::check() && $request->csrf_token == csrf_token()) {
            $chats = Chat::where('room_id', $request->room_id)->get();

            foreach($chats as $chat)
            {
                $token = explode('/', $chat->attachment);
                $token2 = explode('.', $token[sizeof($token)-1]);

                if($chat->attachment)
                {
                    cloudinary()->destroy('Trivhunt/'.$token2[0]);
                }

                $chat->delete();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Chats have been deleted successfully.'
        ]);
    }

    public function deleteSingleChat ($id, Request $request) 
    {
        if (Auth::check() && $request->csrf_token == csrf_token()) {
            $chat = Chat::find($id);
            $token = explode('/', $chat->attachment);
            $token2 = explode('.', $token[sizeof($token)-1]);

            if($chat->attachment)
            {
                cloudinary()->destroy('Trivhunt/'.$token2[0]);
            }

            $chat->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Chat have been deleted successfully.'
        ]);
    }

    public function deleteAllChats (Request $request) 
    {
        if (Auth::check() && $request->csrf_token == csrf_token()) {
            $room_id = PersonalChatroom::where('user_id', Auth::user()->id)
                                        ->orWhere('friend_id', Auth::user()->id)
                                        ->get('room_id');

            
            // delete all chats that belong to this user
            $chat = Chat::whereIn('room_id', $room_id)->delete();

            // delete all chatrooms that contain this user
            PersonalChatroom::where('user_id', Auth::user()->id)
                            ->orWhere('friend_id', Auth::user()->id)
                            ->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'All chats have been deleted successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Authentication needed.'
            ]);
        }
    }
 
    public function deleteChatroom (Request $request) 
    {
        if ($request->csrf_token != csrf_token()) {
            return;
        }

        // delete all chats in the particular chatroom
        $chats = Chat::where('room_id', $request->room_id)->get();

        foreach($chats as $chat)
        {
            $token = explode('/', $chat->attachment);
            $token2 = explode('.', $token[sizeof($token)-1]);

            if($chat->attachment)
            {
                cloudinary()->destroy('Trivhunt/'.$token2[0]);
            }

            $chat->delete();
        }

        // delete the chatroom
        PersonalChatroom::where('room_id', $request->room_id)->delete();

        // return
        return response()->json([
            'success' => true,
            'message' => 'Chatroom has been deleted successfully.'
        ]);
    }

    public function markAsRead (Request $request) 
    {
        // set a value to the 'read_at' column
        Chat::where('id', $request->target_id)
            ->update(['read_at' => now()]);

        return response()->json([
            'success' => false,
            'message' => 'Chat with id ' . $request->target_id . ' has been updated.'
        ]);
    }

    public function downloadAttachment ($id, Request $request) 
    {
        if (Auth::check() && $request->csrf_token == csrf_token()) {
            $chat = Chat::find($id);

            if($chat->attachment)
            {
                $url = $chat->attachment;

                $contents = file_get_contents($url);

                $name = substr($url, strrpos($url, '/') + 1);

                Storage::disk('public')->put('chats/' . $name, $contents);

                return Storage::download('/public/chats/'.$name);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Request declined.'
        ]);
    }

    function path_fixer($path) 
    {
        // Laravel uses / separator by default.
        
        if (DIRECTORY_SEPARATOR != '/') { // Let's check the current system default is this.
            return str_replace('/', DIRECTORY_SEPARATOR, $path); // Change the separator for current system.
        }
    
        return $path; // Use coming path.
    }
}