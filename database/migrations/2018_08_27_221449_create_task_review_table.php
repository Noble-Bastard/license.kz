<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskReviewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('task_review', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_review_id')->unsigned()->index('task_review_project_review_fk_idx');
			$table->integer('task_id')->unsigned()->index('task_review_task_fk_idx');
			$table->string('comment', 1024);
			$table->integer('created_by')->unsigned()->index('task_review_created_by_fk_idx');
			$table->timestamp('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('task_review');
	}

}
