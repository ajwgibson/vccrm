<?php

class CaseNoteController extends \BaseController {

    protected $title = 'Case Note';

	/**
	 * Show the form for creating a new case note.
	 *
	 * @return Response
	 */
	public function create($contact_id)
	{
		$contact = Contact::findOrFail($contact_id);

		$case_note = new CaseNote();

		$projects = Project::orderby('name')->lists('name', 'id');

		$this->layout->with('title', $this->title);
        $this->layout->with('subtitle', "add a case note for {$contact->name}");

        $this->layout->content =
            View::make('case_notes.create')
                    ->with('contact', $contact)
                    ->with('case_note', $case_note)
                    ->with('projects', $projects);
	}


	/**
	 * Store a newly created case note.
	 *
	 * @return Response
	 */
	public function store($contact_id)
	{
		$contact = Contact::findOrFail($contact_id);

		$input = Input::all();

        if (!$input['conversation_date'])    $input = array_except($input, array('conversation_date'));

        $validator = 
            Validator::make(
                $input, 
                $this->inject_id(CaseNote::$rules, ''),
	            CaseNote::$messages);

        if ($validator->passes())
        {
        	$contact->case_notes()->save(new CaseNote($input));
            return Redirect::route('contact.show', $contact_id);
        }

        return Redirect::route('case_note.create', $contact_id)
            ->withInput()
            ->withErrors($validator);
	}


	/**
	 * Display the specified case note.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$case_note = CaseNote::with('contact', 'project')->findOrFail($id);

		$projects = Project::orderby('name')->lists('name', 'id');

		$this->layout->with('title', $this->title);
        $this->layout->with(
        	'subtitle', 
        	"case note for {$case_note->contact->name} / {$case_note->project->name}");

        $this->layout->content =
            View::make('case_notes.show')
                    ->with('case_note', $case_note)
                    ->with('projects', $projects);
	}


	/**
	 * Show the form for editing the specified case note.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$case_note = CaseNote::with('contact')->findOrFail($id);

		$projects = Project::orderby('name')->lists('name', 'id');

        $this->layout->with('title', $this->title);
        $this->layout->with(
        	'subtitle', 
        	"change details of this case note");

        $this->layout->content =
            View::make('case_notes.edit', compact('case_note'))
            		->with('projects', $projects);
	}


	/**
	 * Update the specified case note.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();

        if ($input['conversation_date'] == '') $input['conversation_date'] = null;

        $validator = 
            Validator::make(
                $input, 
                $this->inject_id(CaseNote::$rules, $id),
                CaseNote::$messages);

        if ($validator->passes())
        {
            $case_note = CaseNote::find($id);
            $case_note->update($input);
            
            return Redirect::route('case_note.show', $case_note->id);
        }

        return Redirect::route('case_note.edit', $id)
            ->withInput()
            ->withErrors($validator);
	}


	/**
	 * Remove the specified case note.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$case_note = CaseNote::findOrFail($id);
		$contact_id = $case_note->contact_id;

		CaseNote::destroy($id);

        return Redirect::route('contact.show', $contact_id);
	}

}
