<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TimeBreakRemoved extends TimeBreakEventContract implements ShouldBroadcast
{
    public function broadcastAs()
    {
        return 'removed';
    }
}
