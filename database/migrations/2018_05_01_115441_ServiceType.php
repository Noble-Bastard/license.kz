<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_status', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned();
            $table->string('name', 32);
        });

        DB::statement('                    
            insert into service_status (id, name) 
            values
              (1, \'Создание\'),
              (2, \'Оплата\'),
              (3, \'Сбор данных\'),
              (4, \'Проверка\'),
              (5, \'Выполнение услуги\');                       
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('service_status');
    }
}
