<?php

class AccountController extends \BaseController {

    protected $title = 'Account administration';

    /**
     * Return the login page.
     *
     * @return Response
     */
    public function getLogin()
    {
        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'login');

        if (Sentry::check()) return Redirect::to('home');

        $this->layout->content = View::make('account.login');
    }

    /**
     * Perform the login.
     *
     * @return Response
     */
    public function postLogin()
    {
        $rules = array(
            'email'    => 'required',
            'password' => 'required',
        );

        $input = Input::get();
        
        $validator = Validator::make($input, $rules);

        if ($validator->fails())
        {
            return Redirect::route('login')
                ->withInput()
                ->withErrors($validator);
        }

        $credentials = array(
            'email'=> Input::get('email'), 
            'password'=> Input::get('password'));

        try
        {
            Sentry::authenticate($credentials, false);
        }
        catch (Exception $e)
        {
            return Redirect::route('login')
                ->withMessage("The details you provided are not valid. Try again.");
        }

        return Redirect::intended(URL::route('home'));
    }

    /**
     * Log the current user out.
     *
     * @return Response
     */
    public function getLogout()
    {
        Sentry::logout();
        Session::flush();

        return Redirect::route('login');
    }

    /**
     * Return the change account details form for the logged in user.
     *
     * @return Response
     */
    public function edit()
    {
        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'change my details');

        $user = Sentry::getUser();

        $this->layout->content =
            View::make('account.edit')
                ->with('account', $user);
    }

    /**
     * Update the account details for the logged in user.
     *
     * @return Response
     */
    public function update()
    {
        $user = Sentry::getUser();
     
        $input = Input::all();

        $rules = array(
            'email' => 'email|required|unique:users,email,:id',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
        );

        $rules = $this->inject_id($rules, $user->id);

        $validator = Validator::make($input, $rules);

        if (!$validator->passes())
        {
            return Redirect::route('account.edit')
                ->withInput()
                ->withErrors($validator);
        }

        $user->email = Input::get('email');
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->save();

        return Redirect::route('home');
    }

    /**
     * Show the form for changing the current user's password.
     *
     * @param  int  $id
     * @return Response
     */
    public function editPassword()
    {
        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'change my password');

        $this->layout->content = 
            View::make('account.password');
    }

    /**
     * Change the current user's password.
     *
     * @param  int  $id
     * @return Response
     */
    public function updatePassword()
    {
        $user = Sentry::getUser();

        $input = Input::all();

        $rules = array( 
            'current_password' => 'required', 
            'new_password' => 'required|confirmed|min:6', 
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes())
        {
            return Redirect::route('account.editPassword')
                ->withErrors($validator);
        }

        if(!$user->checkPassword(Input::get('current_password')))
        {
            return Redirect::route('account.editPassword')
                ->withMessage('The password you provided was not valid. Try again.');
        }

        $user = Sentry::getUser();
        $user->password = Input::get('new_password');
        $user->save();

        return Redirect::route('home')
            ->withInfo('Your password was changed successfully.');
    }
}