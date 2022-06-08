<?php


Auth::routes();

Route::get('/show-one-entry/{entry}','EntriesController@showOneEntryDisplayView'); // should be available for unsigned users, currently unused



//Route::get('/testing', 'ApiController@api_get_current_tour');


// Under the line routes are not checked
// -----------------------









Route::get('change-password', 'UserController@getChangePassword')->name('user-change-password-get');
Route::post('change-password', 'UserController@postChangePassword')->name('user-change-password-post');



Route::get('/develop', function(){
    return view('admin_panel_view.events.entries_vue');
});



Route::get('/ball-journal-vue', 'BallJournalController@indexVue');





Route::post('change-operator', 'UserController@postChangeOperator')->name('user.change-operator');
Route::get('/matrica', 'MatrixController@getAccessToken1');
Route::get('/cache-token', 'MatrixController@cacheTokenState')->name('cache-token');






Route::group(['middleware' => ['auth', 'change-password']], function () {

    Route::get('/', 'IndexController@index')->name('index');

    Route::group(['middleware' => 'access.ball-journal', 'prefix' => 'ball-journal', 'as' => 'ball-journal.'], function () {
        Route::get('/technician-instruction', 'BallJournalController@showTechnicianInstruction');
        Route::post('/get-one-entry-json-format', 'BallJournalController@getOneEntryJsonFormat');
        Route::post('/', 'BallJournalController@ballSetChangeStore')->name('ball-set-change-store');
        Route::post('/ball-change-store', 'BallJournalController@ballChangeStore')->name('ball-change-store');
        Route::post('/tech-message-store', 'BallJournalController@technicalMessageStore')->name('technical-message-store');
        Route::post('/ball-set-status-change-store', 'BallJournalController@ballSetStatusChangeStore')->name('ball-set-status-change-store');
        Route::post('/ball-set-shuffle-store', 'BallJournalController@ballSetShuffleStore')->name('ball-set-shuffle-store');
        Route::post('/remove-announcement-status/{id}', 'BallJournalController@removeAnnouncementStatus')->name('remove-announcement-status');
        Route::post('/event-complete-form/{id}', 'BallJournalController@completeEventForBallSetChange')->name('ball-set-change-complete');
        Route::get('/{typeId?}', 'BallJournalController@index')->name('index'); // this one should be last on a row
    });



    Route::group(['middleware' => 'access.studio', 'prefix' => 'studio/{studioName}'], function () {
        Route::get('/', 'EntriesController@filter')->name('studio.filter');
        Route::post('/store', 'EntriesController@store')->name('entry.store');
        Route::patch('/update', 'EntriesController@update')->name('entry.update');
        Route::post('/unalert-entry/{entrie}', 'EntriesController@unalertEntry')->name('entry.unalert-entry');
    });



    // admin_panel area routes
    Route::group(['middleware' => 'access.admin_panel_access', 'prefix' => 'admin-panel', 'as' => 'admin-panel.'], function () {

        Route::get('/studios', 'StudioController@index')->name('studios.index');

        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('/', 'UsersController@users')->name('admin.user.index'); // :todo this one cannot work
//            Route::post('/store', 'EntriesController@store')->name('entry.store');
//            Route::patch('/update', 'EntriesController@update')->name('entry.update');
//            Route::post('/unalert-entry/{id}', 'EntriesController@unalertEntry')->name('entry.unalert-entry');
        });




        Route::get('/entries/{studio}', 'EntriesController@showInBackend')->name('show-entries-in-backend');


        Route::group(['prefix' => 'matrix', 'as' => 'matrix.'], function () {
            Route::get('/', 'MatrixController@index')->name('index');
            Route::post('login', 'MatrixController@login')->name('login');
            Route::post('save', 'MatrixController@saveRoom')->name('save');
            Route::post('signin', 'MatrixController@store')->name('signin');
            Route::delete('delete', 'MatrixController@destroy')->name('delete');
        });


        Route::get('/email', 'EmailController@index')->name('email-index');
        Route::post('/email', 'EmailController@store');
        Route::patch('/email/{id}', 'EmailController@update');
        Route::delete('/email/{id}', 'EmailController@destroy');
        Route::post('/send-mail', 'EmailController@send');




        /*Event Description Types*/
        Route::get('/event-descriptions-types', 'DescriptionsTypeController@index')->name('event-descriptions-types.index');
        Route::post('/event-descriptions-types', 'DescriptionsTypeController@store')->name('event-descriptions-types.store');
        Route::patch('/event-descriptions-types', 'DescriptionsTypeController@update')->name('event-descriptions-types.update');
        Route::delete('/event-descriptions-types', 'DescriptionsTypeController@destroy')->name('event-descriptions-types.destroy');

        Route::get('/event-description-type-mailing-settings', 'DescriptionsTypeController@mailingSettings')->name('event-description-type-mailing-settings');
        Route::patch('/entry-description-type-mailing-settings-update', 'DescriptionsTypeController@mailingSettingsUpdate')->name('event-description-type-mailing-settings-update');
        /*Event Description Types -- END*/




        Route::resource('description', 'DescriptionController'); // all routes related to description
//make sure that this one not needed to be refactored, and just then remove red mark



        /* Information text */
        Route::get('/information/instruction', 'InformationController@instruction')->name('information.instruction');
        Route::get('/information/notification', 'InformationController@notification')->name('information.notification');
        Route::get('/information/notice', 'InformationController@notice')->name('information.notice');

        Route::patch('/information/instruction', 'InformationController@updateInstruction')->name('information.instruction');
        Route::patch('/information/notification', 'InformationController@updateNotification')->name('information.notification');
        Route::patch('/information/notice', 'InformationController@updateNotice')->name('information.notice');
        /* Information text -- END*/



        Route::resource('tech-support-msg', 'TechMsgController');
        Route::resource('chef', 'ChefController');
        Route::resource('operator', 'OperatorController');
        Route::resource('ball-technician', 'BallTechnicianController');
        Route::resource('admin', 'AdminController');
        Route::resource('user', 'UserController'); //todo: not sure that there is some standard methods


        Route::get('/access-structure/abilities', 'StaffAccessStructure\AbilityController@abilities')->name('access-structure.abilities');
        Route::get('/access-structure/assigned-roles', 'StaffAccessStructure\AssignedRoleController@assignedRoles')->name('access-structure.assigned-roles');
        Route::get('/access-structure/permissions', 'StaffAccessStructure\PermissionController@permissions')->name('access-structure.permissions');
        Route::get('/access-structure/roles', 'StaffAccessStructure\RoleController@roles')->name('access-structure.roles');



//        Route::get('/matrix', 'MatrixController@index')->name('matrix-index');

    });











//consider to place all this route to admin-panel prefix, after you refactor them
//    similar routes have they representations undex matrix prefix, deal with them, which one of them are actual

    Route::post('/user/save-operator-to-session', 'OperatorController@saveOperatorToSession');
    // Not used routes------------------------------------------------------------------------------------
    Route::get('/user/{user}', 'UserController@showUserProfile');

    Route::get('matrix/grab-messages', 'MatrixController@getStudioMessagesFromMatrixChat');
    Route::get('matrix/send-message', 'MatrixController@sendMessageToChat');

    Route::post('matrix/chat', 'MatrixController@sendMessageToChat')->name('matrix.chat.send');
    Route::get('matrix/ajax', 'MatrixController@talkToAjax');
    Route::get('matrix/get-messages', 'MatrixController@getMessages');

    Route::get('/admin_panel/matrix', 'MatrixController@index');
    //@todo: consider to remove
    Route::post('matrix/send', 'MatrixController@sendMessage')->name('matrix.send'); //journal.blade.php dependant route. Called when tech.sup. msg. send






    Route::get('/text/tech-instruction', 'InformationController@techInstruction');



});
