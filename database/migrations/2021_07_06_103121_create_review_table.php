<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('review_type_id');
            $table->string('company_name', 2048)->nullable();
            $table->string('company_description', 2048)->nullable();
            $table->string('youtube_url', 2048)->nullable();
            $table->string('youtube_preview', 2048)->nullable();
            $table->string('file_path', 2048)->nullable();
            $table->boolean('is_publish')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review');
    }
}
