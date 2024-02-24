<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class ServiceTranslate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service', function (Blueprint $table){
            $table->string('name', 1024)->change();
            $table->string('description', 4096)->change();
            $table->string('comment', 4096)->change();
        });

        DB::unprepared("
          insert into translation_entity(id, name)
          values
            (8, 'service'),
            (9, 'service_step'),
            (10, 'service_step_required_document'),
            (11, 'service_step_result'),
            (12, 'service_status')
            ;
        ");

        DB::unprepared("
          insert into translation_attribute(id, translation_entity_id, name )
          values 
            (11, 8, 'code'),
            (12, 8, 'name'),
            (13, 8, 'description'),
            (14, 8, 'comment'),
            (15, 9, 'description'),
            (16, 10, 'description'),
            (17, 11, 'description'),
            (18, 12, 'name')
          ;
        ");

        DB::unprepared("
          insert into translation(translation_attribute_id, language_id, pk_value, value )
          values            
            (18, 2, 1, 'Creation'),
            (18, 2, 2, 'Payment'),
            (18, 2, 3, 'Data Collection'),
            (18, 2, 4, 'Verification'),
            (18, 2, 5, 'Service performance'),
            (18, 2, 6, 'Completed'),
            (18, 2, 7, 'Billed')
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
        //
    }
}
