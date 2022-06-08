<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $fillable= [
        'name',
        'title',
        'entity_id',
        'entity_type',
        'only_owned',
        'scope'
    ];

    public function studio()
    {
        return $this->hasOne(Studio::class, 'id', 'entity_id');
    }
}
