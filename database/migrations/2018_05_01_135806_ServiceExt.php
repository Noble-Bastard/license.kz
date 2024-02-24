<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceExt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            create or replace view service_ext
            as
            select
               s.id,
               s.counter_type_id,
               ct.name counter_type_name,
               s.description,
               s.is_active,
               s.name,
               s.required_document,
               s.service_thematic_group_id,
               stg.name service_thematic_group_name,
               s.time_of_service_execution_from,
               s.time_of_service_execution_to
            from service s
               left join counter_type ct
               on ct.id = s.counter_type_id
               left join service_thematic_group stg
               on stg.id = s.service_thematic_group_id
        ');
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
