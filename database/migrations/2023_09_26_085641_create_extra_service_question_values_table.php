<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraServiceQuestionValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_service_question_values', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('extra_service_question_id');
          $table->string('code', 128)->index();
          $table->string('value', 1024);
          $table->integer('cost');
          $table->unsignedInteger('order');
          $table->softDeletes();

          $table->foreign('extra_service_question_id')
            ->references('id')->on('extra_service_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_service_question_values');
    }
}
