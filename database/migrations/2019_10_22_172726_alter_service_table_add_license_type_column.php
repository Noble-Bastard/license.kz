<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterServiceTableAddLicenseTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            delete from license_type;
            insert into license_type (id, name)
            values (1, 'Базовая лицензия');
        ");

        Schema::table('service',function (Blueprint $table){
            $table->unsignedSmallInteger('license_type_id')->nullable();

            $table->foreign('license_type_id', 'service_license_type_fk')
                ->references('id')->on('license_type');
        });

        DB::unprepared("
            update service_step
            set
                license_type_id = 1;
                
            update service
            set
                license_type_id = 1;
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service', function (Blueprint $table) {
            $table->dropForeign('service_license_type_fk');
            $table->dropColumn('license_type_id');
        });
    }
}
