<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\User;
use App\Entrie;

use App\Http\Controllers\Auth\LoginController;
use App\Jobs\User\ClearTemporaryAccess;


class UserController extends Controller
{

    public function index() // admin_panel area - all users view
    {
        $users = User::all()->sortBy('id');
        return view('admin_panel_view.staff.users', compact('users'));
    }


    public function destroy(User $user) // delete user with soft delete
    {
        return $user->delete() ?  back() : back()->withErrors('Error occurred. User was not deleted.');
    }



    public function getChangePassword()
    {
        return view('general_view.auth.password.change_password');
    }


    public function postChangePassword(Request $request)
    {
        request()->validate([
            'password' => 'required|min:6|max:25|confirmed',
        ]);

        $user = auth()->user();
        $user->password = bcrypt($request->get('password'));
        $user->change_password = 0;
        $user->save();

        $loginController = app(LoginController::class);

        return $loginController->redirectTo();
    }

// todo: consider to refactor this method
    public function postChangeOperator(Request $request)
    {
        $user = auth()->user();
        // the operator who will now be changed
        $operator = User::find($request->get('change_operator_id'));
        $studio = $operator->getStudioAttribute();

        if ($studio) {
            //Clearing previous accesses
            $user->abilities()->where('name', 'access-studio-temporary')->delete();
            $user->allow('access-studio-temporary', $studio);
            // Creating announcement about change
            $this->createEntryAboutOperatorChange($operator, $user, $studio);
            //Clears access after 6 hours
            $job = (new ClearTemporaryAccess($user))
                ->delay(Carbon::now()->addHours(6));

            $this->dispatch($job);

            return redirect(
                route('studio.filter', [$studio->name_eng])
            );
        }
        return back()->withErrors(['Failed to find studio']);
    }

    /**
     * @param $operator
     * @param $user
     * @param $studio
     */
    public function createEntryAboutOperatorChange($operator, $user, $studio): void
    {
        $userWhyReplaceOperator = $user->operator ? $user->operator->name_ru : $user->username;

        Entrie::create([
            'occurred_at' => Carbon::now(),
            'user_id' => $operator->id,
            'description' => "Оператор {$userWhyReplaceOperator} заменяет {$operator->name_ru} на студии {$studio->name_ru}",
            'description_type_id' => 11, // todo: this one should not to be hardcoded
            'studio_id' => $studio->id,
            'announcement' => false
        ]);
    }
}
