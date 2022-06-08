<?php

namespace App\Http\Requests\Entry;

use Illuminate\Foundation\Http\FormRequest;
use App\DescriptionType;
use Mail;
use App\Http\Controllers\MatrixController;
use App\Mail\EmailEntryNotification;

class EntryStoreRequest extends FormRequest
{

    protected $matrix, $email;

    public function __construct(MatrixController $matrixController, EmailEntryNotification $emailEntryNotification){
        parent::__construct();
        $this->matrix = $matrixController;
        $this->email = $emailEntryNotification;
    }


    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'tour' => 'numeric|max:5000000|min:0',
            'date' => 'required|date|date_format:Y-m-d',
            'time' => 'required|date_format:H:i:s',
            'chef_id' => 'numeric',
            'description_type_id' => 'numeric',
            'announcement' => 'numeric',
            'studio_id' => 'numeric',
            'studio_name_ru' => 'string',
            'studio' => 'string',
            'description' => 'required|string',
            'currentRngState' => 'string',
        ];
    }

    public function persist()
    {
        $user = auth()->user();

       $descriptionType = DescriptionType::findOrFail($this->description_type_id);

        $mailSend = null;
        if($descriptionType->email != 0){
            $this->email->sendMail($this, $user);
            $mailSend = 1;
        }



        $createdEntry = $user->storeEntry($this, $mailSend);

        if($this->tech_msg){  // send message to tech support chat
            $msgSendResult = $this->matrix->sendMessageToChat($this, $createdEntry);

            if(!$msgSendResult){
                return back()->withErrors("Возникла проблема с отправкой сообщения в тех. поддержку! Оповестите тех. поддержку по телефону! ");
            }
        }


        return true;
    }
}
