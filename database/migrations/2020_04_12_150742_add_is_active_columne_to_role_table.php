<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddIsActiveColumneToRoleTable extends Migration
{

    public function up()
    {

        Schema::table('role', function (Blueprint $table) {
            $table->boolean('is_active')->nullable();
        });

        DB::unprepared("
            update role 
            set 
                is_active = 1;
        ");

        DB::unprepared("
            UPDATE role SET caption = 'Администратор' WHERE id = 1;
            UPDATE role SET caption = 'Специалист' WHERE id = 2;
            UPDATE role SET caption = 'Клиент' WHERE id = 3;
            UPDATE role SET caption = 'Клиент менеджер' WHERE id = 4;
            UPDATE role SET caption = 'Менеджер продаж' WHERE id = 5;
            UPDATE role SET caption = 'Куратор', is_active = 0 WHERE id = 6;
            UPDATE role SET caption = 'Руководитель' WHERE id = 7;
            UPDATE role SET caption = 'Бухгалтер' WHERE id = 8;
            UPDATE role SET caption = 'Партнер' WHERE id = 9;
            UPDATE role SET caption = 'Агент' WHERE id = 10;
        ");
    }


    public function down()
    {

    }
}
