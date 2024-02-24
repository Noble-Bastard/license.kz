<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropServiceStepResultExtView extends Migration
{

    public function up()
    {
        DB::unprepared('
            drop view if exists service_step_result_ext
        ');
    }


    public function down()
    {
        //
    }
}
