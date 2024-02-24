<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceCategoryCountryColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_category', function (Blueprint $table){
            $table->smallInteger('country_id')->nullable();
        });

        Schema::table('service_category', function(Blueprint $table)
        {
            $table->foreign('country_id', 'service_category_country_fk')->references('id')->on('country')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });


        DB::statement("
            update service_category
            set
              country_id = 1
            where country_id is null;
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_category', function (Blueprint $table){
            $table->dropColumn('country_id');
        });
    }
}
