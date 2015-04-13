<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVineyardCompassionFlagToVolunteerDetails extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('volunteer_details', function(Blueprint $table)
		{
			$table->boolean('vineyard_compassion')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('volunteer_details', function(Blueprint $table)
		{
			$table->dropColumn('vineyard_compassion');
		});
	}

}
