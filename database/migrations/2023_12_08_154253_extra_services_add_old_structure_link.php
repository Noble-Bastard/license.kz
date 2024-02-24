<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtraServicesAddOldStructureLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extra_services_step_headers', function (Blueprint $table) {
          $table->unsignedInteger('service_id');
        });
        Schema::table('extra_services_step_bodes', function (Blueprint $table) {
          $table->unsignedInteger('service_step_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
