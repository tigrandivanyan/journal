<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TimeBreak extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['start', 'end', 'studio'];
    protected $dates = ['start', 'end', 'started', 'ended'];

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }
    public function chef()
    {
        return $this->belongsTo(User::class, 'chef_id');
    }
    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio', 'name_eng');
    }
}
