<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionCardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('connection_cards', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('contact_id')->unsigned();
			$table->integer('project_id')->unsigned();

			$table->string('volunteer', '100')->nullable();
			$table->date('connection_date');

			$table->text('heard_about')->nullable();
			
			$table->boolean('low_income');
			$table->boolean('budgeting_problems');
			$table->boolean('mental_health');
			$table->boolean('addiction');
			$table->boolean('isolation');
			$table->boolean('unemployed');
			$table->boolean('long_term_illness');
			$table->boolean('benefit_issues');
			$table->boolean('relationship_breakdown');
			
			$table->text('notes')->nullable();

			$table->string('marital_status', 25)->nullable();
			$table->integer('adults_in_household')->unsigned()->nullable();
			$table->integer('children_in_household')->unsigned()->nullable();

			$table->text('next_steps_1')->nullable();
			$table->text('next_steps_2')->nullable();
			$table->text('next_steps_3')->nullable();

			$table->boolean('can_contact');
			$table->string('best_telephone', 50)->nullable();
			$table->boolean('best_time_morning');
			$table->boolean('best_time_afternoon');
			$table->boolean('best_time_evening');
			$table->boolean('best_time_weekday');
			$table->boolean('best_time_saturday');
			$table->boolean('best_time_any');

			$table->boolean('card_signed');
			$table->date('signed_date')->nullable();

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
		Schema::drop('connection_cards');
	}

}
