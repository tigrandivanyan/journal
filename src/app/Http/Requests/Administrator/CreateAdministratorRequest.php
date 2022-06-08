<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Studio;
use App\Entrie;

class CreateAdministratorRequest extends FormRequest
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
            'password' => 'required|confirmed|min:4|max:50'
        ];
    }

    public function persist(){


        $user = User::create([
            'username' => $this->username,
            'password' => bcrypt($this->password)
        ]);


        //bouncer staff
        $user->assign('admin');
        $user->allow('view-all-studios');
        $user->allow('access-admin-panel');

        return 'ok';
    }
}
