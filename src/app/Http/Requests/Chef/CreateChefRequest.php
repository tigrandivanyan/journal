<?php

namespace App\Http\Requests\Chef;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class CreateChefRequest extends FormRequest
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
            'password' => 'required|confirmed|string|min:4|max:50',
        ];
    }

    public function persist(){

        $user = User::create([
            'username' => $this->get('username'),
            'password' => bcrypt($this->password)
        ]);

        $user->chef()->create( $this->only(['name_ru','name_lv','number']));

        $user->assign('chef');

        return 'ok';
    }
}