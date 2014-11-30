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
		$contacts = Contact::orderBy('first_name')->orderBy('last_name')->paginate(20);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'show all contacts');

        $this->layout->content =
            View::make('contacts.index')
                    ->with('contacts', $contacts);
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