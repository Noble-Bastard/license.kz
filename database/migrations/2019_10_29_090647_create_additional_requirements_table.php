<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_additional_requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('service_additional_requirements_type_id');
            $table->unsignedSmallInteger('license_type_id');
            $table->text('description');

            $table->softDeletes();

            $table->foreign('service_additional_requirements_type_id', 'service_additional_requirements_sart')
                ->on('service_additional_requirements_type')->references('id');
            $table->foreign('license_type_id', 'service_additional_requirements_license_type')
                ->on('license_type')->references('id');
        });

        DB::unprepared("
          insert into translation_entity(id, name)
          values(19, 'service_additional_requirements');
        ");

        DB::unprepared("
          insert into translation_attribute(translation_entity_id, name )
          values 
            (19, 'description');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_additional_requirements');
    }
}
