<?php

class ContactSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('contacts')->delete();

		$contact = Contact::create(
			array(
				'first_name'               => 'Alan',
				'last_name'                => 'Gibson',
				'address_line_1'           => '8 Litchfield Park',
				'address_line_2'           => '',
				'address_town'             => 'Coleraine',
				'address_postcode'         => 'BT51 3TN',
				'telephone'                => '02870342419',
				'mobile'                   => '07581278314',
				'email'                    => 'ajw.gibson@gmail.com',
				'date_of_birth'			   => '1971-04-10',
				'gender'                   => 'Male',
			));
		$contact->volunteer_details()->save(
			new VolunteerDetails(
				array(
					'next_of_kin_name'           => 'Sue',
					'next_of_kin_telephone'      => '12345',
					'next_of_kin_relationship'   => 'Wife',
					'emergency_name'		     => 'Also Sue',
					'emergency_telephone'        => '98765',
					'emergency_relationship'     => 'Still wife',
					'health_issues'              => true,
					'health_issues_details'      => 'Personal',
					'personal_development_notes' => 'Wants some training',
					'access_ni_required'         => true,
					'access_ni_received'         => true,
					'confidentiality'            => true,
					'photographs'                => true,
					'health_and_safety'          => true,
					'safeguarding'               => true,
					'notes'                      => 'Some note here'
				)));

		$contact = Contact::create(
			array(
				'first_name'               => 'Sue',
				'last_name'                => 'Gibson',
				'address_line_1'           => '8 Litchfield Park',
				'address_line_2'           => '',
				'address_town'             => 'Coleraine',
				'address_postcode'         => 'BT51 3TN',
				'telephone'                => '02870342419',
				'mobile'                   => '',
				'email'                    => 'suejgibson@gmail.com',
				'date_of_birth'			   => '1973-03-22',
				'gender'                   => 'Female',
			));

		$contact = Contact::create(
			array(
				'first_name'               => 'John',
				'last_name'                => 'Smith',
				'address_line_1'           => '15 Barnside Road',
				'address_line_2'           => 'Kilrea',
				'address_town'             => 'Coleraine',
				'address_postcode'         => 'BT51 5YB',
				'telephone'                => '02829557579',
				'mobile'                   => '',
				'email'                    => 'jsmith@vcmail.com',
				'date_of_birth'			   => '',
				'gender'                   => 'Male',
			));

		$contact = Contact::create(
			array(
				'first_name'               => 'Danny',
				'last_name'                => 'Jones',
				'address_line_1'           => '15 Barnside Road',
				'address_line_2'           => 'Kilrea',
				'address_town'             => 'Coleraine',
				'address_postcode'         => 'BT51 5YB',
				'telephone'                => '02829557579',
				'mobile'                   => '',
				'email'                    => 'djones@vcmail.com',
				'date_of_birth'			   => '',
				'gender'                   => 'Male',
			));

	}

}