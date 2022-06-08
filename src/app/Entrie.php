<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Entrie extends Model
{

    protected $dates = ['occurred_at'];

    protected $fillable = [
        'tour',
        'occurred_at',
        'user_id',
        'chef_id',
        'studio_id',
        'description',
        'current_rng_state',
        'description_type_id',
        'announcement',
        'announcement_deleted',
        'announcement_del',
        'mail'
    ];


    public function getAnnouncementAttribute($value) // this one converts tinyInt to boolean, done it because an API call must have true/false format
    {
        return (boolval($value) ? true : false);
    }


    public function getChefIdAttribute($value)
    {
        return (boolval($value) ? $value : false);
    }


    public function getAnnouncementDelAttribute($value)
    {
        return (boolval($value) ? true : false);
    }

    public function getMailAttribute($value)
    {
        return (boolval($value) ? true : false);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }


    public function chef()
    {
        return $this->belongsTo(Chef::class, 'chef_id');
    }


    public function operatorProfile()
    {
        return $this->belongsTo(Operator::class);
    }


    public function type()
    {
        return $this->belongsTo(DescriptionType::class, 'description_type_id');
    }


    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }


}
