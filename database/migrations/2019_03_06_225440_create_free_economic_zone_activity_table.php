<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreeEconomicZoneActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_economic_zone_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('free_economic_zone_id');
            $table->unsignedInteger('business_activity_type_id');
        });

        Schema::table('free_economic_zone_activity', function (Blueprint $table) {
            $table->foreign('free_economic_zone_id','free_economic_zone_activity_free_economic_zone_fk')->references('id')->on('free_economic_zone');
            $table->foreign('business_activity_type_id','free_economic_zone_activity_fk')->references('id')->on('business_activity_type');
        });

        DB::statement("
            insert into free_economic_zone_activity(free_economic_zone_id, business_activity_type_id)
            values(1,1),
            (2,1),(2,2),(2,3),        
            (3,1),(3,2),(3,3),
            (4,2),
            (5,1),(5,2),
            (6,2),
            (7,2),
            (8,2),
            (9,2),
            (10,2),
            (11,1),(11,2),(11,3),
            (12,1),(12,2),(12,3),
            (13,1),(13,2),(13,3),
            (14,1),(14,2),(14,3),
            (15,2),
            (16,1),(16,2),(16,3),
            (17,1),(17,2),(17,3),
            (18,1),(18,2),
            (19,1),(19,2),(19,3)
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('free_economic_zone_activity');
    }
}
