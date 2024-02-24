<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedServiceStepMapData extends Migration
{

    public function up()
    {
        DB::unprepared("
            insert into service_step_map(service_id, service_step_id)
            select
                service_id,
                id
            from service_step
        ");
    }

    public function down()
    {
        DB::unprepared("
            delete from service_step_map
        ");
    }
}
