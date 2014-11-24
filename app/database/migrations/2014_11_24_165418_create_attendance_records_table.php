<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attendance_records', function(Blueprint $table)
		{
			$table->increments('id');

			$table->date('attendance_date');
			$table->decimal('hours', 5, 2);
			$table->string('role', '100')->nullable();
			$table->boolean('volunteer');

			$table->integer('project_id')->unsigned();
			$table->integer('contact_id')->unsigned();
			$table->integer('user_id')->unsigned()->nullable();

			$table->timestamps();

			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
			$table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attendance_records');
	}

}
