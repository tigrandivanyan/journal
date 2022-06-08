<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Entrie;
use App\Studio;


class ApiController extends Controller
{

    public function api_get_current_tour($id){

        $client = new Client( array(
            'curl'            => array(CURLOPT_SSL_VERIFYHOST => false ),
            'allow_redirects' => false,
            'cookies'         => true,
        ) );

        $url = 'https://rng-hub2-evn.prod.rng:8001/rng/'.$id.'/';
        $response = $client->request('GET', $url, ['verify' => database_path('ca.pem')]);
        $statusCode = $response->getStatusCode();
        $body = json_decode($response->getBody()->getContents());

        return [$body->events, $body->game_id];

    }


    public function api_get_data_about_tour($game_id, $tour_id)
    {
       if(is_numeric($tour_id) && is_numeric($game_id)){

            $studio = Studio::where('order', $game_id)->first();
            if(!count($studio)){
                return 'No data with such parameters';
            }
            $entries = Entrie::with('user','chef','user','user.operator', 'user.chef', 'studio', 'type')->where('studio_id', $studio->id)->where('tour',  $tour_id)->get();

            $data['data'] = $entries;

            if(count($entries)){


                return response($data)->withHeaders([
                        'Content-Type' => 'application/vnd.api+json',
                    ]);

            }else{
                return 'No data with such parameters';
            }

        }else{
           return 'No data with such parameters';
       }
    }
}
