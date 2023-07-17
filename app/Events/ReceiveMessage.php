<?php

namespace App\Events;

use App\Models\PersonalChatroom;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ReceiveMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $payload;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $room = PersonalChatroom::where('room_id', $this->payload['room_id'])->first();
        $receiver_id = 0;
        if ($room) {
            if ($room['user_id'] == Auth::user()->id) {
                $receiver_id = $room['admin_id'];
            } else {
                $receiver_id = $room['user_id'];
            }
        }

        return new PrivateChannel('user.' . $receiver_id);
    }
}
