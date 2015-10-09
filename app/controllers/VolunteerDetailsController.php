<?php

class VolunteerDetailsController extends \BaseController {

    protected $title = 'Volunteer Details';

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$contact = Contact::findOrFail($id);

		$volunteer_details = new VolunteerDetails();
        $volunteer_details->vineyard_compassion = true;     // Default to true
		$volunteer_details->supported = false;		        // Default to false

		$this->layout->with('title', $this->title);
        $this->layout->with('subtitle', "add volunteer details for {$contact->name}");

        $this->layout->content =
            View::make('volunteer_details.create')
                    ->with('contact', $contact)
                    ->with('volunteer_details', $volunteer_details);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
		$contact = Contact::findOrFail($id);

		$input = Input::all();

        $validator = 
            Validator::make(
                $input, 
                $this->inject_id(VolunteerDetails::$rules, ''));

        if ($validator->passes())
        {
        	$contact->volunteer_details()->save(
        		new VolunteerDetails($input));
            return Redirect::route('contact.show', $id);
        }

        return Redirect::route('volunteer_details.create', $id)
            ->withInput()
            ->withErrors($validator);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$volunteer_details = VolunteerDetails::with('contact')->findOrFail($id);

        $this->layout->with('title', $this->title);
        $this->layout->with(
        	'subtitle', 
        	"change {$volunteer_details->contact->name}'s details");

        $this->layout->content =
            View::make('volunteer_details.edit', compact('volunteer_details'));
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
                $this->inject_id(VolunteerDetails::$rules, $id));

        if ($validator->passes())
        {
            $volunteer_details = VolunteerDetails::with('contact')->find($id);
            $volunteer_details->update($input);
            return Redirect::route(
            	'contact.show', 
            	$volunteer_details->contact->id);
        }

        return Redirect::route('volunteer_details.edit', $id)
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
		$volunteer_details = VolunteerDetails::with('contact')->findOrFail($id);
		$contact_id = $volunteer_details->contact->id;

		VolunteerDetails::destroy($id);

        return Redirect::route('contact.show', $contact_id);
	}

}
