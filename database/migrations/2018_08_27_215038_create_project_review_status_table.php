<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CreateProjectReviewStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_review_status', function(Blueprint $table)
		{
			$table->smallInteger('id', true)->unsigned();
			$table->string('name', 32);
		});

        DB::statement("
                insert into project_review_status(id, name)
                values
                  (1, 'Не опрелелено'),
                  (2, 'Успешно'),
                  (3, 'Наличие замечаний');
            ");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_review_status');
	}

}
