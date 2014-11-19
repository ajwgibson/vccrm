<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteerDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('volunteer_details', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('contact_id')->unsigned();

			$table->string('next_of_kin_name',         100)->nullable();
			$table->string('next_of_kin_telephone',     50)->nullable();
			$table->string('next_of_kin_relationship', 100)->nullable();

			$table->string('emergency_name',         100)->nullable();
			$table->string('emergency_telephone',     50)->nullable();
			$table->string('emergency_relationship', 100)->nullable();

			$table->boolean('health_issues');
			$table->text('health_issues_details')->nullable();

			$table->text('personal_development_notes')->nullable();

			$table->boolean('access_ni_required');
			$table->boolean('access_ni_received');

			$table->boolean('confidentiality');
			$table->boolean('photographs');
			$table->boolean('health_and_safety');
			$table->boolean('safeguarding');

			$table->text('notes')->nullable();

			$table->timestamps();

			$table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('volunteer_details');
	}

}
