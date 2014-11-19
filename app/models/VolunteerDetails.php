<?php

class VolunteerDetails extends Eloquent {
	
	protected $table = 'volunteer_details';

	protected $guarded = array('id');

	public static $rules = array(
		'next_of_kin_name'         => 'max:100',
		'next_of_kin_telephone'    => 'max:50',
		'next_of_kin_relationship' => 'max:100',
		'emergency_name'           => 'max:100',
		'emergency_telephone'      => 'max:50',
		'emergency_relationship'   => 'max:100',
	);

    // Relationship: contact ()
    public function contact()
    {
        return $this->belongsTo('Contact');
    }

}