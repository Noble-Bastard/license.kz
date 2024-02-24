<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtraServiceQuestionTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('extra_service_questions', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('extra_service_id');
      $table->string('value', 256);
      $table->unsignedInteger('order');
      $table->softDeletes();

      $table->foreign('extra_service_id')
        ->references('id')->on('extra_services');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('extra_service_questions');
  }
}
