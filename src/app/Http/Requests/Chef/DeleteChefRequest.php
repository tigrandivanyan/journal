<?php

namespace App\Http\Requests\Chef;

use Illuminate\Foundation\Http\FormRequest;
use App\User;


class DeleteChefRequest extends FormRequest
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
        return [];
    }

    public function persist(){
        $user = User::findOrFail($this->user_id);
        $user->retract('chef');
        $user->chef()->delete();
        return 'ok';
    }
}



