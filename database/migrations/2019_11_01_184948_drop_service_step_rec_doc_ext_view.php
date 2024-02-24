<?php

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Migrations\Migration;

class DropServiceStepRecDocExtView extends Migration
{

    public function up()
    {
        DB::unprepared('
            drop view if exists service_step_required_document_ext;
        ');
    }


    public function down()
    {
        //
    }
}
