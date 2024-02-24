<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedServiceStepRequiredDocumentsWithServiceId extends Migration
{

    public function up()
    {
        DB::unprepared("
            update service_step_required_document srd
               left join service_step_map ssm
               on ssm.service_step_id = srd.service_step_id
            set
                srd.service_id = ssm.service_id
            where srd.service_id is null
            and ssm.id is not null;
        ");
    }


    public function down()
    {
        //
    }
}
