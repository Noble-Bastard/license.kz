<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceAdditionalRequirementsMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_additional_requirements_map', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('service_additional_requirements_id');

            $table->foreign('service_id', 'service_additional_requirements_map_service_fk')->on('service')->references('id');
            $table->foreign('service_additional_requirements_id', 'service_additional_requirements_map_sar_fk')->on('service_additional_requirements')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_additional_requirements_map');
    }
}
