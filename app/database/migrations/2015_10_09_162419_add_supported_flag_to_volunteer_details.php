<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSupportedFlagToVolunteerDetails extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('volunteer_details', function(Blueprint $table)
		{
			$table->boolean('supported')->default(false);
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
			$table->dropColumn('supported');
		});
	}

}
