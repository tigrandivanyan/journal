<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 27/02/2018
 * Time: 17:48
 */

namespace App\Matrix;

use App\ChatMessage;

class MatrixMessageRepository
{
    public function store($sender, $body, $age, $studioId)
    {
        return ChatMessage::create([
                   'sender'=>$sender,
                   'body'=>$body,
                   'age'=>$age,
                   'studio_id'=>$studioId
               ]);
    }
}
