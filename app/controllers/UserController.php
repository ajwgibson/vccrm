<?php

class UserController extends \BaseController {

    protected $title = 'Users';

    private $main_rules = array(
        'email' => 'email|required|unique:users,email,:id',
        'first_name' => 'required|max:100',
        'last_name' => 'required|max:100',
    );

    private $password_rule = array(
        'password' => 'required|confirmed|min:6'
    );

    /**
     * Display a listing of users.
     *
     * @return Response
     */
    public function index()
    {
        $users = Sentry::getUserProvider()->createModel()->orderBy('email', 'ASC')->get();

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'show all users');

        $this->layout->content =
            View::make('users.index')
                    ->with('users', $users);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create()
    {
        $user = Sentry::getEmptyUser();
        
        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'add a new user');

        $user_administration       = Sentry::findGroupByName('User Administration');
        $project_administration    = Sentry::findGroupByName('Project Administration');
        $contact_administration    = Sentry::findGroupByName('Contact Administration');
        $attendance_administration = Sentry::findGroupByName('Attendance Administration');

        $this->layout->content = 
            View::make('users.create')
                    ->with('user', $user)
                    ->with('user_administration', $user_administration)
                    ->with('project_administration', $project_administration)
                    ->with('contact_administration', $contact_administration)
                    ->with('attendance_administration', $attendance_administration);
    }

    /**
     * Store a newly created user.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();

        $rules = array_merge($this->main_rules, $this->password_rule);

        $validator = Validator::make(
            $input, 
            $this->inject_id($rules, ''));

        if (!$validator->passes()) {
            return Redirect::route('user.create')
                ->withInput()
                ->withErrors($validator);
        }

        $user = Sentry::createUser(array(
            'email'      => Input::get('email'),
            'password'   => Input::get('password'),
            'first_name' => Input::get('first_name'),
            'last_name'  => Input::get('last_name'),
            'activated'  => true,
            'permissions' => array (
                'superuser' => Input::get('superuser'),
            )
        ));

        $all_users = Sentry::findGroupByName('All Users');
        $user->addGroup($all_users);

        $user_administration       = Sentry::findGroupByName('User Administration');
        $project_administration    = Sentry::findGroupByName('Project Administration');
        $contact_administration    = Sentry::findGroupByName('Contact Administration');
        $attendance_administration = Sentry::findGroupByName('Attendance Administration');

        $this->updateGroupMembership($user, $user_administration, Input::get('user_administration'));
        $this->updateGroupMembership($user, $project_administration, Input::get('project_administration'));
        $this->updateGroupMembership($user, $contact_administration, Input::get('contact_administration'));
        $this->updateGroupMembership($user, $attendance_administration, Input::get('attendance_administration'));

        $user->save();

        return Redirect::route('user.show', $user->id);
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = Sentry::findUserById($id);

        $user_administration       = Sentry::findGroupByName('User Administration');
        $project_administration    = Sentry::findGroupByName('Project Administration');
        $contact_administration    = Sentry::findGroupByName('Contact Administration');
        $attendance_administration = Sentry::findGroupByName('Attendance Administration');

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', $user->email);

        $this->layout->content =
            View::make('users.show')
                    ->with('user', $user)
                    ->with('user_administration', $user_administration)
                    ->with('project_administration', $project_administration)
                    ->with('contact_administration', $contact_administration)
                    ->with('attendance_administration', $attendance_administration);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = Sentry::findUserById($id);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'change details for "' . $user->email . '"');

        $user_administration       = Sentry::findGroupByName('User Administration');
        $project_administration    = Sentry::findGroupByName('Project Administration');
        $contact_administration    = Sentry::findGroupByName('Contact Administration');
        $attendance_administration = Sentry::findGroupByName('Attendance Administration');

        $this->layout->content =
            View::make('users.edit')
                    ->with('user', $user)
                    ->with('user_administration',    $user_administration)
                    ->with('project_administration', $project_administration)
                    ->with('contact_administration', $contact_administration)
                    ->with('attendance_administration', $attendance_administration);
    }

    /**
     * Update the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::all();

        $validator = Validator::make(
            $input, 
            $this->inject_id($this->main_rules, $id));

        if (!$validator->passes())
        {
            return Redirect::route('user.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }

        $user = Sentry::findUserById($id);
        $user->email = Input::get('email');
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->permissions = array ( 'superuser' => Input::get('superuser') );

        $user_administration       = Sentry::findGroupByName('User Administration');
        $project_administration    = Sentry::findGroupByName('Project Administration');
        $contact_administration    = Sentry::findGroupByName('Contact Administration');
        $attendance_administration = Sentry::findGroupByName('Attendance Administration');

        $this->updateGroupMembership($user, $user_administration, Input::get('user_administration'));
        $this->updateGroupMembership($user, $project_administration, Input::get('project_administration'));
        $this->updateGroupMembership($user, $contact_administration, Input::get('contact_administration'));
        $this->updateGroupMembership($user, $attendance_administration, Input::get('attendance_administration'));

        $user->save();

        return Redirect::route('user.show', $id);
    }

    /**
     * Update a user's group membership.
     */
    private function updateGroupMembership($user, $group, $in_group)
    {
        if ($in_group) {
            if (!$user->inGroup($group)) $user->addGroup($group);
        } else {
            if ($user->inGroup($group)) $user->removeGroup($group);
        }
    }

    /**
     * Show the form for changing the specified user's password.
     *
     * @param  int  $id
     * @return Response
     */
    public function editPassword($id)
    {
        $user = Sentry::findUserById($id);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'change password for "' . $user->email . '"');

        $this->layout->content = 
            View::make('users.password')
                    ->with('user', $user);
    }

    /**
     * Change the specified user's password.
     *
     * @param  int  $id
     * @return Response
     */
    public function updatePassword($id)
    {
        $input = Input::all();

        $validator = Validator::make($input, $this->password_rule);

        if (!$validator->passes())
        {
            return Redirect::route('user.editPassword', $id)
                ->withErrors($validator);
        }

        $user = Sentry::findUserById($id);
        $user->password = Input::get('password');
        $user->save();

        return Redirect::route('user.show', $id);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = Sentry::findUserById($id);
        $user->delete();

        return Redirect::route('user.index');
    }
}