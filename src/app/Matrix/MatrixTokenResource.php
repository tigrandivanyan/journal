<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 27/02/2018
 * Time: 17:17
 */

namespace App\Matrix;

use App\Matrix\RoomsResource;
use App\Room;
use Updivision\Matrix\Resources\UserSession;
use Exception;

class MatrixTokenResource
{
    public function getSyncToken()
    {
        $matrix = app('matrix');
        $roomResource = new RoomsResource($matrix);
        $roomStatus = $roomResource->getRoomStatus();
        return $token = $roomStatus['next_batch'];
    }



    public function getLoginToken()
    {
        //todo: where to take username and password from? this is not a good option i suppose
        $username = env('MATRIX_USERNAME', 'undefined');
        $password = env('MATRIX_PASSWORD', 'undefined');

        $matrix = app('matrix');
        $session = new UserSession($matrix);

        try {
            $loginResult = $session->login($username, $password);
            $loginToken = $loginResult['access_token'];
        } catch (Exception $e) {
            $loginToken = '';
        }
        return $loginToken;
    }
}
