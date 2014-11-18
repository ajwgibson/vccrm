<?php

class ProjectSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('projects')->delete();


		$project = Project::create(array('name' => 'Causeway Foodbank', 'leader' => 'Melanie Gibson'));
		$project->roles()->save(new ProjectRole(array('name' => 'Guest',                 'hours' => 1.0, 'volunteer' => false)));
		$project->roles()->save(new ProjectRole(array('name' => 'Coordinator',           'hours' => 1.0, 'volunteer' => true)));
		$project->roles()->save(new ProjectRole(array('name' => 'Warehouse',             'hours' => 2.0, 'volunteer' => true)));
		$project->roles()->save(new ProjectRole(array('name' => 'Supermarket Collector', 'hours' => 4.0, 'volunteer' => true)));


		$project = Project::create(array('name' => 'Vineyard Market', 'leader' => 'Pat Storey'));
		$project->roles()->save(new ProjectRole(array('name' => 'Setup',           'hours' => 3.0, 'volunteer' => true)));
		$project->roles()->save(new ProjectRole(array('name' => 'Checkin',         'hours' => 2.0, 'volunteer' => true)));
		$project->roles()->save(new ProjectRole(array('name' => 'Parking',         'hours' => 4.0, 'volunteer' => true)));
		$project->roles()->save(new ProjectRole(array('name' => 'Cafe',            'hours' => 4.0, 'volunteer' => true)));

		$project = Project::create(array('name' => 'CAP', 'leader' => 'Dave Kelly'));
		$project->roles()->save(new ProjectRole(array('name' => 'Guest',                'hours' => 1.0, 'volunteer' => false)));
		$project->roles()->save(new ProjectRole(array('name' => 'Befriender',           'hours' => 1.0, 'volunteer' => true)));

		$project = Project::create(array('name' => 'Grow', 'leader' => 'Alan Stirling'));
		$project->roles()->save(new ProjectRole(array('name' => 'Guest',                'hours' => 2.0, 'volunteer' => false)));
	}

}