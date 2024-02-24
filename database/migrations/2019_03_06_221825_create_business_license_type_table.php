<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessLicenseTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_license_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',256);
        });

        DB::statement("
            insert into business_license_type(id, name)
            values (1, 'Trading Licence'),
            (2, 'Industrial Licence'),
            (3, 'Service Licence'), 
            (4, 'E-Commerce License'), 
            (5, 'National Industrial License'), 
            (6, 'Innovation Licence') 
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_license_type');
    }
}
