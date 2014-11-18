<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_roles', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name', '100');
			$table->decimal('hours', 5, 2)->nullable();
			$table->boolean('volunteer');

			$table->integer('project_id')->unsigned();

			$table->timestamps();

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
		Schema::drop('project_roles');
	}

}
