<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedServiceStatusRejectOrder extends Migration
{

    public function up()
    {
        DB::unprepared("
            update service_status
            set
                status_order = 1000
            where id = 10;
        ");
    }


    public function down()
    {
        //
    }
}
