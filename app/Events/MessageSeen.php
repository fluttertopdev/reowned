<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;


class MessageSeen implements ShouldBroadcastNow
{
    public $conversation_id;

    public function __construct($conversation_id)
    {
        $this->conversation_id = $conversation_id;
    }

    public function broadcastOn()
    {
        return new Channel('chat.' . $this->conversation_id);
    }

    public function broadcastAs()
    {
        return 'seen';
    }
}
