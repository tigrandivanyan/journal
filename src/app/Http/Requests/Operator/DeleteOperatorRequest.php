<?php

namespace App\Http\Requests\Operator;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Studio;
use App\Repositories\BouncerRepository;


class DeleteOperatorRequest extends FormRequest
{

    private $bouncer;

    public function __construct(BouncerRepository $bouncer){
        $this->bouncer = $bouncer;
    }

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

        $user = User::where('id', $this->user_id)->first();
        $operatorStudio = Studio::where('id', $user->operator->studio_id)->first();

        $user->operator()->delete();

//        bouncer staff
        $this->bouncer->retractRoleFromUser( 'operator', $user->id);

        $this->bouncer->disallowAbilityWithModelAndModelEntityFromUser($user->id, 'edit-studio', 'App\Studio', $operatorStudio->id);
        $this->bouncer->disallowAbilityWithModelAndModelEntityFromUser($user->id, 'view-studio', 'App\Studio', $operatorStudio->id);
        $this->bouncer->disallowUserToOwnModelWithSpecificAbility($user->id ,'App\Entrie', 'edit');

        return 'ok';

    }
}
