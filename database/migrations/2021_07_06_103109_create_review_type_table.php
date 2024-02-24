<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_type', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 128);
        });

        \Illuminate\Support\Facades\DB::statement("
            insert into review_type (id, name) values
            (1, 'Видео'),
            (2, 'Бумажный');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_type');
    }
}
