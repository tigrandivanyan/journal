<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 27/02/2018
 * Time: 17:17
 */

namespace App\Matrix;

use Updivision\Matrix\Resources\AbstractResource;

class RoomsResource extends AbstractResource
{
    public function getRoomStatus()
    {
        return $this->matrix()->request(
            'GET',
            $this->endpoint('sync'),
            [],
            [
                'access_token' => $this->data['access_token']
            ]
        );
    }



    public function getStatus()
    {
        return $this->matrix()->request(
            'GET',
            $this->endpoint('sync'),
            [],
            [
                'access_token' => $this->data['access_token']
            ]
        );
    }
    public function getRoomState($roomId)
    {
        return $this->matrix()->request(
            'GET',
            $this->endpoint('rooms/'.$roomId.'/state/m.room.name/'),
            [],
            [
                'access_token' => $this->data['access_token']
            ]
        );
    }


    public function createRoom()
    {
        return $this->matrix()->request(
            'POST',
            $this->endpoint('createRoom'),
            [
                "preset" => "public_chat",
                "room_alias_name" => "Ivars_Testing_Room",
                "name" => "The Grand Duke Pub",
                "topic" => "All about happy hour",
                "creation_content" => [
                    "m.federate" => false
                ]
            ],
            [
                'access_token' => $this->data['access_token'],
            ]
        );
    }

    public function getJoinedRooms()
    {
        return $this->matrix()->request(
            'GET',
            $this->endpoint('joined_rooms'),
            [],
            [
                'access_token' => $this->data['access_token']
            ]
        );
    }

    public function sendMessage($roomId, Message $message)
    {
        if ($this->check()) {

//            $mmsg = "<h2>Тур:</h2> 684002<br><h1>Дата:</h1> 2018-11-01 <stgong>Время:</stgong> 02:55:19<br><br><br><br><b>Оператор:</b> Дмитрий Ковальчук";

            $roomString = sprintf('rooms/%s/send/m.room.message', $roomId);

            return $this->matrix()->request(
                'POST',
                $this->endpoint($roomString),
                [
                    'msgtype' => $message->getType(),
                    'body' => $message->getBody(),
                    'format' => "org.matrix.custom.html",
                    'formatted_body' => $message->getFormattedBody(),
                ],
                [
                    'access_token' => $this->data['access_token']
                ]
            );
        }
    }


    public function getMessage($roomId, $token)
    {
        if ($this->check()) {
            $roomString = sprintf('rooms/%s/messages', $roomId);
            return $this->matrix()->request(
                'GET',
                $this->endpoint($roomString),
                [],
                [
                    'access_token' => $this->data['access_token'],
                    'from' => $token,
                    'dir' => "f"

                ]
            );
        }
    }
}
