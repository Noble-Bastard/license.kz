<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceStepMapTable extends Migration
{
    public function up()
    {
        Schema::create('service_step_map', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('service_step_id');
        });

        Schema::table('service_step_map', function (Blueprint $table){
            $table->unique(['service_id', 'service_step_id'], 'service_step_map_uix');
            $table->foreign('service_id', 'service_step_map_service_id_fk')
                ->references('id')->on('service');
            $table->foreign('service_step_id','service_step_map_service_step_id_fk')
                ->references('id')->on('service_step');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_step_map');
    }
}
