<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TechMsg extends Model
{
    protected $fillable = ['tech_msg_name_ru','tech_msg_name_eng','order','studio_id', 'corr_description_id'];

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function description()
    {
        return $this->belongsTo(Description::class, 'corr_description_id');
    }
}
