<?php

class ContactController extends \BaseController {

    protected $title = 'Contacts';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$contacts = Contact::orderBy('first_name')->orderBy('last_name');

		$filtered = false;
		$filter_name      = Session::get('contact_filter_name',      '');
        $filter_guest     = Session::get('contact_filter_guest',     '');
        $filter_volunteer = Session::get('contact_filter_volunteer', '');

        if (!(empty($filter_name))) {
            $contacts = $contacts
                ->where(function($query) use($filter_name) {
                    $query->where('contacts.first_name', 'LIKE', "%$filter_name%")
                          ->orWhere('contacts.last_name', 'LIKE', "%$filter_name%");
                });	
            $filtered = true;
        }

        if (!(empty($filter_guest))) {
            $contacts = $contacts->has('connection_cards');
            $filtered = true;
        }

        if (!(empty($filter_volunteer))) {
            $contacts = $contacts->has('volunteer_details');
            $filtered = true;
        }

		$contacts = $contacts->paginate(20);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'show all contacts');

        $this->layout->content =
            View::make('contacts.index')
                    ->with('contacts', $contacts)
                    ->with('filtered', $filtered)
                    ->with('filter_name', $filter_name)
                    ->with('filter_guest', $filter_guest)
                    ->with('filter_volunteer', $filter_volunteer);
	}

	
	/**
     * Changes the list filter values in the session
     * and redirects back to the index to force the filtered
     * list to be displayed.
     */
    public function filter()
    {
        $filter_name      = Input::get('filter_name');
        $filter_guest     = Input::get('filter_guest');
        $filter_volunteer = Input::get('filter_volunteer');
        
        Session::put('contact_filter_name',      $filter_name);
        Session::put('contact_filter_guest',     $filter_guest);
        Session::put('contact_filter_volunteer', $filter_volunteer);

        return Redirect::route('contact.index');
    }

	
	/**
     * Removes the list filter values from the session
     * and redirects back to the index to force the 
     * list to be displayed.
     */
    public function resetFilter()
    {
        if (Session::has('contact_filter_name'))      Session::forget('contact_filter_name');
        if (Session::has('contact_filter_guest'))     Session::forget('contact_filter_guest');
        if (Session::has('contact_filter_volunteer')) Session::forget('contact_filter_volunteer');

        return Redirect::route('contact.index');
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$contact = new Contact();

		$this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'add a new contact');

        $this->layout->content =
            View::make('contacts.create')
                    ->with('contact', $contact);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

        if (!$input['date_of_birth']) $input = array_except($input, array('date_of_birth'));

        $validator = 
            Validator::make(
                $input, 
                $this->inject_id(Contact::$rules, ''));

        if ($validator->passes())
        {
            Contact::create($input);
            return Redirect::route('contact.index');
        }

        return Redirect::route('contact.create')
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
		$contact = Contact::with('connection_cards')->findOrFail($id);

		$this->layout->with('title', $this->title);
        $this->layout->with('subtitle', "details for {$contact->first_name} {$contact->last_name}");

        $this->layout->content =
            View::make('contacts.show')
                    ->with('contact', $contact);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$contact = Contact::findOrFail($id);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', "change {$contact->first_name} {$contact->last_name}'s details");

        $this->layout->content =
            View::make('contacts.edit', compact('contact'));
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

        if (!$input['date_of_birth']) $input = array_except($input, array('date_of_birth'));
        
        $validator = 
            Validator::make(
                $input, 
                $this->inject_id(Contact::$rules, $id));

        if ($validator->passes())
        {
            $contact = Contact::find($id);
            $contact->update($input);
            return Redirect::route('contact.show', $id);
        }

        return Redirect::route('contact.edit', $id)
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
		Contact::destroy($id);

        return Redirect::route('contact.index');
	}

}