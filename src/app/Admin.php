<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Admin extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['studio_id','name_ru','name_lv','number'];

    public function getDeletedAtAttribute($value)
    {
        return (boolval($value) ? $value : false);
    }


}
