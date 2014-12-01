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

        $filter_project = Session::get('attendance_record_filter_project',   '');
        $filter_contact = Session::get('attendance_record_filter_contact',   '');

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
        $filter_project  = Input::get('filter_project');
        $filter_contact  = Input::get('filter_contact');
        
        Session::put('attendance_record_filter_project',    $filter_project);
        Session::put('attendance_record_filter_contact',    $filter_contact);

        return Redirect::route('attendance_record.index');
    }

	/**
     * Removes the list filter values from the session
     * and redirects back to the index to force the 
     * list to be displayed.
     */
    public function resetFilter()
    {
        if (Session::has('attendance_record_filter_project'))  Session::forget('attendance_record_filter_project');
        if (Session::has('attendance_record_filter_contact'))  Session::forget('attendance_record_filter_contact');

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

    	foreach ($contact_ids as $contact_id) {
        	
        	$data = array(
	            	'project_id'      => Input::get('project_id'),
	            	'contact_id'      => $contact_id,
	            	'attendance_date' => Input::get('attendance_date'),
	            	'hours'           => Input::get('hours'),
	            	'user_id'         => $user->id
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

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'edit attendance record details');

        $this->layout->content =
            View::make('attendance_records.edit')
                    ->with('record', $record)
                    ->with('projects', $projects)
                    ->with('contacts', $contacts);
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

        $validator = 
            Validator::make(
                $input, 
                $this->inject_id(AttendanceRecord::$rules, $id));

        if ($validator->passes())
        {
        	$user = Sentry::getUser();
			$admin = Sentry::findGroupByName('Attendance Administration');

		    if ($user->isSuperUser() || $user->inGroup($admin)) {
				$record = AttendanceRecord::findOrFail($id);
			} else {
				$record = $user->attendance_records()->where('id', $id)->firstOrFail();
			}

            $record->update($input);
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