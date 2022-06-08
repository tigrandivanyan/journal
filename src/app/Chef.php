<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chef extends Model
{
    use SoftDeletes;

    protected $fillable = ['name_ru', 'name_lv', 'number'];

    public function getDeletedAtAttribute($value)
    {
        return (boolval($value) ? $value : false);
    }

    public function entry()
    {
        return $this->hasMany(Entrie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
