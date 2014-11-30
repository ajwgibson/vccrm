<?php

class ConnectionCard extends Eloquent {
	
	protected $table = 'connection_cards';

	protected $guarded = array('id');

	public static $rules = array(
        'project_id'            => 'required|exists:projects,id',
		'connection_date'       => 'required',
        'adults_in_household'   => 'numeric|min:0',
        'children_in_household' => 'numeric|min:0',
	);

    public static $messages = array(
        'project_id.required'  => "You must select a project",
    );

    // Define which properties should be treated as dates
    public function getDates()
    {
        $dates = parent::getDates();
        array_push($dates, 'connection_date');
        array_push($dates, 'signed_date');
        return $dates;
    }

    // Relationship: contact
    public function contact()
    {
        return $this->belongsTo('Contact');
    }

    // Relationship: project
    public function project()
    {
        return $this->belongsTo('Project');
    }

}