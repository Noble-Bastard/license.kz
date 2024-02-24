<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedServiceJournalServiceMapData extends Migration
{

    public function up()
    {
        DB::unprepared("
            insert into service_journal_service_map(service_journal_id, service_id)
            select
                id,
                service_id
            from service_journal;
        ");

        Schema::table("service_journal", function(Blueprint $table){
            $table->dropForeign("service_journal_services_fk");
            $table->dropForeign("service_journal_service_map_services_fk");
            $table->dropIndex("service_journal_services_fk");
            $table->dropColumn("service_id");
        });

    }


    public function down()
    {
        DB::unprepared("
            delete from service_journal_service_map;
        ");
    }
}
