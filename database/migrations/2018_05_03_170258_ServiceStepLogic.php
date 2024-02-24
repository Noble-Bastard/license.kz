<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceStepLogic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('service')) {
            Schema::table('messages', function(Blueprint $table)
            {
                $table->dropForeign('messages_services_fk');
            });

            Schema::drop('service');
        }

        Schema::create('service', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->smallInteger('service_thematic_group_id')->unsigned();
            $table->string('code', 64);
            $table->string('name', 256);
            $table->string('description', 1024);
            $table->string('comment', 1024)->nullable();
            $table->smallInteger('execution_days_from')->unsigned();
            $table->smallInteger('execution_days_to')->unsigned();
            $table->boolean('is_active');
            $table->date('service_start_date');
            $table->date('service_end_date')->nullable();
        });

        Schema::table('service', function ($table) {
            $table->foreign('service_thematic_group_id','service_service_thematic_group_fk')->references('id')->on('service_thematic_group');
        });

        Schema::table('messages', function(Blueprint $table)
        {
            $table->foreign('services_id', 'messages_services_fk')->references('id')->on('service')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });


        DB::statement('                    
            delete from service_thematic_group where id = 3;                                                                 
        ');

        DB::statement('                    
            insert into service_thematic_group (id, service_category_id, name, description) 
            values
              (3, 1, \'Регистрация бизнеса\', \'Регистрация бизнеса\');                                                   
        ');

        DB::statement('                    
            insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
            values
              (
                  1, 3,  
                  \'ТОО_УЧ_ФЛ_РК_ДИР_РК\',
                  \'Регистрации ТОО в Казахстане (учредители и директор граждане РК) \' ,
                  \'Регистрации компании в Казахстане в организационно-правовой форме - Товарищество с ограниченной ответственностью (далее – «ТОО») с учредителем(-ями) гражданином(-ами) Республики Казахстан и директором гражданином Республики Казахстан\',
                  1,
                  1,
                  true,
                  \'2018-01-01\',
                  null,
                  null
              ),
              (
                  2, 3, 
                  \'ТОО_УЧ_ЮЛ_ЕВРАЗЭС_ДИР_РК\',
                  \'Регистрации ТОО в Казахстане (учредители страны-участника ЕВРАЗЭС и директор гражданин РК)\',
                  \'Регистрации компании в Казахстане в организационно-правовой форме - Товарищество с ограниченной ответственностью (далее – «ТОО») с учредителем(-ями) юридическим лицом страны-участника ЕВРАЗЭС и директором гражданином Республики Казахстан\',
                  9,
                  9,
                  true,
                  \'2018-01-01\',
                  null,
                  \'в ЕВРАЗЭС входят следующие страны: Россия, Беларусь, Армения, Кыргызстан, а также Казахстан\'
              );
        ');

        DB::statement('
            create or replace view service_ext
            as
            select
               s.id,
               s.description,
               s.is_active,
               s.name,
               s.code,
               s.service_start_date,
               s.service_end_date,
               s.service_thematic_group_id,
               stg.name service_thematic_group_name,
               s.execution_days_from,
               s.execution_days_to
            from service s
               left join service_thematic_group stg
               on stg.id = s.service_thematic_group_id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if (Schema::hasTable('service')) {
        Schema::table('messages', function(Blueprint $table)
        {
            $table->dropForeign('messages_services_fk');
        });


            Schema::drop('service');
        }


        Schema::create('service', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->smallInteger('service_thematic_group_id')->unsigned();
            $table->string('name', 256);
            $table->string('description', 1024);
            $table->string('required_document', 2048);
            $table->smallInteger('time_of_service_execution_from')->unsigned();
            $table->smallInteger('time_of_service_execution_to')->unsigned();
            $table->boolean('is_active');
            $table->smallInteger('counter_type_id')->unsigned();
        });

        Schema::table('service', function ($table) {
            $table->foreign('service_thematic_group_id','service_service_thematic_group_fk')->references('id')->on('service_thematic_group');
        });

        Schema::table('service', function ($table) {
            $table->foreign('counter_type_id','service_counter_type_fk')->references('id')->on('counter_type');
        });

        Schema::table('messages', function(Blueprint $table)
        {
            $table->foreign('services_id', 'messages_services_fk')->references('id')->on('service')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        DB::statement('
            create or replace view service_ext
            as
            select
               s.id,
               s.counter_type_id,
               ct.name counter_type_name,
               s.description,
               s.is_active,
               s.name,
               s.required_document,
               s.service_thematic_group_id,
               stg.name service_thematic_group_name,
               s.time_of_service_execution_from,
               s.time_of_service_execution_to
            from service s
               left join counter_type ct
               on ct.id = s.counter_type_id
               left join service_thematic_group stg
               on stg.id = s.service_thematic_group_id
        ');
    }
}
