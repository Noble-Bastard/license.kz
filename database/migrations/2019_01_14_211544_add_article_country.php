<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArticleCountry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article', function (Blueprint $table){
            $table->smallInteger('country_id')->default(1);

            $table->foreign('country_id','article_country_fk')->references('id')->on('country');
        });

        DB::unprepared("
          insert into translation_entity(id, name)
          values(7, 'article');
        ");

        DB::unprepared("
          insert into translation_attribute(id, translation_entity_id, name )
          values 
            (10, 7, 'content')
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
