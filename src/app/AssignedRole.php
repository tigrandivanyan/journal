<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AssignedRole extends Model
{

    protected $fillable = [ 'role_id', 'entity_id', 'entity_type', 'scope'];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'entity_id');
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
