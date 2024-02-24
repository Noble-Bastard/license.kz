<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewsCommentChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('news_comments');
        DB::statement('
            drop view news_comments_ext;
        ');

        Schema::create('news_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('news_id');
            $table->unsignedInteger('parent_comment_id')->nullable();
            $table->text('comment');
            $table->dateTime('create_date')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));
            $table->smallInteger('level');
            $table->unsignedInteger('user_id');
        });


        Schema::table('news_comments', function (Blueprint $table) {
            $table->foreign('news_id', 'news_comments_news_fk')->references('id')->on('news');
        });

        Schema::table('news_comments', function (Blueprint $table) {
            $table->foreign('parent_comment_id', 'news_comments_news_commnets_fk')->references('id')->on('news_comments');
        });

        Schema::table('news_comments', function(Blueprint $table)
        {
            $table->foreign('user_id', 'news_comments_user_fk')->references('id')->on('profile');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_comments');
    }
}
