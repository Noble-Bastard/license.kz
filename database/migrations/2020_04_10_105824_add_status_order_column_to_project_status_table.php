<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddStatusOrderColumnToProjectStatusTable extends Migration
{

    public function up()
    {
        Schema::table('project_status',function (Blueprint $table){
            $table->unsignedInteger('status_order')->nullable();
        });

        DB::unprepared("
            update project_status
            set
                status_order = Id * 100;
            
            update project_status
            set
                status_order = 350,
                name = 'Проверка'
            where id = 5;            
         ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_status', function (Blueprint $table) {
            //
        });
    }
}
