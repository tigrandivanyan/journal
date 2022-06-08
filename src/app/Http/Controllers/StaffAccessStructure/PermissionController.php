<?php

namespace App\Http\Controllers\StaffAccessStructure;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Ability;
use App\User;
use App\Role;
use Bouncer;
use App\Repositories\BouncerRepository;

class PermissionController extends Controller
{

    private $bouncer;

    public function __construct(BouncerRepository $bouncer){
        $this->bouncer = $bouncer;
    }

    public function permissions(){
        return view('admin_panel_view.access_structure.permissions');
    }

    public function api_get_permissions(){
        $permissions = Permission::all()->load('user', 'ability');
        return $permissions;
    }

    public function api_get_abilities_for_permissions(){
        $abilities = Ability::all()->load('studio');
        return $abilities;
    }

    public function api_get_users_for_permissions(){
        $users = User::all();
        return $users;
    }
    public function api_get_roles_for_permissions(){
        $roles = Role::all();
        return $roles;
    }

    public function api_delete_permission(Request $request){
        Permission::where('entity_id', $request->entity_id)->where('ability_id', $request->ability_id)->delete();
        return 'true';
    }

    public function api_save_new_permission(Request $request){
//        return 33;
//        $this->validate($request, [
//            'role_name' => 'string',
//            'user_id' => 'integer',
//            'ability_name' => 'required||string',
//            'entity_type' => 'string',
//            'entity_id' => 'integer',
//            'radioRoleUserInput' => 'required',
//            'existing_ability' => 'required',
//        ]);



        if($request->own && $request->entity_type && $request->user_id) {
            $this->bouncer->allowUserToOwnModel($request->entity_type, $request->user_id);
        }

        if($request->remove){

            if($request->radioRoleUserInput == 'permissionForRole' && $request->role_name){

                if($request->entity_type && $request->entity_id){
                    $this->bouncer->removeAbilityWithModelAndModelEntityFromRole($request->role_name, $request->ability_name, $request->entity_type, $request->entity_id);
                }elseif($request->entity_type && $request->entity_id == null){
                    $this->bouncer->removeAbilityWithModelFromRole($request->role_name, $request->ability_name, $request->entity_type);
                }elseif($request->entity_type == null && $request->entity_id == null){
                    $this->bouncer->removeAbilityFromRole($request->role_name, $request->ability_name);
                }

            }elseif($request->radioRoleUserInput == 'permissionForUser' && $request->user_id){

                if($request->entity_type && $request->entity_id){
                    $this->bouncer->disallowAbilityWithModelAndModelEntityFromUser($request->user_id, $request->ability_name, $request->entity_type, $request->entity_id);
                }elseif($request->entity_type && $request->entity_id == null){
                    $this->bouncer->disallowAbilityWithModelFromUser($request->user_id, $request->ability_name, $request->entity_type);
                }elseif($request->entity_type == null && $request->entity_id == null){
                    $this->bouncer->disallowAbilityFromUser($request->user_id, $request->ability_name);
                }
            }
        }else{

            if($request->radioRoleUserInput == 'permissionForRole' && $request->role_name){

                if($request->entity_type && $request->entity_id){
                    $this->bouncer->addAbilityWithModelAndModelEntityToRole($request->role_name, $request->ability_name, $request->entity_type, $request->entity_id);
                }elseif($request->entity_type && $request->entity_id == null){
                    $this->bouncer->addAbilityWithModelToRole($request->role_name, $request->ability_name, $request->entity_type);
                }elseif($request->entity_type == null && $request->entity_id == null){
                    $this->bouncer->addAbilityToRole($request->role_name, $request->ability_name);
                }

            }elseif($request->radioRoleUserInput == 'permissionForUser' && $request->user_id){
                if($request->entity_type && $request->entity_id){
                    $this->bouncer->addAbilityWithModelAndModelEntityToUser($request->user_id, $request->ability_name, $request->entity_type, $request->entity_id);
                }elseif($request->entity_type && $request->entity_id == null){
                   return $this->bouncer->addAbilityWithModelToUser($request->user_id, $request->ability_name, $request->entity_type);
                }elseif($request->entity_type == null && $request->entity_id == null){
                    $this->bouncer->addAbilityToUser($request->user_id, $request->ability_name);
                }

            }
        }

        return 'true';
    }
}
