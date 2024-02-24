<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewsComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('news_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('news_id');
            $table->unsignedInteger('parent_comment_id');
            $table->string('comment',32);
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->smallInteger('level');
        });


        Schema::table('news_comments', function(Blueprint $table)
        {
            $table->foreign('news_id', 'news_comments_news_fk')->references('id')->on('news');
        });

        Schema::table('news_comments', function(Blueprint $table)
        {
            $table->foreign('parent_comment_id', 'news_comments_news_commnets_fk')->references('id')->on('news_comments');
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
        Schema::dropIfExists('news_comments');
    }
}
