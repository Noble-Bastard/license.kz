<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraServicesQuestionMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_services_question_maps', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('extra_service_question_value_id');
          $table->unsignedInteger('extra_services_step_body_id');
          $table->softDeletes();

          $table->foreign('extra_service_question_value_id', 'es_question_maps_es_question_values_foreign')
            ->references('id')->on('extra_service_question_values');
          $table->foreign('extra_services_step_body_id', 'es_question_maps_es_step_bodes_foreign')
            ->references('id')->on('extra_services_step_bodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_services_question_maps');
    }
}
