<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCounterStepTypeIdServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        \Illuminate\Support\Facades\DB::statement("
//            insert into counter_type (id, code, `name`) values (12, 'GENERAL_STEP_COUNTER', 'Базовый счетчик шагов услуги');
//            update service_step set counter_type_id = 12 where 1 = 1;
//        ");
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
