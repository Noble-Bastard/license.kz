<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceStepExtFix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            create or replace view service_step_result_ext
            as
              select
                ssr.id,
                ssr.description,
                ss.service_id,
                srv.name service_name,
                srv.code service_code,
                ssr.service_step_id,
                ss.description service_step_description
              from service_step_result ssr
                left join service_step ss
                  on ss.id = ssr.service_step_id
                left join service srv
                  on srv.id = ss.service_id
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
