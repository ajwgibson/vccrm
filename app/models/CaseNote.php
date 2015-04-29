<?php

class CaseNote extends Eloquent {
	
	protected $table = 'case_notes';

	protected $guarded = array('id');

	public static $rules = array(
        'project_id'            => 'required|exists:projects,id',
		'conversation_date'     => 'required',
        'volunteer'             => 'required|max:100',
        'channel'               => 'required|max:50',
        'notes'                 => 'required',
	);

    public static $messages = array(
        'project_id.required'  => "You must select a project",
        'volunteer.required'   => "You must provide the name of the volunteer who spoke to the guest",
        'notes.required'       => "You must provide details",
        'conversation_date.required'  => "You must provide the date when the volunteer spoke to the guest",
    );

    // Define which properties should be treated as dates
    public function getDates()
    {
        $dates = parent::getDates();
        array_push($dates, 'conversation_date');
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