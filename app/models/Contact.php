<?php

use Carbon\Carbon;

class Contact extends Eloquent {
	
	protected $table = 'contacts';

	protected $guarded = array('id');


	// Eager loading
    protected $with = array('volunteer_details');


    // Validation rules
	public static $rules = array(
		'first_name'               => 'required|max:50',
		'last_name'                => 'required|max:50',
		'address_line_1'           => 'max:100',
		'address_line_2'           => 'max:100',
		'address_town'             => 'max:100',
		'address_postcode'         => 'max:10',
		'telephone'                => 'max:50',
		'mobile'                   => 'max:50',
		'email'                    => 'email|max:254',
		'date_of_birth'			   => 'date',
		'gender'                   => 'max:10',
	);


	// Retrieve dates as eloquent objects
	public function getDates()
    {
        $dates = parent::getDates();
        array_push($dates, 'date_of_birth');
        return $dates;
    }


    // Relationship: volunteer_details
	public function volunteer_details()
    {
        return $this->hasOne('VolunteerDetails');
    }


    // Relationship: attendance_records
    public function attendance_records()
    {
        return $this->hasMany('AttendanceRecord');
    }


    // Relationship: connection_cards
    public function connection_cards()
    {
        return $this->hasMany('ConnectionCard');
    }
    

    // Combine first and last name for this contact
    public function getNameAttribute()
    {
    	return trim("{$this->first_name} {$this->last_name}");
    }


    // Is this contact a volunteer?
    public function getVolunteerAttribute()
    {
    	return $this->volunteer_details !== null;
    }


    // Is this contact a guest?
    public function getGuestAttribute()
    {
        return $this->connection_cards()->count() > 0;
    }

    // Calculate age based on date of birth
    public function getAgeAttribute()
    {
        if ($this->date_of_birth) return $this->date_of_birth->age;
        return null;
    }

    // Get birthday (this year rather than date of birth)
    public function getBirthdayAttribute()
    {
        if ($this->date_of_birth) {
            $this_year = Carbon::today()->year;
            $tmp = $this->date_of_birth->copy();
            $tmp->year = $this_year;
            return $tmp;
        }

        return null;
    }
}