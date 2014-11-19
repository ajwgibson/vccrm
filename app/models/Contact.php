<?php

class Contact extends Eloquent {
	
	protected $table = 'contacts';

	protected $guarded = array('id');

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
}