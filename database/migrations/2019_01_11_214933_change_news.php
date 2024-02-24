<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table){
            $table->smallInteger('country_id')->default(1);

            $table->foreign('country_id','news_country_fk')->references('id')->on('country');
        });

        DB::unprepared("
          insert into translation_entity(id, name)
          values(6, 'news');
        ");

        DB::unprepared("
          insert into translation_attribute(id, translation_entity_id, name )
          values 
            (8, 6, 'header'),
            (9, 6, 'content')
          ;
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
