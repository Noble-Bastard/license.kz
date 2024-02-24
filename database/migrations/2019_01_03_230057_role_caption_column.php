<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoleCaptionColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Table('role',function (Blueprint $table){
           $table->string('caption',32)->nullable();
        });

        DB::statement("
            update role
            set
              caption = case
                when  id = 1 then 'Администратор'
                when  id = 2 then 'Исполнитель'
                when  id = 3 then 'Клиент'
                when  id = 4 then 'Руководитель группы'
                when  id = 5 then 'Менеджер продаж'
                when  id = 6 then 'Куратор'
                when  id = 7 then 'Руководитель'
                when  id = 8 then 'Бухгалтер'
              end

        ");


        DB::unprepared("
          insert into translation_entity(id, name)
          values(2, 'role');
        ");

        DB::unprepared("
          insert into translation_attribute(id, translation_entity_id, name )
          values (3, 2, 'caption');
        ");

        DB::unprepared("
          insert into translation(translation_attribute_id, language_id, pk_value, value)
          values (3, 2, 1, 'Administrator'),
           (3, 2, 2, 'Executor'),
           (3, 2, 3, 'Client'),
           (3, 2, 4, 'Manager'),
           (3, 2, 5, 'SaleManager'),
           (3, 2, 6, 'Curator'),
           (3, 2, 7, 'Head'),
           (3, 2, 8, 'Accountant');        
        ");


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
