<?php

namespace App\Http\Controllers;

use App\User;
use App\BallTechnician;
use App\Http\Requests\BallTechnician\CreateBallTechnicianRequest;
use App\Http\Requests\BallTechnician\EditBallTechnicianRequest;
use App\Http\Requests\BallTechnician\RestoreBallTechnicianRequest;
use App\Http\Requests\BallTechnician\DeleteBallTechnicianRequest;


class BallTechnicianController extends Controller
{

    public function index(){
        return view('admin_panel_view.staff.ball_technicians');
    }

    public function api_get_ball_technicians(){
        $ballTechnicians = User::getUsersByRole('ball-technician')->load('ballTechnician');
        $ballTechniciansAdmins = User::getUsersByRole('ball-technician-admin')->load('ballTechnician');
        return $ballTechnicians->merge($ballTechniciansAdmins);
    }

    public function api_get_deleted_ball_technicians(){
        return BallTechnician::onlyTrashed()->get()->load('user');
    }

    public function api_save_new_ball_technician(CreateBallTechnicianRequest $request){
        return $request->persist();
    }

    public function api_save_ball_technician_changes(EditBallTechnicianRequest $request){
        return $request->persist();
    }

    public function api_restore_ball_technician(RestoreBallTechnicianRequest $request){
        return $request->persist();
    }

    public function api_delete_ball_technician(DeleteBallTechnicianRequest $request){
        return $request->persist();
    }

}
