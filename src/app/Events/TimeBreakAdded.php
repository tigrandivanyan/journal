<?php

namespace App\Events;

use App\TimeBreak;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TimeBreakAdded extends TimeBreakEventContract implements ShouldBroadcast
{
    public function broadcastAs()
    {
        return 'created';
    }
}
