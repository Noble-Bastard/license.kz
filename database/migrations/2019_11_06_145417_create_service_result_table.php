<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_result', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->string('description', 1024);
        });

        DB::unprepared("
            insert into service_result(description)
            select 
                description
            from service_step_result
            group by description
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_result');
    }
}
