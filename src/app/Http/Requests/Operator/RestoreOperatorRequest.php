<?php

namespace App\Http\Requests\Operator;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Studio;
use App\Entrie;

class RestoreOperatorRequest extends FormRequest
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

        $user->operator()->withTrashed()->restore();

        $operatorStudio = Studio::findOrFail($this->operator_studio_id);

        $user->assign('operator');

        $user->allow('edit-studio', $operatorStudio);
        $user->allow('view-studio', $operatorStudio);

        \Bouncer::allow($user)->toOwn(Entrie::class)->to('edit');

        return 'ok';
    }
}
