<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeePosition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_position', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value',256);
        });

        DB::statement("insert into employee_position (id, value) values (1, 'Основатель');");
        DB::statement("insert into employee_position (id, value) values (2, 'Партнер');");
        DB::statement("insert into employee_position (id, value) values (3, 'Сотрудник');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_position');
    }
}
