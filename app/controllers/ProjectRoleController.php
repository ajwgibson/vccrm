<?php

class ProjectRoleController extends \BaseController {

    protected $title = 'Project Roles';

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($project)
	{
		$role = new ProjectRole();
		$role->volunteer = true;

		$this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'add a new project role');

        $this->layout->content =
            View::make('project_roles.create')
                    ->with('role', $role)
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
                $this->inject_id(ProjectRole::$rules, ''));

        if ($validator->passes())
        {
            ProjectRole::create($input);
            return Redirect::route('project.show', array(Input::get('project_id')));
        }

        return Redirect::route('project_role.create', array(Input::get('project_id')))
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
		$role = ProjectRole::findOrFail($id);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'details of the "' . $role->name . '" role');

        $this->layout->content =
            View::make('project_roles.show')
                    ->with('role', $role);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$role = ProjectRole::findOrFail($id);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', "change the '{$role->name}' project role details");

        $this->layout->content =
            View::make('project_roles.edit')
            		->with('role', $role);
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
                $this->inject_id(ProjectRole::$rules, $id));

        if ($validator->passes())
        {
            $role = ProjectRole::find($id);
            $role->update($input);
            return Redirect::route('project_role.show', $id);
        }

        return Redirect::route('project_role.edit', $id)
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
		$role = ProjectRole::findOrFail($id);
		$project_id = $role->project->id;

		ProjectRole::destroy($id);

        return Redirect::route('project.show', $project_id);
	}
}
