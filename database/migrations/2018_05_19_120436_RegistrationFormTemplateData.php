<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistrationFormTemplateData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('registration_form_template', function ($table) {
            $table->string('name',256);
        });

        DB::statement('
            insert into parameter_group (id, name)
            values
            ( 1,\'Основная информация по компании\'),
            ( 2,\'Дополнительная информация по компании\'),
            ( 3,\'Контактные данные\');
        ');


        DB::statement('
            insert into parameter_type (id, name, data_type)
            values
            ( 1,\'Текст\', \'varchar(1024)\'),
            ( 2,\'Число\',\'decimal(8,2)\'),
            ( 3,\'Дата\',\'datetime\'),
            ( 4,\'Логический\',\'tinyint(1)\'),
            ( 5,\'Список\',\'int(10)\'),
            ( 6,\'Таблица\',\'\')          
        ');

        DB::statement('
            insert into counter_type(id, code, name)
            values(
                2,
                \'REGISTRATION_FORM\',
                \'Форма регистрации\'
            );
        ');

        DB::statement('
            insert into counter(id, counter_type_id, mask, length, increase, sequence)
            values
            ( 2,2,\'ФР-\',6,1,0);
        ');


        DB::statement('
            insert into registration_form_template(id, counter_type_id, name)
            values(
                1,
                2,
                \'Форма сбора данных для регистрации ТОО\'
            );
        ');

        DB::statement('
            insert into service_registration_form_template(service_id, registration_form_template_id)
            values 
            (1, 1),
            (2, 1);
        ');

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
