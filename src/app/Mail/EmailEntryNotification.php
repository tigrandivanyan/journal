<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Email;
use App\Studio;
use Mail;

class EmailEntryNotification extends Mailable
{
    use Queueable, SerializesModels;



    public function sendMail($data, $user){


        $dataToSend = [
            'description'=>$data->description,
            'tour'=> $data->tour,
            'date'=>$data->date,
            'time'=>$data->time,
        ];

        if(isset($user->operator)){
            $dataToSend['operator'] = $user->operator->name_ru;
        }else{
            $dataToSend['operator'] = $user->username;
        }

        $emails = Email::where('status', 1)->get()->pluck('email')->toArray();
        $studio = Studio::findOrFail($data->studio_id);
        $studioName = $studio->name_ru;


        Mail::send('general_view.emails_template.email_template_for_mailing', $dataToSend, function ($message) use ($studioName, $emails) {
            $message->from('alpha.media.riga@gmail.com', 'AlphaMedia');
            $message->to($emails);
            $message->subject($studioName);
        });


    }

}
