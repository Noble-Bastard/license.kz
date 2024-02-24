<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCatalogTypeData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("
            insert into catalog_node_type (id, value, isPhotoExist) values 
            (1, 'Тип 1(белая панель с иконкой)', true),
            (2, 'Тип 2(аккардион)', true),
            (3, 'Тип 3(аккардион - пункт)', false),
            (4, 'Тип 4(синия кнопка)', false),
            (5, 'Тип 5(выпадающее меню)', true),
            (6, 'Тип 6(белая панель с логотипом)', true),
            (7, 'Тип 7(синяя панель с фоном)', false),
            (8, 'Тип 8(панель с фоном)', true),
            (9, 'Тип 9(белая панель)', false),
            (10, 'Тип 10(синяя панель)', false)
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
