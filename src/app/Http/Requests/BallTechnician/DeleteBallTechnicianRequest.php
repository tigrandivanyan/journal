<?php

namespace App\Http\Requests\BallTechnician;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class DeleteBallTechnicianRequest extends FormRequest
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
        $user->retract('ball-technician');
        $user->retract('ball-technician-admin');
        $user->ballTechnician()->delete();
        return 'ok';

    }
}
