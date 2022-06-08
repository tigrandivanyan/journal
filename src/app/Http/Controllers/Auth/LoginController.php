<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Studio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Matrix\MatrixTokenResource;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }


    public function showLoginForm() // runs when user is not authorized
    {
        return view('general_view.auth.login');
    }


    public function sendFailedLoginResponse(){
        return back()->withErrors(['Логин или пароль указаны неверно!']);
    }


    public function redirectTo(){

        $matrixTokenObject = new MatrixTokenResource; //todo: this one probably should not be here
        $matrixTokenObject->getLoginToken();  //todo: this one probably should not be here

        $user = auth()->user();
        $user->logged_in_at = new Carbon();
        $user->save();

        if ($user->isAn('ball-technician') || $user->isAn('ball-technician-admin')) {
            return redirect(route('ball-journal.index'));
        }elseif ($user->isAn('operator')) {
            $operatorStudio = $user->operator->studio_id;
            $studio = Studio::find($operatorStudio);
            return redirect(route('studio.filter', $studio->name_eng));
        }else{
            return redirect(route('index'));
        }
    }
}
