<?php

namespace App\Http\Requests\Chef;

use Illuminate\Foundation\Http\FormRequest;
use App\Chef;
use App\User;


class EditChefRequest extends FormRequest
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
            'password' => 'string|confirmed|min:4|max:50',
        ];
    }

    public function persist(){

        $userData = [
            'username' => $this->username
        ];

        if($this->password) {
            $userData['password'] = bcrypt($this->password);
            $userData['change_password'] = 1;
        }

        $user = User::findOrFail($this->id);
        $user->update($userData);
        $user->chef()->update( $this->only(['name_lv', 'name_ru', 'number']) );

        return 'ok';
    }
}



