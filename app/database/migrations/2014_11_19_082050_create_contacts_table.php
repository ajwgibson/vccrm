<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('first_name', 50);
			$table->string('last_name', 50);

			$table->string('address_line_1',   100)->nullable();
			$table->string('address_line_2',   100)->nullable();
			$table->string('address_town',     100)->nullable();
			$table->string('address_postcode', 10)->nullable();

			$table->string('telephone', 50)->nullable();
			$table->string('mobile',    50)->nullable();
			$table->string('email',    254)->nullable();

			$table->date('date_of_birth')->nullable();

			$table->string('gender', 10)->nullable();

			$table->text('notes')->nullable();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contacts');
	}

}
