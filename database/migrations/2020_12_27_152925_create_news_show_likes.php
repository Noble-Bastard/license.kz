<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsShowLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_activity_type', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 128);
        });

        \Illuminate\Support\Facades\DB::statement("
            insert into news_activity_type (id, name) values
            (1, 'Просмотры'),
            (2, 'Лайки');
        ");

        Schema::create('news_activity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ipAddress('ip');
            $table->unsignedInteger('news_id');
            $table->unsignedSmallInteger('news_activity_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_activity');
        Schema::dropIfExists('news_activity_type');
    }
}
