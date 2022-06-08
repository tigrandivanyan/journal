<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BallTechnician extends Model
{
    use SoftDeletes;

    protected $fillable = ['name_ru', 'name_lv', 'number', 'ball_tech_admin'];

    public function ballJournal()
    {
        return $this->hasMany(BallJournal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

