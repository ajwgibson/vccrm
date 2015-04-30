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

        if (!$input['signed_date'])           $input = array_except($input, array('signed_date'));
        if (!$input['adults_in_household'])   $input = array_except($input, array('adults_in_household'));
        if (!$input['children_in_household']) $input = array_except($input, array('children_in_household'));

        $validator = 
            Validator::make(
                $input, 
                $this->inject_id(ConnectionCard::$rules, ''),
	            ConnectionCard::$messages);

        if ($validator->passes())
        {
        	$contact->connection_cards()->save(new ConnectionCard($input));
        	
            return Redirect::route(
            	'contact.show', 
            	array('id' => $contact_id, 'guest-details' => true));
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

        if ($input['signed_date'] == '') $input['signed_date'] = null;
        if ($input['adults_in_household'] == '') $input['adults_in_household'] = null;
        if ($input['children_in_household'] == '') $input['children_in_household'] = null;

    	// Sort out checkboxes :(
        if (!array_key_exists('low_income', $input)) 			 $input['low_income'] = false;
		if (!array_key_exists('budgeting_problems', $input)) 	 $input['budgeting_problems'] = false;
		if (!array_key_exists('mental_health', $input)) 		 $input['mental_health'] = false;
		if (!array_key_exists('addiction', $input)) 			 $input['addiction'] = false;
		if (!array_key_exists('isolation', $input)) 			 $input['isolation'] = false;
		if (!array_key_exists('unemployed', $input)) 			 $input['unemployed'] = false;
		if (!array_key_exists('long_term_illness', $input)) 	 $input['long_term_illness'] = false;
		if (!array_key_exists('benefit_issues', $input)) 		 $input['benefit_issues'] = false;
		if (!array_key_exists('relationship_breakdown', $input)) $input['relationship_breakdown'] = false;
		if (!array_key_exists('best_time_morning', $input)) 	 $input['best_time_morning'] = false;
		if (!array_key_exists('best_time_afternoon', $input)) 	 $input['best_time_afternoon'] = false;
		if (!array_key_exists('best_time_evening', $input)) 	 $input['best_time_evening'] = false;
		if (!array_key_exists('best_time_weekday', $input)) 	 $input['best_time_weekday'] = false;
		if (!array_key_exists('best_time_saturday', $input)) 	 $input['best_time_saturday'] = false;
		if (!array_key_exists('best_time_any', $input)) 		 $input['best_time_any'] = false;

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

        return Redirect::route(
            	'contact.show', 
            	array('id' => $contact_id, 'guest-details' => true));
	}

}
