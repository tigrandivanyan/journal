<?php

namespace App\Http\Requests\Operator;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Studio;

class EditOperatorRequest extends FormRequest
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
            'name_ru' => 'required|string|min:4|max:50',
            'name_lv' => 'required|string|min:4|max:50',
            'number' => 'required|digits_between:5,15',
            'studio_id' => 'required|numeric',
            'password' => 'confirmed|min:4|max:50'
        ];
    }

    public function persist(){

        $user = User::findOrfail($this->id);

        if($this->studio_id != $this->studio_id_for_change && $this->studio_id_for_change != null){

            $oldStudio = Studio::findOrFail($this->studio_id);
            $newStudio = Studio::findOrFail($this->studio_id_for_change);

            $user->disallow('edit-studio', $oldStudio);
            $user->disallow('view-studio', $oldStudio);

            $user->allow('edit-studio', $newStudio);
            $user->allow('view-studio', $newStudio);
        }

        $userData = [
            'username' => $this->username
        ];

        $operatorData = [
            'name_ru' => $this->name_ru,
            'name_lv' => $this->name_lv,
            'number' => $this->number,
        ];

        if ($this->studio_id_for_change) {
            $operatorData['studio_id'] = $this->studio_id_for_change;
        }

        if ($this->password) {
            $userData['password'] = bcrypt($this->password);
            $userData['change_password'] = 1;
        }

        $user->update($userData);
        $user->operator()->update($operatorData);

        return 'ok';
    }
}
