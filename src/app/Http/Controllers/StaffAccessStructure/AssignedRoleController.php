<?php

namespace App\Http\Controllers\StaffAccessStructure;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AssignedRole;
use App\User;
use App\Role;
use Bouncer;
use App\Repositories\BouncerRepository;

class AssignedRoleController extends Controller
{

    protected $bouncer;

    public function __construct(BouncerRepository $bouncer){
        $this->bouncer = $bouncer;
    }

    public function assignedRoles(){
        return view('admin_panel_view.access_structure.assigned_roles');
    }

    public function api_get_assigned_roles(){
        $assignedRoles = AssignedRole::orderBy('role_id', 'asc')->get()->load('user', 'role');
        return $assignedRoles;
    }

    public function api_get_users_for_assigned_roles(){
        $allUsers = User::all();
        return $allUsers;
    }

    public function api_get_roles_for_assigned_roles(){
        $roles = Role::all();
        return $roles;
    }

    public function api_delete_assigned_role(Request $request){
        AssignedRole::where('entity_id', $request->user_id)->where('role_id', $request->role_id)->delete();
        return 'true';
    }

    public function api_save_new_assigned_role(Request $request){

        $this->validate($request, [
            'role_name' => 'required|string',
            'user_id' => 'required|integer',
        ]);

        if($request->remove && $request->role_name && $request->user_id){
            $this->bouncer->retractRoleFromUser($request->role_name, $request->user_id);
        }elseif(!$request->remove && $request->role_name && $request->user_id){
            $this->bouncer->assignRoleToUser($request->role_name, $request->user_id);
        }

        return 'true';
    }

}
