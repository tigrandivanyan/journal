<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 27/02/2018
 * Time: 17:17
 */

namespace App\Matrix;

use App\Room;
use App\Studio;

class MatrixRoomResource
{
    public function getRoomTargetStudioId($roomId)
    {
        $targetRoom = Room::where('room_id', $roomId)->first();
        $roomPurpose = $targetRoom['purpose'];
        if ($roomPurpose=='support') {
            $studio_id = 0;
        } else {
            $targetStudio = Studio::where('name_eng', $roomPurpose)->first();
            $studio_id = $targetStudio['id'];
        }
        return $studio_id;
    }

    public function getRoomResource()
    {
        $matrix = app('matrix');
        $roomResource = new RoomsResource($matrix);
        return $roomResource;
    }
}
