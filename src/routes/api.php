<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

JsonApi::register('default')->routes(function ($api) {


    $api->resource('entries')->relationships(function ($relations) {
        $relations->hasOne('user');
        $relations->hasOne('type');
        $relations->hasOne('chef');
        $relations->hasOne('studio');
    });

    $api->resource('users')->relationships(function ($relations) {
        $relations->hasMany('entry');
        $relations->hasMany('operator');
    });

    $api->resource('types')->relationships(function ($relations) {
        $relations->hasMany('entry');
    });

    $api->resource('chefs')->relationships(function ($relations) {
        $relations->hasMany('entry');
    });

    $api->resource('studios')->relationships(function ($relations) {
        $relations->hasMany('entry');
    });

    $api->resource('operators')->relationships(function ($relations) {
        $relations->hasMany('user');
    });


});





Route::group(['prefix' => '/api'], function () {

// return one entry for tech support
Route::get('/api-show-one-entry/{entryId}','EntriesController@showOneEntryGetObject');









Route::get('/api_entry_types_for_filtering','EntriesController@api_entry_types_for_filtering');






// outside API calls. first one for getting tour from rnn_Hub_API, second for giving data related to asked tour
Route::get('/api_get_current_tour/{id}', 'ApiController@api_get_current_tour'); // this one gets data from https://rng-hub2.staging.rng:8001/rng
Route::get('/game/{game_id}/tour/{tour_id}/events', 'ApiController@api_get_data_about_tour'); // thi one is my API





//users admin_panel
//Route::get('/user/api_get_users', 'UserController@api_get_users'); // retrieve all users for permission setting
Route::get('/user/api_get_studios_for_abilities', 'StaffAccessStructure\AbilityController@api_get_studios_for_abilities');



//studio part
Route::group(['prefix' => '/studio'], function () {
    Route::get('/api_get_studios', 'StudioController@api_get_studios');
    Route::post('/api_save_studio_changes', 'StudioController@api_save_studio_changes');
    Route::post('/api_save_new_studio', 'StudioController@api_save_new_studio');
    Route::post('/api_delete_studio', 'StudioController@api_delete_studio');
});


//operator part
Route::group(['prefix' => '/staff/operator'], function () {
    Route::get('/api_get_studios_for_operators', 'OperatorController@api_get_studios_for_operators');
    Route::post('/api_get_operators', 'OperatorController@api_get_operators'); // Is it ok to use POST method here
    Route::post('/api_save_new_operator', 'OperatorController@api_save_new_operator');
    Route::get('/api_get_deleted_operators', 'OperatorController@api_get_deleted_operators');
    Route::post('/api_delete_operator', 'OperatorController@api_delete_operator');
    Route::post('/api_save_operator_changes', 'OperatorController@api_save_operator_changes');
    Route::post('/api_restore_operator', 'OperatorController@api_restore_operator');
});


//administrator part
Route::group(['prefix' => '/staff/administrator'], function () {
    Route::get('/api-get-users-for-administrator', 'AdminController@api_get_users_for_administrator');
    Route::post('/api-retract-administrator-role-from-user', 'AdminController@api_retract_administrator_role_from_user');
    Route::post('/api-save-new-administrator', 'AdminController@api_save_new_administrator');
//    Route::post('/api_save_new_operator', 'OperatorController@api_save_new_operator');
//    Route::get('/api_get_deleted_operators', 'OperatorController@api_get_deleted_operators');
//    Route::post('/api_delete_operator', 'OperatorController@api_delete_operator');
//    Route::post('/api_save_operator_changes', 'OperatorController@api_save_operator_changes');
//    Route::post('/api_restore_operator', 'OperatorController@api_restore_operator');
});

//ball_technician part
Route::group(['prefix' => '/staff/ball_technician'], function () {
    Route::get('/api_get_ball_technicians', 'BallTechnicianController@api_get_ball_technicians');
    Route::get('/api_get_deleted_ball_technicians', 'BallTechnicianController@api_get_deleted_ball_technicians');
    Route::post('/api_save_new_ball_technician', 'BallTechnicianController@api_save_new_ball_technician');
    Route::post('/api_delete_ball_technician', 'BallTechnicianController@api_delete_ball_technician');
    Route::post('/api_save_ball_technician_changes', 'BallTechnicianController@api_save_ball_technician_changes');
    Route::post('/api_restore_ball_technician', 'BallTechnicianController@api_restore_ball_technician');
});


//chef part
Route::group(['prefix' => '/staff/chef'], function () {
    Route::get('/api_get_chefs', 'ChefController@api_get_chefs');
    Route::get('/api_get_deleted_chefs', 'ChefController@api_get_deleted_chefs');
    Route::post('/api_save_new_chef', 'ChefController@api_save_new_chef');
    Route::post('/api_delete_chef', 'ChefController@api_delete_chef');
    Route::post('/api_save_chef_changes', 'ChefController@api_save_chef_changes');
    Route::post('/api_restore_chef', 'ChefController@api_restore_chef');
});




// access structure routes
Route::group(['prefix' => '/access-structure'], function () {

//abilities part routes
    Route::get('/api_get_abilities', 'StaffAccessStructure\AbilityController@api_get_abilities');
    Route::get('/api_get_studios_for_abilities', 'StaffAccessStructure\AbilityController@api_get_studios_for_abilities');
    Route::post('/api_delete_ability', 'StaffAccessStructure\AbilityController@api_delete_ability');

//assigned role part routes
    Route::get('/api_get_assigned_roles', 'StaffAccessStructure\AssignedRoleController@api_get_assigned_roles');
    Route::get('/api_get_roles_for_assigned_roles', 'StaffAccessStructure\AssignedRoleController@api_get_roles_for_assigned_roles');
    Route::post('/api_delete_assigned_role', 'StaffAccessStructure\AssignedRoleController@api_delete_assigned_role');
    Route::get('/api_get_users_for_assigned_roles', 'StaffAccessStructure\AssignedRoleController@api_get_users_for_assigned_roles');
    Route::post('/api_save_new_assigned_role', 'StaffAccessStructure\AssignedRoleController@api_save_new_assigned_role');

// role part routes
    Route::get('/api_get_roles', 'StaffAccessStructure\RoleController@api_get_roles');
    Route::post('/api_delete_role', 'StaffAccessStructure\RoleController@api_delete_role');

// permission part routes
    Route::get('/api_get_permissions', 'StaffAccessStructure\PermissionController@api_get_permissions');
    Route::get('/api_get_abilities_for_permissions', 'StaffAccessStructure\PermissionController@api_get_abilities_for_permissions');
    Route::get('/api_get_users_for_permissions', 'StaffAccessStructure\PermissionController@api_get_users_for_permissions');
    Route::get('/api_get_roles_for_permissions', 'StaffAccessStructure\PermissionController@api_get_roles_for_permissions');
    Route::post('/api_delete_permission', 'StaffAccessStructure\PermissionController@api_delete_permission');
    Route::post('/api_save_new_permission', 'StaffAccessStructure\PermissionController@api_save_new_permission');
});


});


















//@todo: move to controller !important
Route::get('is-app-server', function (Request $request) {
    return
        [
            'app-server' => true,
            'version' => '1.1.1'
        ];
});
Route::get('app-data', function (Request $request) {
    $transformUser = function (\App\User $user) {
        $studio = $user->getStudioAttribute();
        return [
            'id' => $user->id,
            'name' => $user->getNameRuAttribute(),
            'studio_id' => $user->getStudioIdAttribute(),
            'studio' => $studio ? $studio->name_eng : null,
        ];
    };
    $chefs = \App\User::getUsersByRole('chef')->load('chef')->map($transformUser);
    $operators = \App\User::getUsersByRole('operator')->load('operator')->map($transformUser);
    return
        [
            'chefs' => $chefs,
            'chef_studio' => \App\Studio::where('name_eng', '=', 'chef')->first(),
            'operators' => $operators,
            'studios' => \App\Studio::where('name_eng', '!=', 'chef')->get(),
        ];
});

Route::get('time-breaks/stats', function (Request $request) {
    $page = $request->get('page', 1);
    $perPage = $request->get('per_page', 5);
    $query = App\TimeBreak::orderBy('started', 'desc');

    $total = $query->count('*');
    $items = $query
        ->with('operator', 'chef')
        ->limit($perPage)
        ->skip($perPage*($page-1))
        ->get()
        ->map(function(\App\TimeBreak $timeBreak) {
            return [
                'studio' => ($s = $timeBreak->studio()->first()) ? $s->name_ru : '',
                'chef' => $timeBreak->chef->name_ru,
                'type' => $timeBreak->type,
                'operator' => ($s = $timeBreak->operator) ? $s->name_ru : '',
                'started' => $timeBreak->started->format(\Carbon\Carbon::ISO8601),
                'ended' => $timeBreak->ended ? $timeBreak->ended->format(\Carbon\Carbon::ISO8601): null,
            ];
        });
    $pages = ceil($total/$perPage);
    return [
        'items' => $items,
        'total' => $total,
        'pages' => ceil($total/$perPage),
        'nextPage' => $pages > $page ? $page+1: $page,
        'prevPage' => $page > 1 ? $page-1: null,
    ];
});
Route::get('time-breaks', function (Request $request) {
    $studios = \App\Studio::where('order', '>=', 0)->orderBy('order')->get();
    $response = [];
    foreach ($studios as $studio) {
        $response[] = [
            'id' => $studio->id,
            'name' => $studio->name_ru,
            'type' => $studio->type,
            'operators_inside' => $studio->getOperatorsInsideAttribute(),
            'chefs_inside' => $studio->getChefsInsideAttribute()
        ];
    }
    return $response;
});
Route::post('time-break/{studioId}/start', function (Request $request, $studioId) {
    $studio = \App\Studio::findOrFail($studioId);
    $timebreak = new \App\TimeBreak();
    $timebreak->type = $request->get('type', 'operator_break');
    $timebreak->studio = $studio->name_eng;
    $timebreak->started = new Carbon\Carbon();
    $timebreak->operator_id = $request->get('operator_id');
    $timebreak->chef_id = $request->get('chef_id');
    $timebreak->save();
    return $timebreak;
});
/*
Route::post('time-break/create', function (Request $request) {
    $timebreak = new \App\TimeBreak();
    $timebreak->start = Carbon\Carbon::parse($request->get('start'))->second(0);
    $timebreak->end =$timebreak->start->copy()->addMinutes(15);
    $timebreak->operator_id = $request->get('operator_id');
    $timebreak->studio = $request->get('studio');

    $timeIntersections = \App\Services\TimeBreaks\TimeBreakFactory::findIntersection($timebreak->start, $timebreak->end);
    if ($timeIntersections->count()) {
        return response()->json($timeIntersections, 500);
    }
    $timebreak->save();
    return $timebreak;
});
Route::post('time-break/{id}/update', function (Request $request, $id) {

    $timebreak = \App\TimeBreak::findOrFail($id);
    $start = Carbon\Carbon::parse($request->get('start'))->second(0);

    $end = $start->copy()->addMinutes(15);
    $timeIntersections = \App\Services\TimeBreaks\TimeBreakFactory::findIntersection($start, $end);
    if ($timeIntersections->count()) {
        \Illuminate\Support\Facades\Log::info('intersection '. $start);
        \Illuminate\Support\Facades\Log::info('had intersection '. $timeIntersections->pluck('id'));
        return response()->json($timeIntersections, 500);
    }
    $timebreak->start = $start;
    $timebreak->end = $end;
    $timebreak->operator_id = $request->get('operator_id');
    $timebreak->studio = $request->get('studio_id');
    $timebreak->save();
    return $timebreak;
});
Route::post('time-break/{id}/delete', function (Request $request, $id) {
    $timebreak = \App\TimeBreak::findOrFail($id);
    $timebreak->delete();
    return $timebreak;
});*/
Route::post('time-break/{studioId}/end', function (Request $request, $studioId) {
    $studio = \App\Studio::findOrFail($studioId);

    $timebreak = \App\TimeBreak::where([
        'studio' => $studio->name_eng,
        'ended' => null
    ])->update([
        'ended' =>  new Carbon\Carbon()
    ]);
    return $timebreak;
});
Route::post('push-token', function (Request $request) {
//    \Illuminate\Support\Facades\Log::info($request->get('token'));
    $token = $request->get('token');
    $tokenModel = \App\PushToken::firstOrNew(['token' => $token]);
    if (!$tokenModel->exists) {
        $tokenModel->save();

        /** @var \ExponentPhpSDK\Expo $expo */
        $expo = app('expo-push');
        $expo->subscribe($tokenModel->id, $token);
    }
});
