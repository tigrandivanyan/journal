<?php
/**
 * Created by PhpStorm.
 * User: kapec
 * Date: 10.12.2017
 * Time: 12:06
 */

namespace App\Services\TimeBreaks;

use App\Operator;
use App\Studio;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class TimeBreak implements Jsonable, Arrayable
{
    protected $studio;
    protected $start;
    protected $timebreak_db;
    protected $end;
    /**
     * @var Operator
     */
    protected $operator;

    public function __construct(Carbon $start = null, $end = null)
    {
        $this->start = $start;
        $this->end = $end ? $end : $start->copy()->addMinutes(15);
    }
    public function getStartTime()
    {
        return $this->start->format('H:i');
    }
    public function getEndTime()
    {
        return $this->end->format('H:i');
    }
    public function isOwned()
    {
        return !empty($this->studio) && !empty($this->operator);
    }
    public function setOwned(\App\TimeBreak $timeBreak)
    {
        $this->timebreak_db = $timeBreak;
        $this->studio = $timeBreak->studio()->first();
        $this->operator = $timeBreak->operator;
    }
    public function isChefThere()
    {
        return $this->timebreak_db->started && !$this->timebreak_db->ended;
    }
    public function isChefDone()
    {
        return $this->timebreak_db ? $this->timebreak_db->ended : null;
    }
    public function getChef()
    {
        return $this->timebreak_db ? $this->timebreak_db->chef : null;
    }
    public function getStudioName()
    {
        return $this->studio->name_ru;
    }
    public function getStudioId()
    {
        return $this->studio->name_eng;
    }
    public function getUserName()
    {
        return $this->operator->name_ru;
    }
    public function getUserId()
    {
        return $this->operator ? $this->operator->id : null;
    }
    public function getAgo()
    {
        return ($this->timebreak_db && $this->timebreak_db->started) ?
            $this->timebreak_db->started->diffForHumans() :
            null;
    }
    public function getStart($format = Carbon::ISO8601)
    {
        return $this->start->format($format);
    }

    public function getEnd($format = Carbon::ISO8601)
    {
        return $this->end->format($format);
    }
    /**
     * @return Carbon
     */
    public function getStarted($format = Carbon::ISO8601)
    {
        return $this->timebreak_db && $this->timebreak_db->started ? $this->timebreak_db->started->format($format) : null;
    }

    public function getEnded($format = Carbon::ISO8601)
    {
        return $this->timebreak_db && $this->timebreak_db->ended ? $this->timebreak_db->ended->format($format) : null;
    }
    public function getId()
    {
        return $this->timebreak_db ? $this->timebreak_db->id : null;
    }
    public function toArray()
    {
        return [
            'started' => $this->getStarted(),
            'ended' => $this->getEnded(),
            'start' => $this->getStart(),
            'ago' => $this->getAgo(),
            'end' => $this->getEnd(),
            'id' => $this->getId(),
            'chef' => $this->getChef() ? $this->getChef()->name_ru: '',
            'operator' => $this->isOwned() ? $this->getUserName(): '',
            'operator_id' => $this->isOwned() ? $this->getUserId(): '',
            'studio' => $this->isOwned() ? $this->getStudioName(): '',
            'studio_id' => $this->isOwned() ? $this->getStudioId(): '',
        ];
    }

    public function toJson($opt = 0)
    {
        return json_encode($this->toArray());
    }
}
