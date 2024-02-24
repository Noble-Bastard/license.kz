<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectReviewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_review', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->unsigned()->index('project_review_project_fk_idx');
			$table->timestamp('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('created_by')->unsigned()->index('project_review_created_by_fk_idx');
			$table->smallInteger('project_review_status')->unsigned()->index('project_review_idx');
			$table->integer('assigned_to')->unsigned()->index('project_review_assigned_to_fk_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_review');
	}

}
