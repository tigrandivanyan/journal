<?php

namespace App\Http\Controllers;

use App\Studio;
use App\Http\Requests\Studio\CreateStudioRequest;
use App\Http\Requests\Studio\EditStudioRequest;
use App\Http\Requests\Studio\DeleteStudioRequest;

class StudioController extends Controller
{


    public function index(){
        return view('admin_panel_view.studio.master');
    }

    public function api_get_studios(){
        return Studio::all();
    }

    public function api_save_new_studio(CreateStudioRequest $request){
        return $request->persist();
    }

    public function api_save_studio_changes(EditStudioRequest $request){
        return $request->persist();
    }

    public function api_delete_studio(DeleteStudioRequest $request){
        return $request->persist();
    }

}
