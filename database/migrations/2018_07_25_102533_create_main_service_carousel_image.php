<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainServiceCarouselImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_service_carousel_image', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('main_service_carousel_id')->unsigned();
            $table->integer('display_dimension_type')->unsigned();
            $table->binary('img');
        });

        Schema::table('main_service_carousel_image', function (Blueprint $table){
            $table->foreign('main_service_carousel_id','main_service_carousel_image_main_service_carousel_fk')->references('id')->on('main_service_carousel');
            $table->foreign('display_dimension_type','main_service_carousel_image_display_dimension_type_fk')->references('id')->on('display_dimension_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('main_service_carousel_image');
    }
}
