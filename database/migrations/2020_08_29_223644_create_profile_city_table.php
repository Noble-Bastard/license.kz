<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_city', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('profile_id');
            $table->unsignedInteger('city_id');

            $table->foreign('profile_id', 'profile_city_profile_fk')->references('id')->on('profile')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('city_id', 'profile_city_city_fk')->references('id')->on('city')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_city');
    }
}
