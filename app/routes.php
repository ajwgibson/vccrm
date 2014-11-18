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

    // User management pages
    Route::resource('user', 'UserController');
    Route::get('user/{user}/editPassword',    array('as' => 'user.editPassword',   'uses' => 'UserController@editPassword'));
    Route::post('user/{user}/updatePassword', array('as' => 'user.updatePassword', 'uses' => 'UserController@updatePassword'));

    // Project management pages
    Route::resource('project', 'ProjectController');
});


// Unprotected Routes
Route::get('login',  array('as' => 'login',       'uses' => 'AccountController@getLogin'));
Route::post('login', array('as' => 'login.post',  'uses' => 'AccountController@postLogin'));
