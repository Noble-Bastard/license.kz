<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_content_type', function (Blueprint $table){
            $table->smallIncrements('id');
            $table->string('name', 128);
        });

        Schema::table('news', function (Blueprint $table){
            $table->string('tags', 2048);
            $table->string('lead', 1024);
            $table->unsignedSmallInteger('news_content_type_id')->nullable();
            $table->unsignedInteger('language_id')->nullable();
        });

        Schema::table('news', function (Blueprint $table){
            $table->foreign('news_content_type_id', 'news_news_content_type_fk')->references('id')->on('news_content_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('language_id', 'news_language_fk')->references('id')->on('language')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
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
