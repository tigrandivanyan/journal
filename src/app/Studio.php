<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Description;
use App\Operator;
use App\Entrie;
use App\TechMsg;
use Illuminate\Support\Collection;
use Silber\Bouncer\Database\Queries\Abilities;
use Illuminate\Database\Eloquent\SoftDeletes;


class Studio extends Model
{

    protected $dates = ['deleted_at'];

    protected $fillable = ['name_eng', 'name_ru', 'order', 'rng_id'];

    public function getDeletedAtAttribute($value)
    {
        return (boolval($value) ? true : false);
    }


    public function description()
    {
        return $this->hasMany(Description::class);
    }

    public function operator()
    {
        return $this->hasMany(Operator::class);
    }

    public function entry()
    {
        return $this->hasMany(Entrie::class);
    }
    public function tech_msg()
    {
        return $this->hasMany(TechMsg::class);
    }
    public function timebreaks()
    {
        return $this->hasMany(TimeBreak::class, 'studio', 'name_eng');
    }
    public function ballJournal()
    {
        return $this->hasMany(BallJournal::class);
    }
    public function getChefsInsideAttribute()
    {
        $timeBreaks = $this->timebreaks()
            ->whereNotNull('started')
            ->whereNull('ended')
            ->whereNotNull('chef_id')
            ->get();

        return $timeBreaks->map(function (TimeBreak $timeBreak) {
            return (object)[
                'id' => $timeBreak->id,
                'chef' => [
                    'id' => $timeBreak->chef->id,
                    'name' => $timeBreak->chef->name_ru,
                ],
                'type' => $timeBreak->type,
                'started_at' => $timeBreak->started,
                'started_at_iso' => $timeBreak->started->format(Carbon::ISO8601),
            ];
        });
    }
    public function getOperatorsInsideAttribute()
    {
        $abilities = \Bouncer::ability()->where([
            'name' => 'access-studio-temporary',
            'entity_type' => get_class($this),
            'entity_id' => $this->id
        ])->with('users.operator')->get();

        $operators = new Collection();
        foreach ($abilities as $ability) {
            foreach ($ability->users as $user) {
                $operators->push($user->operator);
            }
        }
        $nativeOperators = $this->operator()->with('user')->get();

        return $operators = $operators
            ->merge($nativeOperators)
            ->sort(function (Operator $operator) {
                return $operator->user->logged_in_at;
            })
            ->reverse()
            ->flatten()
            ->map(function(Operator $operatorProfile) {
                return [
                    'id' => $operatorProfile->user_id,
                    'name' => $operatorProfile->name_ru,
                    'name_ru' => $operatorProfile->name_ru,
                    'name_lv' => $operatorProfile->name_lv,
                ];
            })
            ;
    }
}
