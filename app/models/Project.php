<?php

class Project extends Eloquent {
	
	protected $table = 'projects';

	protected $guarded = array('id');

	public static $rules = array(
		'name'   => 'required|max:100|unique:projects,name,:id',
		'leader' => 'required|max:100',
	);


	// Relationship: roles
	public function roles()
    {
        return $this->hasMany('ProjectRole');
    }

	// Relationship
    public function attendance_records()
    {
        return $this->hasMany('AttendanceRecord');
    }

    // Relationship: connection_cards
    public function connection_cards()
    {
        return $this->hasMany('ConnectionCard');
    }
}