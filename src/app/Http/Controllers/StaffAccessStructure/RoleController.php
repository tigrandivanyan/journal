<?php

namespace App\Http\Controllers\StaffAccessStructure;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;

class RoleController extends Controller
{

    public function roles(){
        return view('admin_panel_view.access_structure.roles');
    }

    public function api_get_roles(){
        $roles = Role::all();
        return $roles;
    }

    public function api_delete_role(Request $request){
        Role::findOrFail($request->id)->delete();
        return 'true';
    }

}
