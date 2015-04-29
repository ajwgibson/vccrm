<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('case_notes', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('contact_id')->unsigned();
			$table->integer('project_id')->unsigned();

			$table->string('volunteer', '100');
			$table->date('conversation_date');
			$table->string('channel', 50);
			$table->text('notes');

			$table->timestamps();

			$table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('case_notes');
	}

}
