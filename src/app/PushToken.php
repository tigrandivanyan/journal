<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushToken extends Model
{
    //
    protected $table = 'push_tokens';
    protected $fillable = ['token'];
}
