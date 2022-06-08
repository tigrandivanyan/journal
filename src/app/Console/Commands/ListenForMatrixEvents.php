<?php

namespace App\Console\Commands;

use App\Matrix\MatrixTokenResource;
use App\Matrix\MatrixRoomResource;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Matrix\MatrixMessageRepository;


class ListenForMatrixEvents extends Command
{
    /**
     * @var MatrixMessageRepository
     */
    protected $matrixMessageRepository;
    protected $matrixRoomResource;
    protected $matrixTokenResource;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'matrix:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listens matrix events and writes messages to DB';


    /**
     * ListenForMatrixEvents constructor.
     * @param MatrixMessageRepository $matrixMessageRepository
     */
    public function __construct(MatrixMessageRepository $matrixMessageRepository)
    {
        $this->matrixMessageRepository = $matrixMessageRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        $accessToken = $this->getAuthToken();
        $token = $this->getToken();


        while (1) {
            $request = $client->get('https://matrix.bingo-boom.ru/_matrix/client/r0/events?access_token='.$accessToken.'&from='.$token);
            $body = $request->getBody();
            $response = json_decode($body);

            foreach ($response->chunk as $item) {
                if ($item->type == 'm.room.message') {
                    $this->onMessage($item);
                }
//                $this->info($item->type);
//                $this->info(json_encode($item));
            }
            $token = $response->end;
            $this->saveToken($token);
        }
    }
    protected function saveToken($token)
    {
        Cache::put('matrix.events.token', $token, 3600);
    }
    protected function getToken()
    {
        return Cache::get('matrix.events.token', function () {
            return $this->getInitialToken();
        });
    }
    protected function getInitialToken()
    {
        $matrixTokenObject = new MatrixTokenResource;
        $token = $matrixTokenObject->getSyncToken();
        $this->info("Received initial token: ".$token);
        return $token;
    }
    public static function getAuthToken()
    {
        $matrixTokenObject = new MatrixTokenResource;
        $token = $matrixTokenObject->getLoginToken();
        return $token;
    }
    protected function onMessage($messageData)
    {
        $content = $messageData->content;
        $roomId = $messageData->room_id;
        $age = $messageData->age;
        $serverTime = $messageData->origin_server_ts;
        $sender = $messageData->sender;
        $text = $content->body;

        $age = ($serverTime - $age)/1000;
        $age = date('Y-m-d H:i:s', $age);
        $senderShort = substr($sender, 1, strpos($sender, ':')-1);


        $newMessage = $this->matrixMessageRepository
            ->store($senderShort, $text, $age, $this->getStudioByRoomId($roomId));

        $this->warn("{$senderShort} age {$age} text: {$text} roomId: {$roomId}");
    }
    protected function getStudioByRoomId($roomId)
    {
        $matrixRoomObject = new MatrixRoomResource;
        $studio_id = $matrixRoomObject->getRoomTargetStudioId($roomId);
        return $studio_id;
    }
}
