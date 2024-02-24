<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActicleType01 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
                insert into article_type(id, name)
                values
                  (1, 'Контакты'),
                  (2, 'Основная страница'),
                  (3, 'О нас');
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
                delete from article_type where id in (1,2,3);
            ");
    }
}
