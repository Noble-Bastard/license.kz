<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceStepTableAndData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_step', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('service_id')->unsigned();
            $table->string('description', 1024);
            $table->smallInteger('step_number')->unsigned();
            $table->boolean('is_required');
            $table->smallInteger('execution_work_day_cnt')->unsigned();
            $table->smallInteger('counter_type_id')->unsigned();
            $table->boolean('is_active');
        });

        Schema::table('service_step', function(Blueprint $table)
        {
            $table->foreign('service_id', 'service_step_services_fk')->references('id')->on('service')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('counter_type_id', 'service_step_counter_type_fk')->references('id')->on('counter_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('service_step_required_document', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('service_step_id')->unsigned();
            $table->smallInteger('document_number')->unsigned();
            $table->string('description', 1024);
            $table->integer('document_template_id')->unsigned()->nullable();
        });

        Schema::table('service_step_required_document', function(Blueprint $table)
        {
            $table->foreign('service_step_id', 'service_step_required_document_service_step_fk')->references('id')->on('service_step')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('document_template_id', 'service_step_required_document_document_fk')->references('id')->on('document')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('service_step_cost_hist', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('service_step_id')->unsigned();
            $table->decimal('cost');
            $table->smallInteger('currency_id');
            $table->integer('created_by')->unsigned()->nullable();;
            $table->timestamp('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('service_step_cost_hist', function(Blueprint $table)
        {
            $table->foreign('service_step_id', 'service_step_cost_hist_service_step_fk')->references('id')->on('service_step')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('created_by', 'service_step_cost_hist_created_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('currency_id', 'service_step_cost_hist_currency_fk')->references('id')->on('currency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('service_step_result', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('service_step_id')->unsigned();
            $table->string('description', 1024);
        });

        Schema::table('service_step_result', function(Blueprint $table)
        {
            $table->foreign('service_step_id', 'service_step_result_service_step_fk')->references('id')->on('service_step')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });


        DB::statement('
            insert into counter_type(id, code, name)
            values(
                1,
                \'GENERAL_COUNTER\',
                \'Базовый счетчик\'
            );
        ');

        DB::statement('
            insert into counter(id, counter_type_id, mask, length, increase, sequence)
            values
            ( 1,1,\'УСЛ-\',6,1,0);
        ');

        //(1) ТОО_УЧ_ФЛ_РК_ДИР_РК
        DB::statement('
            insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
            values
            ( 1,1,\'Регистрация ТОО\',1,true,1,1,true);
        ');

        DB::statement('
            insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
            values
            ( 1,1,\'Копия удостоверения личности учредителя\',null),
            ( 1,2,\'Копия удостоверения личности директора\',null),
            ( 1,3,\'Заполненная форма по регистрации ТОО\',null);
        ');

        DB::statement('
            insert into service_step_result (service_step_id, description)
            values
            ( 1,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов\'),
            ( 1,\'Печать компании\'),
            ( 1,\'ЭЦП (Электронно-Цифровая Подпись) на компанию\');
        ');


        DB::statement('
            insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
            values
            ( 1,20000,1,null,\'2018-05-01\');
        ');

        //(2) ТОО_УЧ_ЮЛ_ЕВРАЗЭС_ДИР_РК
        DB::statement('
            insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
            values
            ( 2,2,\'Получение Индивидуального Идентификационного Номера (ИИН) и Электронно-цифровой подписи (ЭЦП)  на директора юридического лица учредителя страны-участника ЕВРАЗЭС\',1,true,3,1,true),
            ( 3,2,\'Получение Бизнес Идентификационного Номера (БИН) и ЭЦП на юридическое лицо – учредителя страны-участника ЕВРАЗЭС\',2,true,3,1,true),
            ( 4,2,\'Регистрация ТОО\',3,true,3,1,true);
        ');

        DB::statement('
            insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
            values
            ( 2,1,\'Копия паспорта директора юридического лица-учредителя, с нотариально заверенным переводом на русский/казахский язык\',null),
            ( 2,2,\'Нотариально заверенная доверенность на получение ИИН и ЭЦП установленного образца на представителя Ipravo\',null),
            ( 3,1,\'Выписка из торгового реестра либо его аналога (ЕГРЮЛ)\',null),
            ( 3,2,\'Копии учредительных документов: 
-Устав;
-Учредительный договор;
-Решение учредителя/Протокол общего собрания учредителей;
-Приказ на директора; 
-Документ подтверждающей государственную регистрацию в стране резидентства; 
-Документ подтверждающий постановку на налоговый учет в стране резидентства) с нотариально заверенным переводом на казахский/русский язык;
\',null),
            ( 3,3,\'Копия паспорта директора юридического лица-учредителя, с нотариально заверенным переводом на русский/казахский язык\',null),
            ( 3,4,\'Доверенность на получение БИН и ЭЦП от юридического лица – учредителя компании установленного образца на представителя Ipravo\',null),
            ( 4,1,\'Индивидуальный Идентификационный Номер (ИИН)  и Электронно-цифровая подпись (ЭЦП) на каждого из учредителей\',null),
            ( 4,2,\'Копия паспорта директора юридического лица-учредителя, с нотариально заверенным переводом на русский/казахский язык\',null),
            ( 4,3,\'Удостоверение личности директора гражданина Республики Казахстан\',null),
            ( 4,4,\'Заполненная форма по регистрации ТОО\',null);
        ');

        DB::statement('
            insert into service_step_result (service_step_id, description)
            values
            ( 2,\'Получение свидетельства ИИН на директора гражданина ЕВРАЗЭС\'),
            ( 3,\'Получение свидетельства БИН на юридическое лицо - учредителя\'),
            ( 4,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов\'),
            ( 4,\'Печать компаниив\'),
            ( 4,\'ЭЦП (Электронно-Цифровая Подпись) на компанию\');
        ');


        DB::statement('
            insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
            values
            ( 2,30000,1,null,\'2018-05-01\'),
            ( 3,50000,1,null,\'2018-05-01\'),
            ( 4,70000,1,null,\'2018-05-01\');
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('service_step_result')) {
            Schema::drop('service_step_result');
        }

        if (Schema::hasTable('service_step_cost_hist')) {
            Schema::drop('service_step_cost_hist');
        }

        if (Schema::hasTable('service_step_required_document')) {
            Schema::drop('service_step_required_document');
        }

        if (Schema::hasTable('service_step')) {
            Schema::drop('service_step');
        }

    }
}
