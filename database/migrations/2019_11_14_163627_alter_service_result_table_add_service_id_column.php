<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterServiceResultTableAddServiceIdColumn extends Migration
{

    public function up()
    {
        Schema::table("service_step_result", function(Blueprint $table){
            $table->unsignedInteger("service_id")->nullable();
            $table->foreign("service_id","service_step_result_service_fk")
                ->references('id')->on('service');
        });
    }


    public function down()
    {
        Schema::table("service_step_result", function(Blueprint $table){
            $table->dropForeign("service_step_result_service_fk");
            $table->dropColumn("service_id");
        });
    }
}
