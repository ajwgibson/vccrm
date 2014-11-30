<?php

class ConnectionCardController extends \BaseController {

    protected $title = 'Connection Card';

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($contact_id)
	{
		$contact = Contact::findOrFail($contact_id);

		$connection_card = new ConnectionCard();

		$projects = Project::orderby('name')->lists('name', 'id');

		$this->layout->with('title', $this->title);
        $this->layout->with('subtitle', "add a connection card for {$contact->name}");

        $this->layout->content =
            View::make('connection_cards.create')
                    ->with('contact', $contact)
                    ->with('connection_card', $connection_card)
                    ->with('projects', $projects);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($contact_id)
	{
		$contact = Contact::findOrFail($contact_id);

		$input = Input::all();

        $validator = 
            Validator::make(
                $input, 
                $this->inject_id(ConnectionCard::$rules, ''),
	            ConnectionCard::$messages);

        if ($validator->passes())
        {
        	$contact->connection_cards()->save(new ConnectionCard($input));
            return Redirect::route('contact.show', $contact_id);
        }

        return Redirect::route('connection_card.create', $contact_id)
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
		$connection_card = ConnectionCard::with('contact', 'project')->findOrFail($id);

		$projects = Project::orderby('name')->lists('name', 'id');

		$this->layout->with('title', $this->title);
        $this->layout->with(
        	'subtitle', 
        	"connection card for {$connection_card->contact->name} / {$connection_card->project->name}");

        $this->layout->content =
            View::make('connection_cards.show')
                    ->with('connection_card', $connection_card)
                    ->with('projects', $projects);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$connection_card = ConnectionCard::with('contact')->findOrFail($id);

		$projects = Project::orderby('name')->lists('name', 'id');

        $this->layout->with('title', $this->title);
        $this->layout->with(
        	'subtitle', 
        	"change details for this connection card");

        $this->layout->content =
            View::make('connection_cards.edit', compact('connection_card'))
            		->with('projects', $projects);
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
                $this->inject_id(ConnectionCard::$rules, $id),
                ConnectionCard::$messages);

        if ($validator->passes())
        {
            $connection_card = ConnectionCard::find($id);
            $connection_card->update($input);
            
            return Redirect::route(
            	'connection_card.show', 
            	$connection_card->id);
        }

        return Redirect::route('connection_card.edit', $id)
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
		$connection_card = ConnectionCard::findOrFail($id);
		$contact_id = $connection_card->contact_id;

		ConnectionCard::destroy($id);

        return Redirect::route('contact.show', $contact_id);
	}

}
