<?php

namespace App\Http\Requests\BallTechnician;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class EditBallTechnicianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|min:4|max:50',
            'name_lv' => 'required|string|min:4|max:50',
            'name_ru' => 'required|string|min:4|max:50',
            'number' => 'required|digits_between:5,15',
            'password' => 'confirmed|min:4|max:50',
//            'ball_tech_admin' => 'boolean',
        ];
    }


    public function persist(){

        $userData = [
            'username' => $this->username
        ];

        if($this->ball_tech_admin == null) {
            $this->ball_tech_admin = false;
        }

        if($this->password) {
            $userData['password'] = bcrypt($this->password);
            $userData['change_password'] = 1;
        }


        $user = User::findOrFail($this->id);
        $user->update($userData);
        $user->ballTechnician()->update( $this->only(['name_lv', 'name_ru', 'number', 'ball_tech_admin']) );


        if($this->ball_tech_admin == 1){
            $user->assign('ball-technician-admin');
            $user->retract('ball-technician');
        }else{
            $user->retract('ball-technician-admin');
            $user->assign('ball-technician');
        }
        return 'ok';
    }
}
