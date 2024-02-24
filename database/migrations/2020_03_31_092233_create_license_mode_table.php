<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseModeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_type', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 64);
        });

        DB::unprepared("
          insert into translation_entity(id, name)
          values(22, 'service_type');
        ");

        DB::unprepared("
          insert into translation_attribute(translation_entity_id, name )
          values
            (22, 'name')
          ;
        ");

        \Illuminate\Support\Facades\DB::unprepared("
            insert into service_type (id, name) values (1, 'Лицензии'), (2, 'Разрешения'), (3, 'Уведомления');
        ");


        Schema::table('service',function (Blueprint $table){
            $table->unsignedSmallInteger('service_type_id')->nullable();

            $table->foreign('service_type_id', 'service_service_type_fk')
                ->references('id')->on('service_type');
        });

        DB::unprepared("
            update service
            set
                service_type_id = 1;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('license_mode');
    }
}
