<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_region', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',256);
            $table->smallInteger('country_id')->nullable();
        });

        Schema::table('country_region', function (Blueprint $table) {
            $table->foreign('country_id','country_region_country_fk')->references('id')->on('country');
        });


        DB::statement("
            insert into country_region(id, name, country_id)
            values (1, 'Дубай', 3),
            (2, 'Шарджа', 3),
            (3, 'Рас-Эль-Хейма', 3),
            (4, 'Фуджейра', 3),
            (5, 'Аджман', 3),
            (6, 'Умм-Аль-Кувейн', 3),
            (7, 'Абу-Даби', 3)
        ");
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_region');
    }
}
