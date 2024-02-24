<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLicenseTypeToServiceStep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_step', function (Blueprint $table) {
            $table->unsignedSmallInteger('license_type_id')->nullable();

            $table->foreign('license_type_id', 'service_step_license_type_id_fk')
                ->references('id')->on('license_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_step', function (Blueprint $table) {
            $table->dropForeign('service_step_license_type_id_fk');
            $table->dropColumn('license_type_id');
        });
    }
}
