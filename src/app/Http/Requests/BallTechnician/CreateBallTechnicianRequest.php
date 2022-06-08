<?php

namespace App\Http\Requests\BallTechnician;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class CreateBallTechnicianRequest extends FormRequest
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
            'username' => 'required|string|min:4|max:50|unique:users,username',
            'name_lv' => 'required|string|min:4|max:50',
            'name_ru' => 'required|string|min:4|max:50',
            'number' => 'required|digits_between:5,15',
            'password' => 'required|confirmed|min:4|max:50',
            'ball_tech_admin' => 'boolean',
        ];
    }

    public function persist(){

        $userData = [
            'username' => $this->username,
            'password' => bcrypt($this->password)
        ];

        $user = User::create($userData);

        $user->ballTechnician()->create( $this->only(['name_lv', 'name_ru', 'number', 'ball_tech_admin']));

        // bouncer staff, set the role
        $this->ball_tech_admin ? $user->assign('ball-technician-admin') : $user->assign('ball-technician');

        return 'ok';
    }
}
