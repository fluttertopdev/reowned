<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TypingEvent implements ShouldBroadcast
{
    public $conversation_id;
    public $user_id;

    public function __construct($conversation_id, $user_id)
    {
        $this->conversation_id = $conversation_id;
        $this->user_id = $user_id;
    }

    public function broadcastOn()
    {
        return new Channel('chat.' . $this->conversation_id);
    }

    public function broadcastAs()
    {
        return 'typing';
    }
}