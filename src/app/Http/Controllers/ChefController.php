<?php

namespace App\Http\Controllers;

use App\User;
use App\Chef;
use App\Http\Requests\Chef\CreateChefRequest;
use App\Http\Requests\Chef\EditChefRequest;
use App\Http\Requests\Chef\RestoreChefRequest;
use App\Http\Requests\Chef\DeleteChefRequest;

class ChefController extends Controller
{
    public function index(){
        return view('admin_panel_view.staff.chefs');
    }

    public function api_get_chefs(){
        return User::getUsersByRole('chef')->load('chef');
    }

    public function api_get_deleted_chefs(){
        return Chef::onlyTrashed()->get()->load('user');
    }

    public function api_restore_chef(RestoreChefRequest $request){
        return $request->persist();
    }

    public function api_save_new_chef(CreateChefRequest $request){
        return $request->persist();
    }

    public function api_save_chef_changes(EditChefRequest $request){
        return $request->persist();
    }

    public function api_delete_chef(DeleteChefRequest $request){
        return $request->persist();
    }
}
