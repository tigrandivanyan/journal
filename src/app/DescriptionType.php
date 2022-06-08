<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Entrie;
use App\Description;

class DescriptionType extends Model
{
    protected $fillable = ['ru_name','eng_name', 'email', 'allow_to_edit'];

    public function getEmailAttribute($value)
    {
        return (boolval($value) ? true : false);
    }

    public function getAllowToEditAttribute($value)
    {
        return (boolval($value) ? true : false);
    }

    public function description()
    {
        return $this->hasMany(Description::class);
    }

    public function entry()
    {
        return $this->hasMany(Entrie::class);
    }
}
