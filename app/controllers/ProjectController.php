<?php

class ProjectController extends \BaseController {

    protected $title = 'Projects';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = Project::orderBy('name')->get();

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'show all projects');

        $this->layout->content =
            View::make('projects.index')
                    ->with('projects', $projects);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$project = new Project();

		$this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'add a new project');

        $this->layout->content =
            View::make('projects.create')
                    ->with('project', $project);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

        $validator = 
            Validator::make(
                $input, 
                $this->inject_id(Project::$rules, ''));

        if ($validator->passes())
        {
            Project::create($input);
            return Redirect::route('project.index');
        }

        return Redirect::route('project.create')
            ->withInput()
            ->withErrors($validator);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$project = Project::findOrFail($id);

		$volunteer_records = 
        	DB::table('attendance_records')
        			->join('contacts', 'attendance_records.contact_id', '=', 'contacts.id')
        			->leftJoin('volunteer_details', 'attendance_records.contact_id', '=', 'volunteer_details.contact_id')
        			->select(
        				DB::raw(
        					'contacts.id as id' .
        					', contacts.first_name as first_name, contacts.last_name as last_name' .
        					', contacts.telephone as telephone, contacts.mobile as mobile, contacts.email as email' .
        					', min(attendance_records.attendance_date) as start_date' .
        					', max(attendance_records.attendance_date) as finish_date' .
        					', sum(attendance_records.hours) as hours' .
        					', volunteer_details.id as volunteer_details_id'))
    				->groupBy('contacts.first_name')
    				->groupBy('contacts.last_name')
    				->where('attendance_records.project_id', '=', $project->id)
    				->where('attendance_records.volunteer', '=', true)
    				->orderBy('contacts.first_name')
    				->orderBy('contacts.last_name')
    				->get();

		$guest_records = 
        	DB::table('attendance_records')
        			->join('contacts', 'attendance_records.contact_id', '=', 'contacts.id')
        			->select(
        				DB::raw(
        					'contacts.id as id' .
        					', contacts.first_name as first_name, contacts.last_name as last_name' .
        					', min(attendance_records.attendance_date) as start_date' .
        					', max(attendance_records.attendance_date) as finish_date' .
        					', sum(attendance_records.hours) as hours'))
    				->groupBy('contacts.first_name')
    				->groupBy('contacts.last_name')
    				->where('attendance_records.project_id', '=', $project->id)
    				->where('attendance_records.volunteer', '=', false)
    				->orderBy('contacts.first_name')
    				->orderBy('contacts.last_name')
    				->get();

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'details of the "' . $project->name . '" project');

        $this->layout->content =
            View::make('projects.show')
                    ->with('project', $project)
                    ->with('volunteer_records', $volunteer_records)
                    ->with('guest_records', $guest_records);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$project = Project::findOrFail($id);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'change the "' . $project->name . '" project details');

        $this->layout->content =
            View::make('projects.edit', compact('project'));
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
                $this->inject_id(Project::$rules, $id));

        if ($validator->passes())
        {
            $project = Project::find($id);
            $project->update($input);
            return Redirect::route('project.show', $id);
        }

        return Redirect::route('project.edit', $id)
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
		Project::destroy($id);

        return Redirect::route('project.index');
	}


	/**
	 * Returns a list of roles for a given project.
	 *
	 * @param  int  $id
	 * @return JSON Response
	 */
	public function roles($id)
	{
		$roles = ProjectRole::where('project_id', $id)->get();
		return $roles;
	}
}
