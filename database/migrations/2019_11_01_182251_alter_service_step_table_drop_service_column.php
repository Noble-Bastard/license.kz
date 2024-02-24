<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterServiceStepTableDropServiceColumn extends Migration
{

    public function up()
    {
        Schema::table('service_step', function (Blueprint $table){
           $table->dropForeign('service_step_services_fk');
        });

        Schema::table('service_step', function (Blueprint $table){
            $table->dropColumn('service_id');
            $table->dropColumn('step_number');
            $table->dropColumn('is_active');
            $table->dropColumn('is_required');
        });
    }


    public function down()
    {
        //
    }
}
