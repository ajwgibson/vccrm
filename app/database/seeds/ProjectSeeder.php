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

		Project::create(array(
			'name'   => 'Causeway Foodbank',
			'leader' => 'Melanie Gibson'));

		Project::create(array(
			'name'   => 'Vineyard Market',
			'leader' => 'Pat Storey'));

		Project::create(array(
			'name'   => 'CAP',
			'leader' => 'Dave Kelly'));

		Project::create(array(
			'name'   => 'Grow',
			'leader' => 'Alan Stirling'));
		
	}

}