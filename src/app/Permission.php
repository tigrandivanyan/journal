<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [ 'ability_id', 'entity_id', 'entity_type', 'forbidden', 'scope'];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'entity_id');
    }

    public function ability()
    {
        return $this->hasOne(Ability::class, 'id', 'ability_id');
    }


}
