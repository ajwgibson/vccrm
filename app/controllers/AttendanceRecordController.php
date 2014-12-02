<?php

class AttendanceRecordController extends \BaseController {

    protected $title = 'Attendance records';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $filtered = false;
        $canExport = false;

        $filter_project   = Session::get('attendance_record_filter_project',   '');
        $filter_contact   = Session::get('attendance_record_filter_contact',   '');
        $filter_name      = Session::get('attendance_record_filter_name',      '');
        $filter_guest     = Session::get('attendance_record_filter_guest',     '');
        $filter_volunteer = Session::get('attendance_record_filter_volunteer', '');

		$user = Sentry::getUser();
		$admin = Sentry::findGroupByName('Attendance Administration');

	    if ($user->isSuperUser() || $user->inGroup($admin)) {
	        $records = AttendanceRecord::orderBy('attendance_date', 'desc');
	        $canExport = true;
	    } else {
			$records = $user->attendance_records()->orderBy('attendance_date', 'desc');
	    }

	    if (!(empty($filter_project))) {
            $records = $records->where('project_id', $filter_project);
            $filtered = true;
        }

        if (!(empty($filter_contact))) {
            $records = $records->where('contact_id', $filter_contact);
            $filtered = true;
        }

        if (!(empty($filter_name))) {
        	$records = $records->join('contacts', 'attendance_records.contact_id', '=', 'contacts.id');
            $records = $records
                ->where(function($query) use($filter_name) {
                    $query->where('contacts.first_name', 'LIKE', "%$filter_name%")
                          ->orWhere('contacts.last_name', 'LIKE', "%$filter_name%");
                });	
            $filtered = true;
        }

        if (!(empty($filter_guest))) {
            $records = $records->where('volunteer', false);
            $filtered = true;
        }

        if (!(empty($filter_volunteer))) {
            $records = $records->where('volunteer', true);
            $filtered = true;
        }

        $records = $records->paginate(50);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'show attendance records');

        $projects = Project::orderby('name')->lists('name', 'id');
		$contacts = Contact::orderby('first_name')->orderby('last_name')->get();
		$contacts = $contacts->lists('Name', 'id');

        $this->layout->content =
            View::make('attendance_records.index')
                    ->with('records', $records)
                    ->with('projects', $projects)
                    ->with('contacts', $contacts)
                    ->with('filter_project', $filter_project)
                    ->with('filter_contact', $filter_contact)
                    ->with('filter_name', $filter_name)
                    ->with('filter_guest', $filter_guest)
                    ->with('filter_volunteer', $filter_volunteer)
                    ->with('filtered', $filtered)
                    ->with('canExport', $canExport);
	}

	/**
     * Changes the list filter values in the session
     * and redirects back to the index to force the filtered
     * list to be displayed.
     */
    public function filter()
    {
        $filter_project   = Input::get('filter_project');
        $filter_contact   = Input::get('filter_contact');
        $filter_name      = Input::get('filter_name');
        $filter_guest     = Input::get('filter_guest');
        $filter_volunteer = Input::get('filter_volunteer');
        
        Session::put('attendance_record_filter_project',    $filter_project);
        Session::put('attendance_record_filter_contact',    $filter_contact);
        Session::put('attendance_record_filter_name',       $filter_name);
        Session::put('attendance_record_filter_guest',      $filter_guest);
        Session::put('attendance_record_filter_volunteer',  $filter_volunteer);

        return Redirect::route('attendance_record.index');
    }

	/**
     * Removes the list filter values from the session
     * and redirects back to the index to force the 
     * list to be displayed.
     */
    public function resetFilter()
    {
        if (Session::has('attendance_record_filter_project'))   Session::forget('attendance_record_filter_project');
        if (Session::has('attendance_record_filter_contact'))   Session::forget('attendance_record_filter_contact');
        if (Session::has('attendance_record_filter_name'))      Session::forget('attendance_record_filter_name');
        if (Session::has('attendance_record_filter_guest'))     Session::forget('attendance_record_filter_guest');
        if (Session::has('attendance_record_filter_volunteer')) Session::forget('attendance_record_filter_volunteer');

        return Redirect::route('attendance_record.index');
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$record = new AttendanceRecord();

		$projects = Project::orderby('name')->lists('name', 'id');
		$contacts = Contact::orderby('first_name')->orderby('last_name')->get();
		$contacts = $contacts->lists('Name', 'id');

		$this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'add a new attendance record');

        $this->layout->content =
            View::make('attendance_records.create')
                    ->with('record', $record)
                    ->with('projects', $projects)
                    ->with('contacts', $contacts);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    	$user = Sentry::getUser();

    	$contact_ids = Input::get('contact_id');
    	if (!($contact_ids)) $contact_ids = array ( '' );

    	$role_name = null;
    	$volunteer = false;

    	if (Input::has('role_id')) {
    		$role = ProjectRole::find(Input::get('role_id'));
    		if ($role) {
    			$role_name = $role->name;
    			$volunteer = $role->volunteer;
    		}
    	}

    	foreach ($contact_ids as $contact_id) {
        	
        	$data = array(
	            	'project_id'      => Input::get('project_id'),
	            	'contact_id'      => $contact_id,
	            	'attendance_date' => Input::get('attendance_date'),
	            	'hours'           => Input::get('hours'),
	            	'user_id'         => $user->id,
	            	'role'            => $role_name,
	            	'volunteer'       => $volunteer
            	);

        	$validator = 
	            Validator::make(
	                $data, 
	                $this->inject_id(AttendanceRecord::$rules, ''),
	                AttendanceRecord::$messages);

        	if (!($validator->passes())) {

        		return Redirect::route('attendance_record.create')
		            ->withInput()
		            ->withErrors($validator);

        	}

            AttendanceRecord::create($data);
        }

        return Redirect::route('attendance_record.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = Sentry::getUser();
		$admin = Sentry::findGroupByName('Attendance Administration');

	    if ($user->isSuperUser() || $user->inGroup($admin)) {
			$record = AttendanceRecord::findOrFail($id);
		} else {
			$record = $user->attendance_records()->where('id', $id)->firstOrFail();
		}

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'attendance record details');

        $this->layout->content =
            View::make('attendance_records.show')
                    ->with('record', $record);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = Sentry::getUser();
		$admin = Sentry::findGroupByName('Attendance Administration');

	    if ($user->isSuperUser() || $user->inGroup($admin)) {
			$record = AttendanceRecord::findOrFail($id);
		} else {
			$record = $user->attendance_records()->where('id', $id)->firstOrFail();
		}

		$projects = Project::orderby('name')->lists('name', 'id');
		$contacts = Contact::orderby('first_name')->orderby('last_name')->get();
		$contacts = $contacts->lists('Name', 'id');

		$role_id = -1;
		$role = $record->project->roles()->where('name', $record->role)->first();
		if ($role) {
			$role_id = $role->id;
		}

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'edit attendance record details');

        $this->layout->content =
            View::make('attendance_records.edit')
                    ->with('record', $record)
                    ->with('projects', $projects)
                    ->with('contacts', $contacts)
                    ->with('role_id', $role_id);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();

		$role_name = null;
    	$volunteer = false;

    	if (Input::has('role_id')) {
    		$role = ProjectRole::find(Input::get('role_id'));
    		if ($role) {
    			$role_name = $role->name;
    			$volunteer = $role->volunteer;
    		}
    	}

    	$data = array(
        	'project_id'      => Input::get('project_id'),
        	'contact_id'      => Input::get('contact_id'),
        	'attendance_date' => Input::get('attendance_date'),
        	'hours'           => Input::get('hours'),
        	'role'            => $role_name,
        	'volunteer'       => $volunteer
    	);

        $validator = 
            Validator::make(
                $data, 
                $this->inject_id(AttendanceRecord::$rules, $id),
                AttendanceRecord::$messages);

        if ($validator->passes())
        {
        	$user = Sentry::getUser();
			$admin = Sentry::findGroupByName('Attendance Administration');

		    if ($user->isSuperUser() || $user->inGroup($admin)) {
				$record = AttendanceRecord::findOrFail($id);
			} else {
				$record = $user->attendance_records()->where('id', $id)->firstOrFail();
			}

            $record->update($data);
            return Redirect::route('attendance_record.show', $id);
        }

        return Redirect::route('attendance_record.edit', $id)
            ->withInput()
            ->withErrors($validator);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$user = Sentry::getUser();
		$admin = Sentry::findGroupByName('Attendance Administration');

	    if ($user->isSuperUser() || $user->inGroup($admin)) {
			$record = AttendanceRecord::findOrFail($id);
		} else {
			$record = $user->attendance_records()->where('id', $id)->firstOrFail();
		}

		$record->delete();

        return Redirect::route('attendance_record.index');
	}


	/**
     * Exports the attendance records as CSV.
     */
    public function export()
    {
    	$user = Sentry::getUser();
		$admin = Sentry::findGroupByName('Attendance Administration');
	    
	    if ($user->isSuperUser() || $user->inGroup($admin)) {

	        $records = AttendanceRecord::orderBy('attendance_date', 'desc')->get();

	        $view = View::make('attendance_records.export')->with('records', $records);

            return Response::make($view)
                    ->header('Content-Type', 'text/csv')
                    ->header('Content-Disposition', "attachment; filename='attendance_records.csv'");
	    }

        return Redirect::route('attendance_record.index');
    }

    
}
