<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

// Protected Routes
Route::group(array('before' => 'sentry'), function()
{
	Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

	// Account management pages
    Route::get('logout',                    array('as' => 'logout',                   'uses' => 'AccountController@getLogout'));
    Route::get('account/edit',              array('as' => 'account.edit',             'uses' => 'AccountController@edit'));
    Route::post('account/update',           array('as' => 'account.update',           'uses' => 'AccountController@update'));
    Route::get('account/editPassword',      array('as' => 'account.editPassword',     'uses' => 'AccountController@editPassword'));
    Route::post('account/updatePassword',   array('as' => 'account.updatePassword',   'uses' => 'AccountController@updatePassword'));

    // User administration pages
    Route::resource('user', 'UserController');
    Route::get('user/{user}/editPassword',    array('as' => 'user.editPassword',   'uses' => 'UserController@editPassword'));
    Route::post('user/{user}/updatePassword', array('as' => 'user.updatePassword', 'uses' => 'UserController@updatePassword'));

    // Project administration pages
    Route::resource('project', 'ProjectController');

    Route::get('project_role/{project}/create', array('as' => 'project_role.create',  'uses' => 'ProjectRoleController@create'));
    Route::post('project_role/store',           array('as' => 'project_role.store',   'uses' => 'ProjectRoleController@store'));
    Route::get('project_role/{id}',             array('as' => 'project_role.show',    'uses' => 'ProjectRoleController@show'));
    Route::get('project_role/{id}/edit',        array('as' => 'project_role.edit',    'uses' => 'ProjectRoleController@edit'));
    Route::post('project_role/{id}/update',     array('as' => 'project_role.update',  'uses' => 'ProjectRoleController@update'));
    Route::delete('project_role/{id}/destroy',  array('as' => 'project_role.destroy', 'uses' => 'ProjectRoleController@destroy'));

    // Contact administration
    Route::resource('contact', 'ContactController');

    // Volunteer Details
    Route::get('volunteer_details/{id}/create',     array('as' => 'volunteer_details.create',  'uses' => 'VolunteerDetailsController@create'));
    Route::post('volunteer_details/{id}/store',     array('as' => 'volunteer_details.store',   'uses' => 'VolunteerDetailsController@store'));
    Route::get('volunteer_details/{id}/edit',       array('as' => 'volunteer_details.edit',    'uses' => 'VolunteerDetailsController@edit'));
    Route::post('volunteer_details/{id}/update',    array('as' => 'volunteer_details.update',  'uses' => 'VolunteerDetailsController@update'));
    Route::delete('volunteer_details/{id}/destroy', array('as' => 'volunteer_details.destroy', 'uses' => 'VolunteerDetailsController@destroy'));
});


// Unprotected Routes
Route::get('login',  array('as' => 'login',       'uses' => 'AccountController@getLogin'));
Route::post('login', array('as' => 'login.post',  'uses' => 'AccountController@postLogin'));
