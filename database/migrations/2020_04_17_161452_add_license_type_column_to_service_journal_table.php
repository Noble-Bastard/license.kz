<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddLicenseTypeColumnToServiceJournalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_journal', function (Blueprint $table) {
            $table->unsignedSmallInteger('license_type_id')->nullable();

            $table->foreign('license_type_id', 'service_journal_license_type_fk')
                ->references('id')->on('license_type');
        });

        DB::unprepared("
            update service_journal sj
                inner join service_journal_step sjs
                on sjs.service_journal_id = sj.id
                    inner join service_step ss
                    on ss.id = sjs.service_step_id
            set 
                sj.license_type_id = ss.license_type_id;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_journal', function (Blueprint $table) {
            $table->dropColumn('license_type_id');
        });
    }
}
