<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTaskReviewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('task_review', function(Blueprint $table)
		{
			$table->foreign('created_by', 'task_review_created_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('project_review_id', 'task_review_project_review_fk')->references('id')->on('project_review')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('task_id', 'task_review_task_fk')->references('id')->on('task')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('task_review', function(Blueprint $table)
		{
			$table->dropForeign('task_review_created_by_fk');
			$table->dropForeign('task_review_project_review_fk');
			$table->dropForeign('task_review_task_fk');
		});
	}

}
