<?php

namespace App\Listeners;

use App\Events\TimeBreakAdded;
use App\Events\TimeBreakEventContract;
use App\PushToken;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTimeBreaksUpdatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TimeBreakEventContract  $event
     * @return void
     */
    public function handle(TimeBreakEventContract $event)
    {
        $timeBreak = $event->timebreak;
        $id = PushToken::all()->map(function ($token) {
            return (string)$token->id;
        });
        if (!$id->count()) {
            return;
        }
        /** @var \ExponentPhpSDK\Expo $expo */
        $expo = app('expo-push');
        $expo->notify($id->toArray(), [
            'sound' => 'default',
            'body' => sprintf(
                '%s резевервация в %s %s',
                $event->broadcastAs() == 'created' ? 'Добавлена' : "Удалена",
                $timeBreak->start->format('H:i d.m.Y'),
                $timeBreak->studio()->first()->fullName
            )
        ]);
    }
}
