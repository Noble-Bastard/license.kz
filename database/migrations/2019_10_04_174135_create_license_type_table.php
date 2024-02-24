<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_type', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 256);
        });

        DB::unprepared("
          insert into translation_entity(id, name)
          values(17, 'license_type');
        ");

        DB::unprepared("
          insert into translation_attribute(translation_entity_id, name )
          values 
            (17, 'name')
          ;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('license_type');
    }
}
