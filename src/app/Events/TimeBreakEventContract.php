<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/12/2017
 * Time: 10:50
 */

namespace App\Events;

use App\TimeBreak;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;

abstract class TimeBreakEventContract
{
    use InteractsWithSockets, SerializesModels;
    public $timebreak;

    public function __construct(TimeBreak $timeBreak)
    {
        $this->timebreak = $timeBreak;
    }

    public function broadcastOn()
    {
        return 'time-break';
    }
    abstract public function broadcastAs();
}
