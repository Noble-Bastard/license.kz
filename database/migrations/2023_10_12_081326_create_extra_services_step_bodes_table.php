<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraServicesStepBodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_services_step_bodes', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('extra_services_step_header_id');
          $table->string('name', 2048);
          $table->smallInteger('dayCount');
          $table->text('result');
          $table->unsignedInteger('order');
          $table->softDeletes();

          $table->foreign('extra_services_step_header_id')
            ->references('id')->on('extra_services_step_headers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_services_step_bodes');
    }
}
