<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Chef;
use Illuminate\Http\Request;
use App\Operator;
use App\Studio;
use App\DescriptionType;

class ChatMessage extends Model
{
    protected $fillable = ['sender','body','age','studio_id','token'];
}
