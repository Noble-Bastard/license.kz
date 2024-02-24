<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrimServiceData extends Migration
{

    public function up()
    {
        DB::unprepared("update service_result set description = trim(description)");
        DB::unprepared("update service_required_document set description = trim(description)");
        DB::unprepared("update service_step set description = trim(description)");
        DB::unprepared("update translation set value = trim(value)");
    }


    public function down()
    {
        //
    }
}
