<?php
/**
 * Created by PhpStorm.
 * User: kapec
 * Date: 10.12.2017
 * Time: 12:07
 */

namespace App\Services\TimeBreaks;

use App\TimeBreak as TimeBreakEloquent;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class TimeBreakFactory
{
    protected static $intervalMinutes = 15;
    protected static function getTimeRange(Carbon $from = null)
    {
        if (!$from) {
            $from = \Carbon\Carbon::now()->subMinutes(20);
        }

        $minutes = $from->minute;
        $from->second(0);
        $from->minute($minutes + (self::$intervalMinutes-$minutes % self::$intervalMinutes));
        $itemsInHour = 60 / self::$intervalMinutes;
        $items = new Collection();
        for ($i=0; $i< 6* $itemsInHour;$i++) {
            $break = new TimeBreak($from->copy()->addMinutes($i*15));
            $items->push($break);
        }
        return $items;
    }
    public static function createCollection(Collection $dbItems, $generateEmpty = true)
    {
        $times = self::getTimeRange();
        $missedItems = new Collection($dbItems);
        if ($generateEmpty) {
            $times->each(function (TimeBreak $timeBreak) use ($dbItems, &$missedItems) {
                $timeBreakDb = $missedItems->first(function (TimeBreakEloquent $timeBreakDb) use ($timeBreak) {
                    //@todo: test this
                    if ($timeBreak->getStart("Y-m-d H:i:s") >= $timeBreakDb->start &&
                        $timeBreak->getEnd("Y-m-d H:i:s") <= $timeBreakDb->end &&
                        !$timeBreakDb->ended
                    ) {
                        return true;
                    }
                    return false;
                });
                if ($timeBreakDb) {
                    $timeBreak->setOwned($timeBreakDb);
                    $missedItems = $missedItems->reject(function ($item) use ($timeBreakDb) {
                        return $item->id == $timeBreakDb->id;
                    });
                }
            });
        }
        $missedItems->reverse()->each(function ($item) use (&$times) {
            $timeBreak = new TimeBreak(new Carbon($item->start));
            $timeBreak->setOwned($item);
            $times->prepend($timeBreak);
        });
        return $times;
    }
    public static function findIntersection($start, $end, $excludeId = -1)
    {
        return TimeBreakEloquent::where(function ($q) use ($start, $end) {
            $q->orWhere(function ($q) use ($start, $end) {
                return
                    $q->where('start', '<', $end)
                        ->where('end', '>=', $end);
            })
                ->orWhere(function ($q) use ($start, $end) {
                    return $q
                        ->where('start', '<=', $start)
                        ->where('end', '>', $start);
                })->get();
        })
            ->where('id', '!=', $excludeId)
            ->whereNull('ended')
            ->get()
            ->map(function ($tb) {
                $timeBreak = new TimeBreak($tb->start);
                $timeBreak->setOwned($tb);
                return $timeBreak;
            });
    }
}
