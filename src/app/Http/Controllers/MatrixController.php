<?php

namespace App\Http\Controllers;

use App\Matrix\MatrixTokenResource;
use App\Matrix\Message;
use App\Room;
use App\Entrie;
use App\User;
use App\ChatMessage;
use Exception;
use App\Matrix\RoomsResource;
use Illuminate\Http\Request;

use Updivision\Matrix\Resources\UserSession;
use Illuminate\Support\Facades\Hash;
use App\Matrix\MatrixRoomResource;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class MatrixController extends Controller
{
    public function cacheTokenState()
    {
        return Cache::get('matrix.events.token', 'empty');
    }

    public function index()  //  display all users and they active rooms
    {
        $matrixUsers = Room::all();
        return view('admin_panel_view.matrix.matrix', compact('matrixUsers'));
    }



    public function saveRoom(Request $request) // update room in matrix record
    {
        Room::where('purpose', $request->purpose)->update([
            'room_id' => $request->room_id,
            'room_name' => $request->room_name,
            'active' => 1
        ]);

        return redirect('admin_panel/matrix');
    }



    public function store(Request $request) // save new matrix record, room + user_data
    {
        Room::create([
            'username' => $request->username,
            'purpose' => $request->purpose,
            'password' => Hash::make($request->password)
        ]);

        return back();
    }

    public function destroy(Request $request)
    {
        Room::find($request->room_record_id)->delete();
        return back();
    }



    public function userLogin($username, $password, $entry_id)
    {
        $entry = Room::where('id', $entry_id)->first();
        $matrix_room = config('matrix.room');
        $matrix = app('matrix');
        $session = new UserSession($matrix);
        $storedPassword = $entry['password'];

        if (Hash::check($password, $storedPassword)) {
            try {
                $loginStatus = 'ok';
                $session->login($username, $password);
            } catch (Exception $e) {
                $loginStatus = 'wrong';
            }
            return $loginStatus;
        } else {
            $loginStatus = 'incorrect';
            return $loginStatus;
        }
    }


    public function login(Request $request)//  show all rooms id and it names
    {
        $entry_id = $request->entry_id;
        $purpose = $request->purpose;

        if (isset($request->not_active) && $request->not_active == 'on') {
            Room::where('id', $entry_id)->update([
                'active' => 0
            ]);
            return back();
        } else {
            Room::where('purpose', $purpose)->update([
                'active' => 1
            ]);

            $matrix_username = $request->username;
            $matrix_password = $request->password;

            $result = $this->userLogin($matrix_username, $matrix_password, $entry_id);

            if ($result == 'incorrect') {
                return back()->withErrors('Wrong Password');
            } elseif ($result == 'wrong') {
                return back()->withErrors('User dont have permission fot this room!');
            } elseif ($result == 'ok') {
                $matrix = app('matrix');
                $roomResource = new RoomsResource($matrix);

                $rooms = $roomResource->getJoinedRooms();
                $allAccesibleRooms = [];

                foreach ($rooms['joined_rooms'] as $room) {
                    try {
                        $state = $roomResource->getRoomState($room);
                    } catch (Exception $e) {
                        continue;
                    }
                    $allAccesibleRooms[$room] = $state['name'];
                }
                return view('admin_panel_view.matrix.room', compact('allAccesibleRooms', 'matrix_username', 'purpose'));
            } else {
                return back()->withErrors('Somethign went wrong');
            }
        }
    }

// @todo: refactor this method, looks trashy
    public function sendMessageToChat(Request $request, $createdEntry = null) //sending message
    {

        if($request->tech_msg && $createdEntry != null){  // second part of an message - send after new entry is created

            $user = Room::where('purpose', 'support')->first();

            if($createdEntry->chef_id){
                $msgAuthor = User::with('chef')->where('id', $createdEntry->chef_id)->first();
                $msgAuthor = $msgAuthor->chef->name_ru;
            }else{
                $msgAuthor = User::with('operator')->where('id', $createdEntry->operator_id)->first();
                $msgAuthor = $msgAuthor->operator->name_ru;
            }

//            $moscowTime = Carbon::parse($createdEntry->created_at)->addHour();
            $unformattedMsg = "END: {$request->studio_name_ru}: {$request->description}";

            if(strlen($request->description)>90) {
                $substringDescriptionString = substr($createdEntry->description, 0, 180);
                $substringDescriptionString = $substringDescriptionString."...";
            }else {
                $substringDescriptionString = $request->description;
            }
            $request->chat_message = "<b>{$request->studio_name_ru}: </b> {$createdEntry->tour} (конец события)<br> <a href=' http://192.168.28.6/show-one-entry/{$createdEntry->id}'>{$substringDescriptionString}</a><br> Оператор: {$msgAuthor}<br><br>";



        }elseif (isset($request->support)) {  // first part of an message - send after operator pres a button with tech. msg text

            $user = Room::where('purpose', 'support')->first();
            $loggedUser = auth()->user();
// :todo this part definitely should not be in here
            $savedEntry = Entrie::create([
                'occurred_at'=> Carbon::now(),
                'user_id'=> $loggedUser->id,
                'description'=> "Отправил в тех. поддержку сообщение: ".trim($request->chat_message),
                'studio_id'=> $request->studio_id,
                'description_type_id' => $request->description_type_id
            ]);

            $unformattedMsg = "BEGIN: {$request->studio_name_ru}: {$request->chat_message} ";
            $request->chat_message = "<b>{$request->studio_name_ru}</b> (начало события)<br> {$request->chat_message}<br><br>";



        } else {  // chat message between the studio
            if($request->studio_name) {
                $user = Room::where('purpose', $request->studio_name)->first();
            }else{
                return false;
            }
        };

        $roomId = $user['room_id'];
        $room = new MatrixRoomResource;
        $roomResource = $room->getRoomResource();


        $sendMcgResult = $roomResource->sendMessage($roomId, new Message($unformattedMsg, Message::TYPE_TEXT, $request->chat_message));

        if (!$sendMcgResult) {
            $matrixTokenObject = new MatrixTokenResource;
            $matrixTokenObject->getLoginToken();
            $roomResource->sendMessage($roomId, new Message($request->chat_message, Message::TYPE_TEXT));
        }


        if (isset($savedEntry)) {
            return $savedEntry->id;
        }else{
            return $sendMcgResult;
        }
    }



    public function getStudioMessagesFromMatrixChat(Request $request)
    {
        $chatMessages = ChatMessage::where('studio_id', $request->studio_id)->latest('age')->limit($request->limit)->get();
        return $chatMessages;
    }
}
