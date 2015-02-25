<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
    // Force https for all routes?
    $secure = Config::get('session.secure', false);
	if($secure && !Request::secure())
    {
        return Redirect::secure(Request::path());
    }
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| Sentry Authentication & Authorisation Filter
|--------------------------------------------------------------------------
|
| This filter protects administrative routes from users who are not logged
| in or who do not have adequate permissions.
|
| The filter name reflects the fact that we are using the Sentry 2 package
| for this.
|
*/

Route::filter('sentry', function()
{
    // Have to be logged in for everything.
    if (!Sentry::check())
    {
        return Redirect::guest(URL::route('login'))
            ->with('message', 'Please login to access the Vineyard Compassion CRM.');
    }

    // Check any other route against Sentry access rights.
    $route = Route::currentRouteName();
    if (!Sentry::hasAccess($route))
    {
        return Redirect::route('home')
            ->with('message', 'You are not authorized to access the requested resource.');
    }
});
