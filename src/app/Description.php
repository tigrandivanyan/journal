<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Studio;
use App\DescriptionType;

class Description extends Model
{
    protected $fillable = ['frequency','type_id','text','studio_id'];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function type()
    {
        return $this->belongsTo(DescriptionType::class, 'type_id');
    }
    public function tech_msg()
    {
        return $this->hasMany(TechMsg::class);
    }
}
