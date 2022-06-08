<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Operator extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['studio_id','name_ru','name_lv','number'];

    public function getDeletedAtAttribute($value)
    {
        return (boolval($value) ? $value : false);
    }


    public function entrie()
    {
        return $this->hasMany(Entrie::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
