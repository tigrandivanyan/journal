<?php

namespace App\Http\Controllers\StaffAccessStructure;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ability;
use App\Studio;

class AbilityController extends Controller
{
    public function abilities(){
        return view('admin_panel_view.access_structure.abilities');
    }

    public function api_get_abilities(){
        $abilities = Ability::all()->load('studio');
        return $abilities;
    }

    public function api_get_studios_for_abilities(){
        $studios = Studio::all();
        return $studios;
    }

    public function api_delete_ability(Request $request){
        Ability::find($request->id)->delete();
        return 'true';
    }

}
