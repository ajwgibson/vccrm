<?php

use Carbon\Carbon;

class AttendanceRecord extends Eloquent {
	
	protected $table = 'attendance_records';

	protected $guarded = array('id');

	public static $rules = array(
        'project_id'      => 'required|exists:projects,id',
        'contact_id'      => 'required|exists:contacts,id',
        'attendance_date' => 'required|date',
        'hours'           => 'required|numeric|min:0|max:24',
		'role'            => 'max:100',
	);

    public static $messages = array(
        'project_id.required'  => "You must select a project",
        'contact_id.required'  => "You must select a contact",
    );

	// Define which properties should be treated as dates
    public function getDates()
    {
        $dates = parent::getDates();
        array_push($dates, 'attendance_date');
        return $dates;
    }

    // Relationship: volunteer
	public function contact()
    {
        return $this->belongsTo('Contact');
    }

    // Relationship: project
    public function project()
    {
        return $this->belongsTo('Project');
    }

    // Relationship: user
    public function user()
    {
        return $this->belongsTo('User');
    }

}