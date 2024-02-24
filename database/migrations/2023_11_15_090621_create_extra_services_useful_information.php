<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraServicesUsefulInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('extra_services_useful_information', function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedInteger('extra_service_id');
        $table->smallInteger('order_no');
        $table->string('name', 2048);
        $table->string('short_description', 2048);
        $table->text('description')->nullable();
        $table->string('btn_name', 2048)->nullable();
        $table->string('file_path', 2048)->nullable();

        $table->foreign('extra_service_id', 'esui_extra_service_fk')
          ->references('id')->on('extra_services');

        $table->softDeletes();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_services_useful_information');
    }
}
