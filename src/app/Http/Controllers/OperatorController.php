<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Studio;
use App\User;
use App\Operator;
use App\Http\Requests\Operator\CreateOperatorRequest;
use App\Http\Requests\Operator\EditOperatorRequest;
use App\Http\Requests\Operator\RestoreOperatorRequest;
use App\Http\Requests\Operator\DeleteOperatorRequest;



class OperatorController extends Controller
{

    public function index(){
        return view('admin_panel_view.staff.operators');
    }

    public function api_get_studios_for_operators(){
        return Studio::all()->sortBy('id');
    }

    public function api_get_operators(Request $request){
        return User::whereHas('operator', function($q) use ($request){
            $q->where('studio_id','=', $request->studio_id);
        })->get();
    }

    public function api_get_deleted_operators(){
        return Operator::onlyTrashed()->get()->load('user', 'studio');
    }

    public function api_save_new_operator(CreateOperatorRequest $request){
        return $request->persist();
    }

    public function api_delete_operator(DeleteOperatorRequest $request){
        return $request->persist();
    }

    public function api_save_operator_changes(EditOperatorRequest $request){
        return $request->persist();
    }

    public function api_restore_operator(RestoreOperatorRequest $request){
        return $request->persist();
    }

}
