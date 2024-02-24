<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTagsList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->unsignedSmallInteger('news_content_type_id');
            $table->unsignedInteger('language_id');
        });

        Schema::table('news_tags', function (Blueprint $table){
            $table->foreign('news_content_type_id', 'news_tags_news_content_type_fk')->references('id')->on('news_content_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('language_id', 'news_tags_language_fk')->references('id')->on('language')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_tags');
    }
}
