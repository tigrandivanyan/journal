<?php

namespace App\Http\Requests\Operator;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Studio;
use App\Entrie;

class CreateOperatorRequest extends FormRequest
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
            'name_ru' => 'required|string|min:4|max:50',
            'name_lv' => 'required|string|min:4|max:50',
            'number' => 'required|digits_between:5,15',
            'studio_id' => 'required|numeric',
            'password' => 'required|confirmed|min:4|max:50'
        ];
    }

    public function persist(){

        $studio = Studio::findOrFail($this->studio_id);

        $user = User::create([
            'username' => $this->username,
            'password' => bcrypt($this->password)
        ]);

        $user->operator()->create($this->only(['studio_id','name_ru','name_lv','number']));


        //bouncer staff
        $user->assign('operator');
        $user->allow('edit-studio', $studio);
        $user->allow('view-studio', $studio);

        \Bouncer::allow($user)->toOwn(Entrie::class)->to('edit');

        return 'ok';
    }
}
