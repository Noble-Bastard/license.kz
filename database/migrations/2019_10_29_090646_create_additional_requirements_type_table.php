<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class CreateAdditionalRequirementsTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_additional_requirements_type', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 128);

            $table->softDeletes();
        });

        DB::statement("
            insert into service_additional_requirements_type (name) values
            ('Оборудование'),
            ('Специалисты'),
            ('Транспорт'),
            ('ПО'),
            ('Прочее')
        ");

        Schema::table('translation_entity', function (Blueprint $table){
            $table->string('name', 256)->change();
        });

        DB::unprepared("
          insert into translation_entity(id, name)
          values(18, 'service_additional_requirements_type');
        ");

        DB::unprepared("
          insert into translation_attribute(translation_entity_id, name )
          values 
            (18, 'name');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_additional_requirements_type');
    }
}
