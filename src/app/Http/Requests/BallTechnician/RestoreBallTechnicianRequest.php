<?php

namespace App\Http\Requests\BallTechnician;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class RestoreBallTechnicianRequest extends FormRequest
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

        $user = User::findOrFail($this->ball_technician_user_id);
        $user->ballTechnician()->withTrashed()->restore();
        $user->assign('ball-technician');
        return 'ok';
    }
}
