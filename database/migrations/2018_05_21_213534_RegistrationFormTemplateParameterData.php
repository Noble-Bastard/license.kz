<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistrationFormTemplateParameterData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('registration_form_parameter_template', function(Blueprint $table)
        {
            $table->integer('registration_form_group_template_id')->unsigned()->nullable()->change();
        });

        Schema::table('parameter_text_setting', function(Blueprint $table)
        {
            $table->string('validation_mask',512)->nullable()->change();
        });


        if (Schema::hasTable('registration_form_parameter_template_table_structure')) {
            Schema::drop('registration_form_parameter_template_table_structure');
        }

        Schema::create('registration_form_parameter_template_table_structure', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('registration_form_parameter_template_table_id')->unsigned();
            $table->integer('column_parameter_template_id')->unsigned();
        });


        Schema::table('registration_form_parameter_template_table_structure', function ($table) {
            $table->foreign('registration_form_parameter_template_table_id','registration_form_parameter_template_table_strct_tbl_fk')->references('id')->on('registration_form_parameter_template_table');
            $table->foreign('column_parameter_template_id','registration_form_parameter_template_table_strct_col_fk')->references('id')->on('registration_form_parameter_template');

        });


        DB::statement('
            insert into optionset_type (id, name)
            values
            ( 1,\'Логический\'),
            ( 2,\'Статус субъекта бизнеса\'),
            ( 3,\'Налоговый режим\'),
            ( 4,\'Печать\')
        ');

        DB::statement('
            insert into optionset_value_template (optionset_type_id, optionset_id, optionset_value, is_default)
            values
            ( 1, 1, \'Да\', false),
            ( 1, 2, \'Нет\', true),
            ( 2, 1, \'Малый\', true),
            ( 2, 2, \'Средний\', false),
            ( 2, 3, \'Крупный\', false),
            ( 3, 1, \'Упрощенный\', false),
            ( 3, 2, \'Общеустановленный\', true),
            ( 4, 1, \'Автомат\', true),
            ( 4, 2, \'С логотипом\', false)
        ');

        DB::statement('
            insert into registration_form_group_template (id, registration_form_template_id, parameter_group_id, order_number)
            values
            ( 1, 1, 1, 10),
            ( 2, 1, 2, 20),
            ( 3, 1, 3, 30)
        ');


        DB::statement('
            insert into parameter_type (id, name, data_type)
            values
            ( 7,\'Email\', \'varchar(64)\'),
            ( 8,\'Телефон\',\'varchar(64)\')
        ');


        DB::statement('
            insert into parameter_text_setting (parameter_type_id, validation_mask, default_value)
            values
            ( 7,\'FILTER_VALIDATE_EMAIL\', null),
            ( 8,\'/^[+]7[(][0-9]{3,4}[)][0-9]{7}$/\', null)
        ');



        DB::statement('
            insert into parameter_number_setting (parameter_type_id, min_value, max_value, default_value, round_type)
            values
            ( 2, 0, null, 0, 2)
        ');

        DB::statement('
            insert into parameter_datetime_setting (parameter_type_id, date_format, default_value)
            values
            ( 3, \'Y-m-d H:i:s\', null)
        ');

        DB::statement('
            insert into registration_form_parameter_template (id, registration_form_group_template_id, parameter_type_id, caption, is_active, comment, order_number, optionset_type_id)
            values
            ( 1, 1, 5, \'Необходима ли постановка на НДС?\', true, null, 10, 1),
            ( 2, 1, 5, \'Статус субъекта бизнеса?\', true, null, 20, 2),
            ( 3, 1, 5, \'Налоговый режим\', true, null, 30, 3),
            ( 4, 1, 5, \'Налоговый криптоключ\', true, null, 40, 1),
            ( 5, 1, 5, \'ЭЦП\', true, null, 50, 1),
            ( 6, 1, 5, \'Учредительные документы\', true, null, 60, 1),
            ( 7, 1, 5, \'Сопровождение открытия банковского счета\', true, null, 70, 1),
            ( 8, 1, 5, \'Первичная сдача стат отчетности\', true, null, 70, 1),
            ( 9, 1, 5, \'Печать\', true, null, 80, 4),
            ( 10, 1, 5, \'Учредительные документы\', true, \'Если печать с логотипом, следует  отправить вместе с данной формой логотип на регистрацию на info@ipravo.kz  в формате Corel Drow-12\', 90, 1),            
            ( 11, 2, 1, \'Наименование\', true, null, 100, null),
            ( 12, 2, 1, \'Местонахождение (предполагаемый юридический адрес)\', true, null, 110, null),
            ( 13, 2, 1, \'Размер уставного капитала\', true, null, 120, null),
            ( 14, 2, 1, \'Основные виды деятельности\', true, null, 130, null),
            ( 15, 2, 6, \'Учредители\', true, null, 140, null),            
            ( 16, 3, 8, \'Телефон\', true, null, 150, null),
            ( 17, 3, 7, \'Эл.почта\', true, null, 160, null),
            ( 18, 3, 1, \'Подпись\', true, null, 170, null),
            ( 19, null, 1, \'ФИО директора\', true, null, 10, null),
            ( 20, null, 1, \'Удостоверение личности или загран.пспорт (№, кем и когда выдан)\', true, null, 20, null),
            ( 21, null, 1, \'Место проживания\', true, null, 30, null);            
        ');

        DB::statement('
            insert into registration_form_parameter_template_table (id, registration_form_parameter_template_id, table_caption)
            values
            ( 1, 15, \'Учредители\')
        ');


        DB::statement('
            insert into registration_form_parameter_template_table_structure (registration_form_parameter_template_table_id, column_parameter_template_id)
            values
            ( 1, 19),
            ( 1, 20),
            ( 1, 21)        
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
