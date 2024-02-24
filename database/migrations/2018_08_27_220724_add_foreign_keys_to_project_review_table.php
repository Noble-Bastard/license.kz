<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProjectReviewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('project_review', function(Blueprint $table)
		{
			$table->foreign('assigned_to', 'project_review_assigned_to_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('created_by', 'project_review_created_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('project_id', 'project_review_project_fk')->references('id')->on('project')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('project_review_status', 'project_review_project_review_status_fk')->references('id')->on('project_review_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('project_review', function(Blueprint $table)
		{
			$table->dropForeign('project_review_assigned_to_fk');
			$table->dropForeign('project_review_created_by_fk');
			$table->dropForeign('project_review_project_fk');
			$table->dropForeign('project_review_project_review_status_fk');
		});
	}

}
