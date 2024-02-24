<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewServiceStatusesPrePaymentAndClientCheck extends Migration
{

    public function up()
    {
        DB::unprepared("
            INSERT INTO service_status(id, name) VALUES(8, 'Предоплата');
            INSERT INTO service_status(id, name) VALUES(9, 'Проверка клиента');
            INSERT INTO ilicense.translation (translation_attribute_id, language_id, pk_value, value) VALUES (18, 2, 8, 'Prepayment');
            INSERT INTO ilicense.translation (translation_attribute_id, language_id, pk_value, value) VALUES (18, 2, 9, 'Client check');
        ");

        Schema::table('service_status',function (Blueprint $table){
            $table->unsignedInteger('status_order')->nullable();
        });

        DB::unprepared("
            update service_status
            set
                status_order = Id * 100;
            
            update service_status
            set
                status_order = 120
            where id = 8;            
            
            update service_status
            set
                status_order = 110
            where id = 9;
            
            update service_status
            set
                status_order = 550
            where id = 2;
            
        ");

    }

    public function down()
    {
        DB::unprepared("
            delete from ilicense.translation where translation_attribute_id = 18 and pk_value in (8,9);
            delete from service_status where id in (8,9);
        ");

        Schema::table('service_status',function (Blueprint $table){
            $table->dropColumn('status_order');
        });
    }
}
