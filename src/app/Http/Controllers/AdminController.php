<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Repositories\BouncerRepository;
use App\Http\Requests\Administrator\CreateAdministratorRequest;


class AdminController extends Controller
{

    protected $bouncer;

    public function __construct(BouncerRepository $bouncer){
        $this->bouncer = $bouncer;
    }

     public function index(){
         return view('admin_panel_view.staff.admins');
     }

    public function api_get_users_for_administrator(){
        return $allAdmins = User::getUsersByRole('admin')->sortBy('id');
    }

    public function api_retract_administrator_role_from_user(Request $request){
        $this->bouncer->retractRoleFromUser('admin', $request->user_id);
        $this->bouncer->disallowAbilityFromUser($request->user_id, 'view-all-studios');
        $this->bouncer->disallowAbilityFromUser($request->user_id, 'access-admin-panel');
        return 'ok';
    }

    public function api_save_new_administrator(CreateAdministratorRequest $request){
        return $request->persist();
    }


//
//    public function api_get_operators(Request $request){
//        return User::whereHas('operator', function($q) use ($request){
//            $q->where('studio_id','=', $request->studio_id);
//        })->get();
//    }
//
//    public function api_get_deleted_operators(){
//        return Operator::onlyTrashed()->get()->load('user', 'studio');
//    }
//

//
//    public function api_delete_operator(DeleteOperatorRequest $request){
//        return $request->persist();
//    }
//
//    public function api_save_operator_changes(EditOperatorRequest $request){
//        return $request->persist();
//    }
//
//    public function api_restore_operator(RestoreOperatorRequest $request){
//        return $request->persist();
//    }

}
