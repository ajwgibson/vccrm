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

}