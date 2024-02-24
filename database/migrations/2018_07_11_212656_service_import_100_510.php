<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceImport100510 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

            DB::beginTransaction();


            DB::statement('                    
                insert into currency (id, code, name) 
                values
                  (2, \'USD\', \'USD\');                       
            ');

            DB::statement('                    
                insert into currency (id, code, name) 
                values
                  (3, \'RUB\', \'RUB\');                       
            ');

            DB::statement('
                delete from service_step_required_document
                where service_step_id in(
                  select id
                  from service_step
                  where service_id in (
                    select id
                    from service
                    where code in (\'100\',\'110\',\'120\',\'130\',\'140\',\'150\',\'160\',\'170\',\'180\',\'190\',\'200\',\'210\',\'220\',\'230\',\'240\',\'250\',\'260\',\'270\',\'280\',\'290\')
                  )
                );
            ');

            DB::statement('
                delete from service_step_result
                where service_step_id in(
                  select id
                  from service_step
                  where service_id in (
                    select id
                    from service
                    where code in (\'100\',\'110\',\'120\',\'130\',\'140\',\'150\',\'160\',\'170\',\'180\',\'190\',\'200\',\'210\',\'220\',\'230\',\'240\',\'250\',\'260\',\'270\',\'280\',\'290\')
                  )
                );
            ');


            DB::statement('
                delete from service_step_cost_hist
                where service_step_id in(
                  select id
                  from service_step
                  where service_id in (
                    select id
                    from service
                    where code in (\'100\',\'110\',\'120\',\'130\',\'140\',\'150\',\'160\',\'170\',\'180\',\'190\',\'200\',\'210\',\'220\',\'230\',\'240\',\'250\',\'260\',\'270\',\'280\',\'290\')
                  )
                );
            ');

            DB::statement('
                delete from service_step
                where service_id in (
                  select id from service
                  where code in (\'100\',\'110\',\'120\',\'130\',\'140\',\'150\',\'160\',\'170\',\'180\',\'190\',\'200\',\'210\',\'220\',\'230\',\'240\',\'250\',\'260\',\'270\',\'280\',\'290\')
                );
            ');

            DB::statement('
                delete  from service
                where code in (\'100\',\'110\',\'120\',\'130\',\'140\',\'150\',\'160\',\'170\',\'180\',\'190\',\'200\',\'210\',\'220\',\'230\',\'240\',\'250\',\'260\',\'270\',\'280\',\'290\');  
            ');

            DB::statement('
                delete from service_thematic_group where id > 3;  
            ');

            DB::statement('
                delete from service_category where id > 9;  
            ');



            DB::statement('
                insert into service_category(id, name, description)
                values
                  (10, \'Корпоративное Право\', \'Корпоративное Право\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (4, 10, \'Регистрация бизнеса - Иные услуги в области корпоративного права\', \'Регистрация бизнеса - Иные услуги в области корпоративного права\');
            ');
            
            //service - 100
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      3, 4,  
                      \'100\',
                      \'Получение Индивидуального Идентификационного Номера (ИИН) и Электронно-цифровой подписи (ЭЦП)  для граждан физ.лиц стран-участников ЕВРАЗЭС\' ,
                      \'Получение Индивидуального Идентификационного Номера (ИИН) и Электронно-цифровой подписи (ЭЦП)  для граждан физ.лиц стран-участников ЕВРАЗЭС\',
                      3,
                      6,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (5,3,\'Получение ИИН\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (5,1,\'Нотариально заверенная копия паспорта учредителя гражданина страны-участника ЕВРАЗЭС, с нотариально заверенным переводом на русский и казахский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (5,2,\'
            Нотариально заверенная доверенность от учредителя на получение ИИН и ЭЦП установленного образца  на представителя Ipravo\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (5,\'Получение свидетельства ИИН\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (5,25000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (6,3,\'Получение ЭЦП\',2,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (6,1,\'Нотариально заверенная копия паспорта учредителя гражданина страны-участника ЕВРАЗЭС, с нотариально заверенным переводом на русский и казахский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (6,2,\'
            Нотариально заверенная доверенность от учредителя на получение ИИН и ЭЦП установленного образца  на представителя Ipravo\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (6,\'Получение ЭЦП на гражданина ЕВРАЗЭС\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (6,10000,1,null,\'2018-01-01\');
            ');
            
            //service - 110
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      4, 4,  
                      \'110\',
                      \'Получение Индивидуального Идентификационного Номера (ИИН) и Электронно-цифровой подписи (ЭЦП)  для (иностранных)  граждан физ.лиц нерезидентов\' ,
                      \'Получение Индивидуального Идентификационного Номера (ИИН) и Электронно-цифровой подписи (ЭЦП)  для (иностранных)  граждан физ.лиц нерезидентов\',
                      3,
                      6,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (7,4,\'Получение ИИН\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (7,1,\'Апостилированная/Легализованаая доверенность от учредителя на получение ИИН и ЭЦП установленного образца  на представителя Ipravo.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (7,2,\'Апостилированная/Легализованаая доверенность от учредителя на получение ИИН и ЭЦП установленного образца  на представителя Ipravo\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (7,\'Получение свидетельства ИИН\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (7,25000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (8,4,\'Получение ЭЦП\',2,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (8,1,\'Апостилированная/Легализованаая доверенность от учредителя на получение ИИН и ЭЦП установленного образца  на представителя Ipravo.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (8,2,\'Апостилированная/Легализованаая доверенность от учредителя на получение ИИН и ЭЦП установленного образца  на представителя Ipravo\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (8,\'Получение ЭЦП на учредителя и директора (иностранного) гражданина нерезидента\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (8,10000,1,null,\'2018-01-01\');
            ');
            
            //service - 120
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      5, 4,  
                      \'120\',
                      \'Получение Бизнес Идентификационного Номера (БИН) и Электронно-цифровой подписи (ЭЦП)  для граждан физ.лиц стран-участников ЕВРАЗЭС\' ,
                      \'Получение Бизнес Идентификационного Номера (БИН) и Электронно-цифровой подписи (ЭЦП)  для граждан физ.лиц стран-участников ЕВРАЗЭС\',
                      3,
                      6,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (9,5,\'Получение БИН\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (9,1,\'Выписка из торгового реестра либо его аналога (ЕГРЮЛ) с нотариально заверенным переводом на казахский и русский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (9,2,\'
            Копии учредительных документов: 
            -Устав;
            -Учредительный договор; 
            -Решение учредителя/Протокол общего собрания учредителей; 
            -Приказ на директора; 
            -Документ подтверждающий постановку на налоговый учет в стране резидентства\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (9,3,\'
            Копия паспорта директора гражданина ЕВРАЗЭС, юридического лица с нотариально заверенным переводом на казахский и русский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (9,4,\'
             Доверенность от юридического лица – учредителя компании установленного образца на представителя Ipravo\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (9,\'Получение свидетельства БИН\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (9,30000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (10,5,\'Получение ЭЦП\',2,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (10,1,\'Выписка из торгового реестра либо его аналога (ЕГРЮЛ) с нотариально заверенным переводом на казахский и русский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (10,2,\'
            Копии учредительных документов: 
            -Устав;
            -Учредительный договор; 
            -Решение учредителя/Протокол общего собрания учредителей; 
            -Приказ на директора; 
            -Документ подтверждающий постановку на налоговый учет в стране резидентства\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (10,3,\'
            Копия паспорта директора гражданина ЕВРАЗЭС, юридического лица с нотариально заверенным переводом на казахский и русский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (10,4,\'
             Доверенность от юридического лица – учредителя компании установленного образца на представителя Ipravo\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (10,\'Получение ЭЦП на юридическое лицо - учредителя\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (10,15000,1,null,\'2018-01-01\');
            ');
            
            //service - 130
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      6, 4,  
                      \'130\',
                      \'Получение Бизнес Идентификационного Номера (БИН) и Электронно-цифровой подписи (ЭЦП)  для (иностранных)  граждан юр.лиц нерезидентов\' ,
                      \'Получение Бизнес Идентификационного Номера (БИН) и Электронно-цифровой подписи (ЭЦП)  для (иностранных)  граждан юр.лиц нерезидентов\',
                      3,
                      6,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (11,6,\'Получение БИН\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (11,1,\'Апостилированные/Легализованые копии учредительных документов (иностранного) юридичекого лица нерезидента, с нотариально заверенным переводом на русский и казахский язык:                                                                                                                                                    - Документ подтверждающей государственную регистрацию в стране резидентства; 
            -Устав;
            -Учредительный договор (при наличии); 
            -Решение учредителя/Протокол общего собрания учредителей; 
            -Приказ на директора; 
            -Документ подтверждающий постановку на налоговый учет в стране резидентства с нотариально заверенным переводом на казахский и русский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (11,2,\'
            Апостилированная/Легализованаая копия паспорта директора юридического лица с нотариально заверенным переводом на казахский и русский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (11,3,\'Апостилированная/Легализованаая Доверенность от юридического лица – учредителя компании установленного образца на представителя Ipravo с нотариально заверенным переводом на русский и казахский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (11,\'Получение свидетельства БИН для гражданина физ.лица стран-участников ЕВРАЗЭС\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (11,30000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (12,6,\'Получение ЭЦП\',2,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (12,1,\'Апостилированные/Легализованые копии учредительных документов (иностранного) юридичекого лица нерезидента, с нотариально заверенным переводом на русский и казахский язык:                                                                                                                                                    - Документ подтверждающей государственную регистрацию в стране резидентства; 
            -Устав;
            -Учредительный договор (при наличии); 
            -Решение учредителя/Протокол общего собрания учредителей; 
            -Приказ на директора; 
            -Документ подтверждающий постановку на налоговый учет в стране резидентства с нотариально заверенным переводом на казахский и русский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (12,2,\'
            Апостилированная/Легализованаая копия паспорта директора юридического лица с нотариально заверенным переводом на казахский и русский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (12,3,\'Апостилированная/Легализованаая Доверенность от юридического лица – учредителя компании установленного образца на представителя Ipravo с нотариально заверенным переводом на русский и казахский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (12,\'Получение ЭЦП для гражданина физ.лица стран-участников ЕВРАЗЭС\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (12,15000,1,null,\'2018-01-01\');
            ');
            
            //service - 140
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      7, 4,  
                      \'140\',
                      \'Предоставление юридического адреса\' ,
                      \'Предоставление юридического адреса\',
                      2,
                      2,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (13,7,\'Предоставление юридического адреса\',1,true,2,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (13,1,\'Копии учредительных документов юридического лица\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (13,2,\'Реквизиты юридического лица\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (13,\'Предоставление юридического адреса\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (13,30000,1,null,\'2018-01-01\');
            ');
            
            //service - 150
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      8, 4,  
                      \'150\',
                      \'Открытие банковского счета для ТОО (РК)\' ,
                      \'Открытие банковского счета для ТОО (РК)\',
                      2,
                      2,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (14,8,\'Открытие банковского счета для ТОО (РК)\',1,true,2,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (14,1,\'Копии учредительных документов юридического лица\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (14,2,\'Заполненый документ с образцами подписей и оттиска печати\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (14,\'Открытый счет в Альфа-Банке\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (14,5000,1,null,\'2018-01-01\');
            ');
            
            //service - 160
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      9, 4,  
                      \'160\',
                      \'Открытие банковского счета для ТОО (ЕВРАЗЭС)\' ,
                      \'Открытие банковского счета для ТОО (ЕВРАЗЭС)\',
                      2,
                      2,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (15,9,\'Открытие банковского счета для ТОО (ЕВРАЗЭС)\',1,true,2,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (15,1,\'Копии учредительных документов юридического лица\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (15,2,\'Заполненый документ с образцами подписей и оттиска печати\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (15,3,\'Согласие на сбор и обработку персональных данных\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (15,4,\'Сопроводительное письмо\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (15,5,\'Нотариально заверенная копия паспорта учредителя гражданина страны-участника ЕВРАЗЭС, с нотариально заверенным переводом на русский и казахский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (15,\'Открытый счет в Альфа-Банке\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (15,5000,1,null,\'2018-01-01\');
            ');
            
            //service - 170
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      10, 4,  
                      \'170\',
                      \'Открытие банковского счета для ТОО (Нерезидент)\' ,
                      \'Открытие банковского счета для ТОО (Нерезидент)\',
                      2,
                      2,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (16,10,\'Открытие банковского счета для ТОО (Нерезидент)\',1,true,2,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (16,1,\'См. услугу получение ЭЦП на учредителя (на физ.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (16,2,\'Копия удостоверения личности учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (16,3,\'
            Копия удостоверения личности директора\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (16,4,\'
            Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (16,\'Открытый счет в Альфа-Банке\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (16,5000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (5, 10, \'Регистрация бизнеса -  Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)\', \'Регистрация бизнеса -  Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)\');
            ');
            
            //service - 180
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      11, 5,  
                      \'180\',
                      \'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин РК\' ,
                      \'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин РК\',
                      3,
                      6,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (17,11,\'Получение ЭЦП на учредителя (физ.лицо РК)\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (17,1,\'См. услугу получение ЭЦП на учредителя (на физ.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (17,2,\'Копия удостоверения личности учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (17,3,\'
            Копия удостоверения личности директора\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (17,4,\'
            Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (17,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
                                       - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (17,20000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (18,11,\'Регистрация ТОО\',2,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (18,1,\'См. услугу получение ЭЦП на учредителя (на физ.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (18,2,\'Копия удостоверения личности учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (18,3,\'
            Копия удостоверения личности директора\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (18,4,\'
            Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (18,\'ЭЦП (Электронно-Цифровая Подпись) на компанию\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (18,20000,1,null,\'2018-01-01\');
            ');
            
            //service - 190
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      12, 5,  
                      \'190\',
                      \'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин ЕВРАЗЭС\' ,
                      \'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин ЕВРАЗЭС\',
                      5,
                      15,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (19,12,\'Получение ИИН на Директора гр. ЕВРАЗЭС\',1,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (19,1,\'См. услугу получение ИИН (ЕВРАЗЭС)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (19,2,\'См. услугу получение ЭЦП на учредителя (на физ.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (19,3,\'Регистрация ТОО:                                                                                                   - Копия паспорта директора гражданина страны-участника ЕВРАЗЭС с нотариально заверенным переводом на казахский и русский язык;
            - Копия удостоверения личности учредителя гражданина Республики Казахстан;
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (19,4,\'
            \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (19,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (19,20000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (20,12,\'Получение ЭЦП на учредителя (физ.лицо РК)\',2,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (20,1,\'См. услугу получение ИИН (ЕВРАЗЭС)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (20,2,\'См. услугу получение ЭЦП на учредителя (на физ.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (20,3,\'Регистрация ТОО:                                                                                                   - Копия паспорта директора гражданина страны-участника ЕВРАЗЭС с нотариально заверенным переводом на казахский и русский язык;
            - Копия удостоверения личности учредителя гражданина Республики Казахстан;
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (20,4,\'
            \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (20,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (20,20000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (21,12,\'Регистрация ТОО\',3,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (21,1,\'См. услугу получение ИИН (ЕВРАЗЭС)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (21,2,\'См. услугу получение ЭЦП на учредителя (на физ.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (21,3,\'Регистрация ТОО:                                                                                                   - Копия паспорта директора гражданина страны-участника ЕВРАЗЭС с нотариально заверенным переводом на казахский и русский язык;
            - Копия удостоверения личности учредителя гражданина Республики Казахстан;
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (21,4,\'
            \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (21,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (21,20000,1,null,\'2018-01-01\');
            ');
            
            //service - 200
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      13, 5,  
                      \'200\',
                      \'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин нерезидент\' ,
                      \'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин нерезидент\',
                      5,
                      15,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (22,13,\'Получение ИИН на нерезидента\',1,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (22,1,\'См. услугу получение ИИН (на нерезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (22,2,\'См. услугу получение ЭЦП на учредителя (на физ.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (22,3,\'Регистрация ТОО:                                                                                                   - Легализованная/Апостилированная копия паспорта, с нотариально заверенным переводом на казахский и русский язык;
            - Копия удостоверения личности учредителя гражданина Республики Казахстан;
            - Заполненная форма по регистрации ТОО;                                                                   - ЭЦП на физ.лицо-учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (22,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (22,50000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (23,13,\'Получение ЭЦП на учредителя (физ.лицо РК)\',2,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (23,1,\'См. услугу получение ИИН (на нерезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (23,2,\'См. услугу получение ЭЦП на учредителя (на физ.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (23,3,\'Регистрация ТОО:                                                                                                   - Легализованная/Апостилированная копия паспорта, с нотариально заверенным переводом на казахский и русский язык;
            - Копия удостоверения личности учредителя гражданина Республики Казахстан;
            - Заполненная форма по регистрации ТОО;                                                                   - ЭЦП на физ.лицо-учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (23,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (23,50000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (24,13,\'Регистрация ТОО\',3,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (24,1,\'См. услугу получение ИИН (на нерезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (24,2,\'См. услугу получение ЭЦП на учредителя (на физ.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (24,3,\'Регистрация ТОО:                                                                                                   - Легализованная/Апостилированная копия паспорта, с нотариально заверенным переводом на казахский и русский язык;
            - Копия удостоверения личности учредителя гражданина Республики Казахстан;
            - Заполненная форма по регистрации ТОО;                                                                   - ЭЦП на физ.лицо-учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (24,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (24,50000,1,null,\'2018-01-01\');
            ');
            
            //service - 210
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      14, 5,  
                      \'210\',
                      \'Регистрация ТОО учредитель юр.лицо РК, директор гражданин РК\' ,
                      \'Регистрация ТОО учредитель юр.лицо РК, директор гражданин РК\',
                      3,
                      6,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (25,14,\'Получение ЭЦП на учредителя (юр.лицо РК)\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (25,1,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (25,2,\'Регистрация ТОО копии учредительных документов:
            -Устав;
            -Учредительный договор;
            -Решение учредителя/Протокол общего собрания учредителей; 
            -Приказ на директора;
            - Справка о зарегистрированном юридическом лице;
            - Удостоверение личности директора гражданина Республики Казахстан;
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (25,3,\'- ЭЦП на юр.лицо-учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (25,4,\'
            \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (25,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (25,30000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (26,14,\'Регистрация ТОО\',2,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (26,1,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (26,2,\'Регистрация ТОО копии учредительных документов:
            -Устав;
            -Учредительный договор;
            -Решение учредителя/Протокол общего собрания учредителей; 
            -Приказ на директора;
            - Справка о зарегистрированном юридическом лице;
            - Удостоверение личности директора гражданина Республики Казахстан;
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (26,3,\'- ЭЦП на юр.лицо-учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (26,4,\'
            \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (26,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (26,30000,1,null,\'2018-01-01\');
            ');
            
            //service - 220
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      15, 5,  
                      \'220\',
                      \'Регистрация ТОО учредитель юр.лицо РК, директор гражданин ЕВРАЗЭС\' ,
                      \'Регистрация ТОО учредитель юр.лицо РК, директор гражданин ЕВРАЗЭС\',
                      5,
                      15,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (27,15,\'Получение ИИН на Директора гр. ЕВРАЗЭС\',1,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (27,1,\'См. услугу получение см. услугу получение ИИН (ЕВРАЗЭС)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (27,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (27,3,\'Регистрация ТОО копии учредительных документов:
            -Устав;
            -Учредительный договор;
            -Решение учредителя/Протокол общего собрания учредителей; 
            -Приказ на директора;
            - Справка о зарегистрированном юридическом лице;
            - Копия паспорта директора гражданина ЕВРАЗЭС  с нотариально заверенным переводом на русском и казахском языках;
            - Заполненная форма по регистрации ТОО;                                                                  - ЭЦП на юр.лицо-учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (27,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (27,30000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (28,15,\'Получение ЭЦП на учредителя (юр.лицо РК)\',2,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (28,1,\'См. услугу получение см. услугу получение ИИН (ЕВРАЗЭС)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (28,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (28,3,\'Регистрация ТОО копии учредительных документов:
            -Устав;
            -Учредительный договор;
            -Решение учредителя/Протокол общего собрания учредителей; 
            -Приказ на директора;
            - Справка о зарегистрированном юридическом лице;
            - Копия паспорта директора гражданина ЕВРАЗЭС  с нотариально заверенным переводом на русском и казахском языках;
            - Заполненная форма по регистрации ТОО;                                                                  - ЭЦП на юр.лицо-учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (28,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (28,30000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (29,15,\'Регистрация ТОО\',3,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (29,1,\'См. услугу получение см. услугу получение ИИН (ЕВРАЗЭС)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (29,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (29,3,\'Регистрация ТОО копии учредительных документов:
            -Устав;
            -Учредительный договор;
            -Решение учредителя/Протокол общего собрания учредителей; 
            -Приказ на директора;
            - Справка о зарегистрированном юридическом лице;
            - Копия паспорта директора гражданина ЕВРАЗЭС  с нотариально заверенным переводом на русском и казахском языках;
            - Заполненная форма по регистрации ТОО;                                                                  - ЭЦП на юр.лицо-учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (29,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (29,30000,1,null,\'2018-01-01\');
            ');
            
            //service - 230
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      16, 5,  
                      \'230\',
                      \'Регистрация ТОО учредитель юр.лицо РК, директор гражданин нерезидент\' ,
                      \'Регистрация ТОО учредитель юр.лицо РК, директор гражданин нерезидент\',
                      5,
                      15,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (30,16,\'Получение ИИН на Директора нерезидента\',1,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (30,1,\'См. услугу получение см. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (30,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (30,3,\'Регистрация ТОО копии учредительных документов:
            -Устав;
            -Учредительный договор;
            -Решение учредителя/Протокол общего собрания учредителей; 
            -Приказ на директора;
            - Справка о зарегистрированном юридическом лице\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (30,4,\'
            Легализованная/Апостилированная копия паспорта, с нотариально заверенным переводом на казахский и русский язык директора нерезидента\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (30,5,\'
            Форма на регистрацию\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (30,6,\'
            ЭЦП на юр.лицо-учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (30,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (30,30000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (31,16,\'Получение ЭЦП на учредителя (юр.лицо РК)\',2,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (31,1,\'См. услугу получение см. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (31,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (31,3,\'Регистрация ТОО копии учредительных документов:
            -Устав;
            -Учредительный договор;
            -Решение учредителя/Протокол общего собрания учредителей; 
            -Приказ на директора;
            - Справка о зарегистрированном юридическом лице\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (31,4,\'
            Легализованная/Апостилированная копия паспорта, с нотариально заверенным переводом на казахский и русский язык директора нерезидента\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (31,5,\'
            Форма на регистрацию\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (31,6,\'
            ЭЦП на юр.лицо-учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (31,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (31,30000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (32,16,\'Регистрация ТОО\',3,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (32,1,\'См. услугу получение см. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (32,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (32,3,\'Регистрация ТОО копии учредительных документов:
            -Устав;
            -Учредительный договор;
            -Решение учредителя/Протокол общего собрания учредителей; 
            -Приказ на директора;
            - Справка о зарегистрированном юридическом лице\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (32,4,\'
            Легализованная/Апостилированная копия паспорта, с нотариально заверенным переводом на казахский и русский язык директора нерезидента\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (32,5,\'
            Форма на регистрацию\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (32,6,\'
            ЭЦП на юр.лицо-учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (32,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (32,30000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (6, 10, \'Регистрация бизнеса - Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)\', \'Регистрация бизнеса - Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)\');
            ');
            
            //service - 240
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      17, 6,  
                      \'240\',
                      \'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор РК\' ,
                      \'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор РК\',
                      5,
                      15,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (33,17,\'Получение ИИН на Директора нерезидента\',1,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (33,1,\'Cм. услугу получение см. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (33,2,\'Cм. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (33,3,\'Регистрация ТОО:                                                                                 - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС; 
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (33,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (33,70000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (34,17,\'Получение ЭЦП на учредителя (юр.лицо РК)\',2,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (34,1,\'Cм. услугу получение см. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (34,2,\'Cм. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (34,3,\'Регистрация ТОО:                                                                                 - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС; 
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (34,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (34,70000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (35,17,\'Регистрация ТОО\',3,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (35,1,\'Cм. услугу получение см. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (35,2,\'Cм. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (35,3,\'Регистрация ТОО:                                                                                 - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС; 
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (35,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (35,70000,1,null,\'2018-01-01\');
            ');
            
            //service - 250
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      18, 6,  
                      \'250\',
                      \'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор ЕВРАЗЭС\' ,
                      \'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор ЕВРАЗЭС\',
                      5,
                      15,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (36,18,\'Получение ИИН на Директора нерезидента\',1,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (36,1,\'См. услугу получение см. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (36,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (36,3,\'Регистрация ТОО:                                                                                 - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС;         - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (36,4,\'
            \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (36,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (36,70000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (37,18,\'Получение ЭЦП на учредителя (юр.лицо РК)\',2,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (37,1,\'См. услугу получение см. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (37,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (37,3,\'Регистрация ТОО:                                                                                 - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС;         - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (37,4,\'
            \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (37,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (37,70000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (38,18,\'Регистрация ТОО\',3,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (38,1,\'См. услугу получение см. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (38,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (38,3,\'Регистрация ТОО:                                                                                 - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС;         - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (38,4,\'
            \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (38,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (38,70000,1,null,\'2018-01-01\');
            ');
            
            //service - 260
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      19, 6,  
                      \'260\',
                      \'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор нерезидент\' ,
                      \'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор нерезидент\',
                      30,
                      210,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (39,19,\'Получение ИИН на Директора нерезидента\',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (39,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (39,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (39,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (39,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (39,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (39,6,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (39,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (39,200000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (40,19,\'Получение ЭЦП на учредителя (юр.лицо РК)\',2,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (40,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (40,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (40,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (40,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (40,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (40,6,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (40,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (40,200000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (41,19,\'Регистрация ТОО\',3,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (41,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (41,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (41,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (41,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (41,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (41,6,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (41,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (41,200000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (42,19,\'Регистрация компании в реестре Миграционной Полиции\',4,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (42,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (42,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (42,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (42,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (42,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (42,6,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (42,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (42,200000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (43,19,\'Подача заявления в уполномоченный орган о смене директора на нерезидента Республике Казахстан\',5,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (43,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (43,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (43,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (43,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (43,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (43,6,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (43,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (43,200000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (44,19,\'Получение письма-приглашения с номером визовой поддержки\',6,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (44,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (44,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (44,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (44,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (44,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (44,6,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (44,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (44,200000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (45,19,\'Постановка в течении 5 (пяти) календарных суток на регистрационный учёт в УМС ДВД (по месту нахождения) по факту въезда на территорию Республики\',7,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (45,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (45,2,\'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (45,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (45,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (45,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (45,6,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (45,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (45,200000,1,null,\'2018-01-01\');
            ');
            
            //service - 270
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      20, 6,  
                      \'270\',
                      \'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор РК\' ,
                      \'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор РК\',
                      5,
                      20,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (46,20,\'Получение ИИН на Директора нерезидента\',1,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (46,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (46,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (46,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (46,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (46,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (46,110000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (47,20,\'Получение ЭЦП на учредителя (юр.лицо РК)\',2,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (47,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (47,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (47,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (47,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (47,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (47,110000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (48,20,\'Получение БИН на юридическое лицо учредителя\',3,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (48,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (48,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (48,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (48,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (48,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (48,110000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (49,20,\'Регистрация ТОО\',4,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (49,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (49,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (49,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (49,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (49,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (49,110000,1,null,\'2018-01-01\');
            ');
            
            //service - 280
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      21, 6,  
                      \'280\',
                      \'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор ЕВРАЗЭС\' ,
                      \'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор ЕВРАЗЭС\',
                      5,
                      20,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (50,21,\'Получение ИИН на Директора нерезидента\',1,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (50,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (50,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (50,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (50,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (50,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (50,110000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (51,21,\'Получение ЭЦП на учредителя (юр.лицо РК)\',2,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (51,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (51,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (51,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (51,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (51,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (51,110000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (52,21,\'Получение БИН на юридическое лицо учредителя\',3,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (52,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (52,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (52,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (52,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (52,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (52,110000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (53,21,\'Регистрация ТОО\',4,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (53,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (53,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (53,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (53,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (53,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (53,110000,1,null,\'2018-01-01\');
            ');
            
            //service - 290
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      22, 6,  
                      \'290\',
                      \'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор нерезидент\' ,
                      \'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор нерезидент\',
                      30,
                      240,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (54,22,\'Получение ИИН на Директора нерезидента\',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (54,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (54,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (54,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (54,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (54,5,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (54,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (54,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (54,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (54,260000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (55,22,\'Получение ЭЦП на учредителя (юр.лицо РК)\',2,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (55,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (55,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (55,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (55,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (55,5,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (55,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (55,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (55,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (55,260000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (56,22,\'Получение БИН на юридическое лицо учредителя\',3,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (56,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (56,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (56,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (56,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (56,5,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (56,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (56,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (56,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (56,260000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (57,22,\'Регистрация ТОО\',4,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (57,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (57,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (57,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (57,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (57,5,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (57,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (57,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (57,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (57,260000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (58,22,\'Регистрация компании в реестре Миграционной Полиции\',5,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (58,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (58,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (58,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (58,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (58,5,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (58,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (58,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (58,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (58,260000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (59,22,\'Подача заявления в уполномоченный орган о смене директора на нерезидента Республике Казахстан\',6,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (59,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (59,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (59,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (59,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (59,5,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (59,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (59,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (59,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (59,260000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (60,22,\'Получение письма-приглашения с номером визовой поддержки\',7,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (60,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (60,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (60,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (60,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (60,5,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (60,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (60,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (60,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (60,260000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (61,22,\'Постановка в течении 5 (пяти) календарных суток на регистрационный учёт в УМС ДВД (по месту нахождения) по факту въезда на территорию Республики Казахстан.\',8,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (61,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (61,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (61,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (61,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (61,5,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (61,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (61,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (61,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (61,260000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (7, 10, \'Регистрация бизнеса - Регистрация ТОО (учредитель физ.лицо и/или юр.лицо нерезидент)\', \'Регистрация бизнеса - Регистрация ТОО (учредитель физ.лицо и/или юр.лицо нерезидент)\');
            ');
            
            //service - 300
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      23, 7,  
                      \'300\',
                      \'Регистрация ТОО учредитель  физ.лицо нерезидент, директор РК\' ,
                      \'Регистрация ТОО учредитель  физ.лицо нерезидент, директор РК\',
                      30,
                      180,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (62,23,\'Получение ИИН и ЭЦП на учредителя нерезидента\',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (62,1,\'См. услугу ""получение ИИН и ЭЦП"" для физ.лиц иностранных граждан\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (62,2,\'Регистрация ТОО:                                                                                         - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (62,3,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (62,4,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (62,5,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (62,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (62,210000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (63,23,\'Регистрация ТОО\',2,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (63,1,\'См. услугу ""получение ИИН и ЭЦП"" для физ.лиц иностранных граждан\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (63,2,\'Регистрация ТОО:                                                                                         - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (63,3,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (63,4,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (63,5,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (63,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (63,210000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (64,23,\'Регистрация компании в реестре Миграционной Полиции\',3,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (64,1,\'См. услугу ""получение ИИН и ЭЦП"" для физ.лиц иностранных граждан\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (64,2,\'Регистрация ТОО:                                                                                         - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (64,3,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (64,4,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (64,5,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (64,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (64,210000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (65,23,\'Получение ходатайства с Акимата\',4,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (65,1,\'См. услугу ""получение ИИН и ЭЦП"" для физ.лиц иностранных граждан\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (65,2,\'Регистрация ТОО:                                                                                         - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (65,3,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (65,4,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (65,5,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (65,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (65,210000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (66,23,\'Подача письма-приглашение на получение визы С5\',5,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (66,1,\'См. услугу ""получение ИИН и ЭЦП"" для физ.лиц иностранных граждан\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (66,2,\'Регистрация ТОО:                                                                                         - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (66,3,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (66,4,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (66,5,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (66,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (66,210000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (67,23,\'Постановка в течении 5 (пяти) календарных суток на регистрационный учёт в УМС ДВД (по месту нахождения) по факту въезда на территорию Республики Казахстан\',6,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (67,1,\'См. услугу ""получение ИИН и ЭЦП"" для физ.лиц иностранных граждан\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (67,2,\'Регистрация ТОО:                                                                                         - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (67,3,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (67,4,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (67,5,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (67,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (67,210000,1,null,\'2018-01-01\');
            ');
            
            //service - 310
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      24, 7,  
                      \'310\',
                      \'Регистрация ТОО учредитель  физ.лицо нерезидент, директор ЕВРАЗЭС\' ,
                      \'Регистрация ТОО учредитель  физ.лицо нерезидент, директор ЕВРАЗЭС\',
                      30,
                      180,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (68,24,\'Получение ИИН и ЭЦП на учредителя нерезидента\',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (68,1,\'См. услугу ""получение ИИН и ЭЦП"" для физ.лиц иностранных граждан\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (68,2,\'Регистрация ТОО:                                                                                         - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (68,3,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (68,4,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (68,5,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (68,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (68,250000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (69,24,\'Регистрация ТОО\',2,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (69,1,\'См. услугу ""получение ИИН и ЭЦП"" для физ.лиц иностранных граждан\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (69,2,\'Регистрация ТОО:                                                                                         - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (69,3,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (69,4,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (69,5,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (69,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (69,250000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (70,24,\'Регистрация компании в реестре Миграционной Полиции\',3,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (70,1,\'См. услугу ""получение ИИН и ЭЦП"" для физ.лиц иностранных граждан\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (70,2,\'Регистрация ТОО:                                                                                         - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (70,3,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (70,4,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (70,5,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (70,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (70,250000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (71,24,\'Получение ходатайства с Акимата\',4,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (71,1,\'См. услугу ""получение ИИН и ЭЦП"" для физ.лиц иностранных граждан\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (71,2,\'Регистрация ТОО:                                                                                         - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (71,3,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (71,4,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (71,5,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (71,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (71,250000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (72,24,\'Подача письма-приглашение на получение визы С5\',5,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (72,1,\'См. услугу ""получение ИИН и ЭЦП"" для физ.лиц иностранных граждан\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (72,2,\'Регистрация ТОО:                                                                                         - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (72,3,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (72,4,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (72,5,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (72,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (72,250000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (73,24,\'Постановка в течении 5 (пяти) календарных суток на регистрационный учёт в УМС ДВД (по месту нахождения) по факту въезда на территорию Республики Казахстан\',6,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (73,1,\'См. услугу ""получение ИИН и ЭЦП"" для физ.лиц иностранных граждан\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (73,2,\'Регистрация ТОО:                                                                                         - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (73,3,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (73,4,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (73,5,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (73,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (73,250000,1,null,\'2018-01-01\');
            ');
            
            //service - 320
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      25, 7,  
                      \'320\',
                      \'Регистрация ТОО учредитель  физ.лицо нерезидент, директор нерезидент\' ,
                      \'Регистрация ТОО учредитель  физ.лицо нерезидент, директор нерезидент\',
                      30,
                      210,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (74,25,\'Получение ИИН на Директора нерезидента\',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (74,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (74,2,\'2См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (74,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (74,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (74,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (74,6,\'""визы для бизнеса в РК"" - см. ""Регистрация\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (74,7,\'пребывающих иностранцев"".\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (74,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (74,200000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (75,25,\'Получение ЭЦП на учредителя (юр.лицо РК)\',2,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (75,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (75,2,\'2См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (75,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (75,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (75,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (75,6,\'""визы для бизнеса в РК"" - см. ""Регистрация\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (75,7,\'пребывающих иностранцев"".\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (75,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (75,200000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (76,25,\'Регистрация ТОО\',3,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (76,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (76,2,\'2См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (76,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (76,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (76,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (76,6,\'""визы для бизнеса в РК"" - см. ""Регистрация\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (76,7,\'пребывающих иностранцев"".\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (76,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (76,200000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (77,25,\'Регистрация компании в реестре Миграционной Полиции\',4,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (77,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (77,2,\'2См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (77,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (77,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (77,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (77,6,\'""визы для бизнеса в РК"" - см. ""Регистрация\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (77,7,\'пребывающих иностранцев"".\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (77,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (77,200000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (78,25,\'Подача заявления в уполномоченный орган о смене директора на нерезидента Республике Казахстан\',5,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (78,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (78,2,\'2См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (78,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (78,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (78,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (78,6,\'""визы для бизнеса в РК"" - см. ""Регистрация\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (78,7,\'пребывающих иностранцев"".\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (78,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (78,200000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (79,25,\'Получение письма-приглашения с номером визовой поддержки\',6,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (79,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (79,2,\'2См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (79,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (79,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (79,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (79,6,\'""визы для бизнеса в РК"" - см. ""Регистрация\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (79,7,\'пребывающих иностранцев"".\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (79,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (79,200000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (80,25,\'Постановка в течении 5 (пяти) календарных суток на регистрационный учёт в УМС ДВД (по месту нахождения) по факту въезда на территорию Республики\',7,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (80,1,\'См. услугу получение ИИН (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (80,2,\'2См. услугу получение ЭЦП на учредителя (на юр.лицо РК)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (80,3,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (80,4,\'
            См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (80,5,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (80,6,\'""визы для бизнеса в РК"" - см. ""Регистрация\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (80,7,\'пребывающих иностранцев"".\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (80,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (80,200000,1,null,\'2018-01-01\');
            ');
            
            //service - 330
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      26, 7,  
                      \'330\',
                      \'Регистрация ТОО учредитель юр.лицо нерезидент, директор РК\' ,
                      \'Регистрация ТОО учредитель юр.лицо нерезидент, директор РК\',
                      5,
                      20,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (81,26,\'Получение ИИН на Директора нерезидента\',1,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (81,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (81,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (81,3,\'См. услугу ""получение БИН"" на иностранное, юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (81,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (81,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (81,160000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (82,26,\'Получение ЭЦП на учредителя (юр.лицо РК)\',2,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (82,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (82,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (82,3,\'См. услугу ""получение БИН"" на иностранное, юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (82,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (82,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (82,160000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (83,26,\'Получение БИН на иностранное, юридическое лицо учредителя\',3,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (83,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (83,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (83,3,\'См. услугу ""получение БИН"" на иностранное, юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (83,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (83,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (83,160000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (84,26,\'Регистрация ТОО\',4,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (84,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (84,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (84,3,\'См. услугу ""получение БИН"" на иностранное, юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (84,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (84,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (84,160000,1,null,\'2018-01-01\');
            ');
            
            //service - 340
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      27, 7,  
                      \'340\',
                      \'Регистрация ТОО учредитель юр.лицо нерезидент, директор ЕВРАЗЭС\' ,
                      \'Регистрация ТОО учредитель юр.лицо нерезидент, директор ЕВРАЗЭС\',
                      5,
                      20,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (85,27,\'Получение ИИН на Директора нерезидента\',1,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (85,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (85,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (85,3,\'См. услугу ""получение БИН"" на иностранное, юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (85,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (85,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (85,180000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (86,27,\'Получение ЭЦП на учредителя (юр.лицо РК)\',2,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (86,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (86,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (86,3,\'См. услугу ""получение БИН"" на иностранное, юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (86,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (86,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (86,180000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (87,27,\'Получение БИН на иностранное, юридическое лицо учредителя\',3,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (87,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (87,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (87,3,\'См. услугу ""получение БИН"" на иностранное, юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (87,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (87,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (87,180000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (88,27,\'Регистрация ТОО\',4,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (88,1,\'См. услугу ""получение ИИН"" (неезидента)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (88,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (88,3,\'См. услугу ""получение БИН"" на иностранное, юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (88,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (88,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (88,180000,1,null,\'2018-01-01\');
            ');
            
            //service - 350
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      28, 7,  
                      \'350\',
                      \'Регистрация ТОО учредитель юр.лицо нерезидент, директор нерезидент\' ,
                      \'Регистрация ТОО учредитель юр.лицо нерезидент, директор нерезидент\',
                      30,
                      240,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (89,28,\'Получение ИИН на Директора нерезидента\',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (89,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (89,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (89,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (89,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (89,5,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (89,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (89,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (89,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (89,235000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (90,28,\'Получение ЭЦП на учредителя (юр.лицо РК)\',2,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (90,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (90,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (90,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (90,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (90,5,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (90,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (90,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (90,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (90,235000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (91,28,\'Получение БИН на юридическое лицо учредителя\',3,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (91,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (91,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (91,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (91,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (91,5,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (91,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (91,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (91,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (91,235000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (92,28,\'Регистрация ТОО\',4,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (92,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (92,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (92,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (92,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (92,5,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (92,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (92,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (92,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (92,235000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (93,28,\'Регистрация компании в реестре Миграционной Полиции\',5,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (93,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (93,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (93,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (93,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (93,5,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (93,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (93,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (93,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (93,235000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (94,28,\'Подача заявления в уполномоченный орган о смене директора на нерезидента Республике Казахстан\',6,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (94,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (94,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (94,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (94,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (94,5,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (94,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (94,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (94,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (94,235000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (95,28,\'Получение письма-приглашения с номером визовой поддержки\',7,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (95,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (95,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (95,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (95,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (95,5,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (95,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (95,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (95,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (95,235000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (96,28,\'Постановка в течении 5 (пяти) календарных суток на регистрационный учёт в УМС ДВД (по месту нахождения) по факту въезда на территорию Республики Казахстан\',8,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (96,1,\'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (96,2,\'См. услугу ""получение ЭЦП"" на директора юридического лица учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (96,3,\'См. услугу ""получение БИН"" на юридическое лицо учредителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (96,4,\'Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
            - Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
            - Заполненная форма по регистрации ТОО\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (96,5,\'См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (96,6,\'См. ""визы для бизнеса в РК"" - получение визы С3\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (96,7,\'""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (96,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (96,235000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (8, 10, \'Регистрация филиала/представительства -  Регистрация филиала/представительства (учредитель юр.лицо РК)\', \'Регистрация филиала/представительства -  Регистрация филиала/представительства (учредитель юр.лицо РК)\');
            ');
            
            //service - 360
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      29, 8,  
                      \'360\',
                      \'Регистрация филиала/представительства учредитель юр.лицо РК, директор РК\' ,
                      \'Регистрация филиала/представительства учредитель юр.лицо РК, директор РК\',
                      3,
                      3,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (97,29,\'Учетная регистрация филиала/представительства\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (97,1,\'Удостоверение личности директора и учредителя головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (97,2,\'
            Удостоверение личности директора создаваемого филиала/представительства\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (97,3,\'
            Заполненная упрощенная анкета по регистрации\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (97,4,\'
            Договор аренды офиса\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (97,5,\'Копии учредительных документов головной компании (Устав, протокол/решение, учредительный договор, приказ)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (97,6,\'
            Квитанция об оплате гос.пошлины (2-6,5 МРП)\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (97,\'ИИН на директора филиала/представительства гражданина ЕВРАЗЭС; ЭЦП на директора филиала; Справка об учетной регистрации филиала/представительства; Полный пакет учредительных документов\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (97,30000,1,null,\'2018-01-01\');
            ');
            
            //service - 370
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      30, 8,  
                      \'370\',
                      \'Регистрация филиала/представительства учредитель юр.лицо РК, директор ЕВРАЗЭС\' ,
                      \'Регистрация филиала/представительства учредитель юр.лицо РК, директор ЕВРАЗЭС\',
                      7,
                      21,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (98,30,\'Получение ИИН на директора филиала/представительства гражданина ЕВРАЗЭС\',1,true,7,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (98,1,\'Удостоверение личности директора и учредителя головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (98,2,\'
            Заполненная упрощенная анкета по регистрации\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (98,3,\'
            Договор аренды офиса\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (98,4,\'
            Копии учредительных документов головной компании (Устав, протокол/решение, учредительный договор, приказ)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (98,5,\'
            Квитанция об оплате гос.пошлины (2-6,5 МРП)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (98,6,\'
            6. Копия паспорта директора компании гражданина ЕВРАЗЭС с нотариально засвидетельствованным переводом на казахский и русский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (98,\'ИИН на директора филиала/представительства гражданина ЕВРАЗЭС; ЭЦП на директора филиала; Справка об учетной регистрации филиала/представительства; Полный пакет учредительных документов\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (98,30000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (99,30,\'Получение ЭЦП на на директора филиала/представительства\',2,true,7,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (99,1,\'Удостоверение личности директора и учредителя головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (99,2,\'
            Заполненная упрощенная анкета по регистрации\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (99,3,\'
            Договор аренды офиса\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (99,4,\'
            Копии учредительных документов головной компании (Устав, протокол/решение, учредительный договор, приказ)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (99,5,\'
            Квитанция об оплате гос.пошлины (2-6,5 МРП)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (99,6,\'
            6. Копия паспорта директора компании гражданина ЕВРАЗЭС с нотариально засвидетельствованным переводом на казахский и русский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (99,\'ИИН на директора филиала/представительства гражданина ЕВРАЗЭС; ЭЦП на директора филиала; Справка об учетной регистрации филиала/представительства; Полный пакет учредительных документов\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (99,30000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (100,30,\'Учетная регистрация филиала/представительства\',3,true,7,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (100,1,\'Удостоверение личности директора и учредителя головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (100,2,\'
            Заполненная упрощенная анкета по регистрации\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (100,3,\'
            Договор аренды офиса\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (100,4,\'
            Копии учредительных документов головной компании (Устав, протокол/решение, учредительный договор, приказ)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (100,5,\'
            Квитанция об оплате гос.пошлины (2-6,5 МРП)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (100,6,\'
            6. Копия паспорта директора компании гражданина ЕВРАЗЭС с нотариально засвидетельствованным переводом на казахский и русский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (100,\'ИИН на директора филиала/представительства гражданина ЕВРАЗЭС; ЭЦП на директора филиала; Справка об учетной регистрации филиала/представительства; Полный пакет учредительных документов\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (100,30000,1,null,\'2018-01-01\');
            ');
            
            //service - 380
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      31, 8,  
                      \'380\',
                      \'Регистрация филиала/представительства учредитель юр.лицо РК, директор нерезидент\' ,
                      \'Регистрация филиала/представительства учредитель юр.лицо РК, директор нерезидент\',
                      45,
                      225,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (101,31,\'Учетная регистрация филиала/представительства с временным директором гражданином РК\',1,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,1,\'Удостоверение личности директора и учредителя головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,2,\'
            Удостоверение личности временного директора (гражданина РК) создаваемого филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,3,\'Заполненная упрощенная анкета по регистрации\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,4,\'
            Договор аренды офиса\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,5,\'
            Копии учредительных документов головной компании (Устав, протокол/решение, учредительный договор, приказ)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,6,\'
            Квитанция об оплате гос.пошлины (2-6,5 МРП)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,7,\'
            Копии учредительных документов компании: Cправка (свидетельство) о государственной регистрации (перерегистрации), Устав (все изменения к Уставу)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,8,\'
            Легализованные/апостилированные копии и переводы документов об образовании директора нерезидента, соответствующие профилю компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,9,\'
            Опыт работы на аналогичной должности от 3 до 5 лет с приложением письменного подтверждения о трудовой деятельности работника на официальном бланке работодателя, у которого ранее работал работник, или иных подтверждающих документов, признаваемых в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,10,\'
            Информация о местном содержании в кадрах (штатное расписание компании и количество сотрудников в компании (для выявления процентного соотношения)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,11,\'
            Паспорт, переведенный на русский/казахский язык и нот. заверенный казахстанским нотариусом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,12,\'
            Краткое описание вида деятельности компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,13,\'
            Государственная пошлина для рабочего разрещения около 225 МРП (510,525 тенге), для первой категории работников\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (101,14,\'
            Открытый счет на компанию в банке\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (101,\'Справка о регистрации филиала; ИИН и ЭЦП для директора нерезидента; рабочее разрешение для директора нерезидента; полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (101,1600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (102,31,\'Получение ИИН на директора нерезидента\',2,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,1,\'Удостоверение личности директора и учредителя головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,2,\'
            Удостоверение личности временного директора (гражданина РК) создаваемого филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,3,\'Заполненная упрощенная анкета по регистрации\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,4,\'
            Договор аренды офиса\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,5,\'
            Копии учредительных документов головной компании (Устав, протокол/решение, учредительный договор, приказ)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,6,\'
            Квитанция об оплате гос.пошлины (2-6,5 МРП)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,7,\'
            Копии учредительных документов компании: Cправка (свидетельство) о государственной регистрации (перерегистрации), Устав (все изменения к Уставу)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,8,\'
            Легализованные/апостилированные копии и переводы документов об образовании директора нерезидента, соответствующие профилю компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,9,\'
            Опыт работы на аналогичной должности от 3 до 5 лет с приложением письменного подтверждения о трудовой деятельности работника на официальном бланке работодателя, у которого ранее работал работник, или иных подтверждающих документов, признаваемых в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,10,\'
            Информация о местном содержании в кадрах (штатное расписание компании и количество сотрудников в компании (для выявления процентного соотношения)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,11,\'
            Паспорт, переведенный на русский/казахский язык и нот. заверенный казахстанским нотариусом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,12,\'
            Краткое описание вида деятельности компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,13,\'
            Государственная пошлина для рабочего разрещения около 225 МРП (510,525 тенге), для первой категории работников\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (102,14,\'
            Открытый счет на компанию в банке\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (102,\'Справка о регистрации филиала; ИИН и ЭЦП для директора нерезидента; рабочее разрешение для директора нерезидента; полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (102,1600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (103,31,\'Получение ЭЦП на на директора нерезидента\',3,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,1,\'Удостоверение личности директора и учредителя головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,2,\'
            Удостоверение личности временного директора (гражданина РК) создаваемого филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,3,\'Заполненная упрощенная анкета по регистрации\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,4,\'
            Договор аренды офиса\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,5,\'
            Копии учредительных документов головной компании (Устав, протокол/решение, учредительный договор, приказ)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,6,\'
            Квитанция об оплате гос.пошлины (2-6,5 МРП)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,7,\'
            Копии учредительных документов компании: Cправка (свидетельство) о государственной регистрации (перерегистрации), Устав (все изменения к Уставу)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,8,\'
            Легализованные/апостилированные копии и переводы документов об образовании директора нерезидента, соответствующие профилю компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,9,\'
            Опыт работы на аналогичной должности от 3 до 5 лет с приложением письменного подтверждения о трудовой деятельности работника на официальном бланке работодателя, у которого ранее работал работник, или иных подтверждающих документов, признаваемых в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,10,\'
            Информация о местном содержании в кадрах (штатное расписание компании и количество сотрудников в компании (для выявления процентного соотношения)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,11,\'
            Паспорт, переведенный на русский/казахский язык и нот. заверенный казахстанским нотариусом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,12,\'
            Краткое описание вида деятельности компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,13,\'
            Государственная пошлина для рабочего разрещения около 225 МРП (510,525 тенге), для первой категории работников\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (103,14,\'
            Открытый счет на компанию в банке\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (103,\'Справка о регистрации филиала; ИИН и ЭЦП для директора нерезидента; рабочее разрешение для директора нерезидента; полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (103,1600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (104,31,\'Получение рабочего разрешения для директора нерезидента\',4,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,1,\'Удостоверение личности директора и учредителя головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,2,\'
            Удостоверение личности временного директора (гражданина РК) создаваемого филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,3,\'Заполненная упрощенная анкета по регистрации\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,4,\'
            Договор аренды офиса\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,5,\'
            Копии учредительных документов головной компании (Устав, протокол/решение, учредительный договор, приказ)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,6,\'
            Квитанция об оплате гос.пошлины (2-6,5 МРП)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,7,\'
            Копии учредительных документов компании: Cправка (свидетельство) о государственной регистрации (перерегистрации), Устав (все изменения к Уставу)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,8,\'
            Легализованные/апостилированные копии и переводы документов об образовании директора нерезидента, соответствующие профилю компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,9,\'
            Опыт работы на аналогичной должности от 3 до 5 лет с приложением письменного подтверждения о трудовой деятельности работника на официальном бланке работодателя, у которого ранее работал работник, или иных подтверждающих документов, признаваемых в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,10,\'
            Информация о местном содержании в кадрах (штатное расписание компании и количество сотрудников в компании (для выявления процентного соотношения)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,11,\'
            Паспорт, переведенный на русский/казахский язык и нот. заверенный казахстанским нотариусом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,12,\'
            Краткое описание вида деятельности компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,13,\'
            Государственная пошлина для рабочего разрещения около 225 МРП (510,525 тенге), для первой категории работников\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (104,14,\'
            Открытый счет на компанию в банке\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (104,\'Справка о регистрации филиала; ИИН и ЭЦП для директора нерезидента; рабочее разрешение для директора нерезидента; полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (104,1600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (105,31,\'Смена руководителя филиала с гражданина РК на нерезидента\',5,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,1,\'Удостоверение личности директора и учредителя головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,2,\'
            Удостоверение личности временного директора (гражданина РК) создаваемого филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,3,\'Заполненная упрощенная анкета по регистрации\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,4,\'
            Договор аренды офиса\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,5,\'
            Копии учредительных документов головной компании (Устав, протокол/решение, учредительный договор, приказ)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,6,\'
            Квитанция об оплате гос.пошлины (2-6,5 МРП)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,7,\'
            Копии учредительных документов компании: Cправка (свидетельство) о государственной регистрации (перерегистрации), Устав (все изменения к Уставу)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,8,\'
            Легализованные/апостилированные копии и переводы документов об образовании директора нерезидента, соответствующие профилю компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,9,\'
            Опыт работы на аналогичной должности от 3 до 5 лет с приложением письменного подтверждения о трудовой деятельности работника на официальном бланке работодателя, у которого ранее работал работник, или иных подтверждающих документов, признаваемых в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,10,\'
            Информация о местном содержании в кадрах (штатное расписание компании и количество сотрудников в компании (для выявления процентного соотношения)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,11,\'
            Паспорт, переведенный на русский/казахский язык и нот. заверенный казахстанским нотариусом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,12,\'
            Краткое описание вида деятельности компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,13,\'
            Государственная пошлина для рабочего разрещения около 225 МРП (510,525 тенге), для первой категории работников\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (105,14,\'
            Открытый счет на компанию в банке\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (105,\'Справка о регистрации филиала; ИИН и ЭЦП для директора нерезидента; рабочее разрешение для директора нерезидента; полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (105,1600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (9, 10, \'Регистрация филиала/представительства - Регистрация филиала/представительства (учредитель юр.лицо ЕВРАЗЭС)\', \'Регистрация филиала/представительства - Регистрация филиала/представительства (учредитель юр.лицо ЕВРАЗЭС)\');
            ');
            
            //service - 390
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      32, 9,  
                      \'390\',
                      \'Регистрация филиала/представительства учредитель юр.лицо ЕВРАЗЭС, директор РК\' ,
                      \'Регистрация филиала/представительства учредитель юр.лицо ЕВРАЗЭС, директор РК\',
                      10,
                      40,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (106,32,\'Получение ИИН на учредителя и директора головной компании\',1,true,10,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (106,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (106,2,\'
            Нотариальная доверенность на юриста ИнтерПраво\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (106,3,\'                   
            Выписка из торгового реестра либо его аналога с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (106,4,\'
            Копия заверенная копия Устава головной компании с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (106,5,\'
            Копия заверенная выписка из торгового реестра или его аналог с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (106,6,\'
            Копия заверенный протокол, либо решение об учётной регистрации филиала в РК с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (106,7,\'
            Копия заверенное положение филиала с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (106,8,\'
            Копия заверенная свидетельства о регистрации компании или аналога (например: ОГРН) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (106,9,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (106,10,\'
            Генеральная доверенность на руководителя (легализованная) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (106,11,\'
            Копия удостоверения личности директора ТОО гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (106,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании; БИН и ЭЦП на головную компанию; Полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (106,600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (107,32,\'Получение БИН на головную компанию\',2,true,10,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (107,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (107,2,\'
            Нотариальная доверенность на юриста ИнтерПраво\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (107,3,\'                   
            Выписка из торгового реестра либо его аналога с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (107,4,\'
            Копия заверенная копия Устава головной компании с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (107,5,\'
            Копия заверенная выписка из торгового реестра или его аналог с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (107,6,\'
            Копия заверенный протокол, либо решение об учётной регистрации филиала в РК с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (107,7,\'
            Копия заверенное положение филиала с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (107,8,\'
            Копия заверенная свидетельства о регистрации компании или аналога (например: ОГРН) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (107,9,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (107,10,\'
            Генеральная доверенность на руководителя (легализованная) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (107,11,\'
            Копия удостоверения личности директора ТОО гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (107,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании; БИН и ЭЦП на головную компанию; Полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (107,600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (108,32,\'Получение ЭЦП на головную компанию\',3,true,10,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (108,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (108,2,\'
            Нотариальная доверенность на юриста ИнтерПраво\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (108,3,\'                   
            Выписка из торгового реестра либо его аналога с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (108,4,\'
            Копия заверенная копия Устава головной компании с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (108,5,\'
            Копия заверенная выписка из торгового реестра или его аналог с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (108,6,\'
            Копия заверенный протокол, либо решение об учётной регистрации филиала в РК с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (108,7,\'
            Копия заверенное положение филиала с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (108,8,\'
            Копия заверенная свидетельства о регистрации компании или аналога (например: ОГРН) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (108,9,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (108,10,\'
            Генеральная доверенность на руководителя (легализованная) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (108,11,\'
            Копия удостоверения личности директора ТОО гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (108,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании; БИН и ЭЦП на головную компанию; Полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (108,600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (109,32,\'Учетная регистрация филиала/представительства\',4,true,10,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (109,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (109,2,\'
            Нотариальная доверенность на юриста ИнтерПраво\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (109,3,\'                   
            Выписка из торгового реестра либо его аналога с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (109,4,\'
            Копия заверенная копия Устава головной компании с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (109,5,\'
            Копия заверенная выписка из торгового реестра или его аналог с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (109,6,\'
            Копия заверенный протокол, либо решение об учётной регистрации филиала в РК с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (109,7,\'
            Копия заверенное положение филиала с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (109,8,\'
            Копия заверенная свидетельства о регистрации компании или аналога (например: ОГРН) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (109,9,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (109,10,\'
            Генеральная доверенность на руководителя (легализованная) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (109,11,\'
            Копия удостоверения личности директора ТОО гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (109,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании; БИН и ЭЦП на головную компанию; Полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (109,600,2,null,\'2018-01-01\');
            ');
            
            //service - 400
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      33, 9,  
                      \'400\',
                      \'Регистрация филиала/представительства учредитель юр.лицо ЕВРАЗЭС, директор ЕВРАЗЭС\' ,
                      \'Регистрация филиала/представительства учредитель юр.лицо ЕВРАЗЭС, директор ЕВРАЗЭС\',
                      10,
                      50,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (110,33,\'Получение ИИН на учредителя и директора головной компании\',1,true,10,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (110,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (110,2,\'  
            Нотариально заверенная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (110,3,\'  
            Нотариально заверенная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (110,4,\'  
            Нотариально заверенный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (110,5,\'  
            Нотариально заверенное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (110,6,\'  
            Нотариально заверенная свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (110,7,\'  
            Место нахождения филиала (юридический адрес) – можем предоставить\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (110,8,\'  
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (110,9,\'  
            Копия паспорта директора гражданина ЕВРАЗЭС с нотариально засвидетельствованным переводом на казахский и русский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (110,10,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (110,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; Gолный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (110,\' \');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (110,600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (111,33,\'Получение БИН на головную компанию\',2,true,10,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (111,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (111,2,\'  
            Нотариально заверенная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (111,3,\'  
            Нотариально заверенная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (111,4,\'  
            Нотариально заверенный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (111,5,\'  
            Нотариально заверенное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (111,6,\'  
            Нотариально заверенная свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (111,7,\'  
            Место нахождения филиала (юридический адрес) – можем предоставить\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (111,8,\'  
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (111,9,\'  
            Копия паспорта директора гражданина ЕВРАЗЭС с нотариально засвидетельствованным переводом на казахский и русский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (111,10,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (111,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; Gолный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (111,\' \');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (111,600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (112,33,\'Получение ЭЦП на головную компанию и директора головной компании\',3,true,10,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (112,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (112,2,\'  
            Нотариально заверенная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (112,3,\'  
            Нотариально заверенная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (112,4,\'  
            Нотариально заверенный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (112,5,\'  
            Нотариально заверенное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (112,6,\'  
            Нотариально заверенная свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (112,7,\'  
            Место нахождения филиала (юридический адрес) – можем предоставить\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (112,8,\'  
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (112,9,\'  
            Копия паспорта директора гражданина ЕВРАЗЭС с нотариально засвидетельствованным переводом на казахский и русский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (112,10,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (112,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; Gолный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (112,\' \');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (112,600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (113,33,\'Получение ИИН на директора филиала резидента ЕВРАЗЭС\',4,true,10,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (113,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (113,2,\'  
            Нотариально заверенная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (113,3,\'  
            Нотариально заверенная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (113,4,\'  
            Нотариально заверенный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (113,5,\'  
            Нотариально заверенное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (113,6,\'  
            Нотариально заверенная свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (113,7,\'  
            Место нахождения филиала (юридический адрес) – можем предоставить\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (113,8,\'  
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (113,9,\'  
            Копия паспорта директора гражданина ЕВРАЗЭС с нотариально засвидетельствованным переводом на казахский и русский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (113,10,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (113,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; Gолный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (113,\' \');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (113,600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (114,33,\'Eчетная регистрация филиала/представительства\',5,true,10,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (114,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (114,2,\'  
            Нотариально заверенная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (114,3,\'  
            Нотариально заверенная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (114,4,\'  
            Нотариально заверенный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (114,5,\'  
            Нотариально заверенное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (114,6,\'  
            Нотариально заверенная свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (114,7,\'  
            Место нахождения филиала (юридический адрес) – можем предоставить\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (114,8,\'  
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (114,9,\'  
            Копия паспорта директора гражданина ЕВРАЗЭС с нотариально засвидетельствованным переводом на казахский и русский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (114,10,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (114,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; Gолный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (114,\' \');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (114,600,2,null,\'2018-01-01\');
            ');
            
            //service - 410
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      34, 9,  
                      \'410\',
                      \'Регистрация филиала/представительства учредитель юр.лицо ЕВРАЗЭС, директор нерезидент\' ,
                      \'Регистрация филиала/представительства учредитель юр.лицо ЕВРАЗЭС, директор нерезидент\',
                      45,
                      315,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (115,34,\'Получение ИИН на учредителя и директора головной компании;\',1,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,2,\'                                                                          
            Копия заверенная копия Устава головной компании с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,3,\'
            Копия заверенная выписка из торгового реестра или его аналог с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,4,\'
            Копия заверенный протокол, либо решение об учётной регистрации филиала в РК с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,5,\'
            Копия заверенное положение филиала с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,6,\'
            Копия заверенная свидетельства о регистрации компании или аналога (например: ОГРН) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,8,\'
            Генеральная доверенность на руководителя (легализованная) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,9,\'
            Копия удостоверения личности на директора ТОО гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,10,\'         
            Легализованная/апостилированные копии и переводы документов об образовании, соответствующие профилю компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,11,\'
            Опыт работы на аналогичной должности от 3 до 5 лет с приложением письменного подтверждения о трудовой деятельности работника на официальном бланке работодателя, у которого ранее работал работник, или иных подтверждающих документов, признаваемых в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,12,\'
            Информация о местном содержании в кадрах (штатное расписание компании и количество сотрудников в компании (для выявления процентного соотношения)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,13,\'
            Паспорт директора нерезидента, переведенный на русский/казахский язык и нот. заверенный казахстанским нотариусом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,14,\'
            Государственная пошлина  около 225 МРП (510,525 тенге), для первой категории работников\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,15,\'
            Открытый счет на компанию в банке\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,16,\'                                              
            Письмо в УМП ДВД на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,17,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,18,\'
            Копия генеральной доверенности на руководителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,19,\'
            Приказ о назначении на должность директора\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (115,20,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (115,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала; Рабочее разрешение на директора нерезидента\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (115,2100,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (116,34,\'Получение БИН и ЭЦП на головную компанию\',2,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,2,\'                                                                          
            Копия заверенная копия Устава головной компании с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,3,\'
            Копия заверенная выписка из торгового реестра или его аналог с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,4,\'
            Копия заверенный протокол, либо решение об учётной регистрации филиала в РК с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,5,\'
            Копия заверенное положение филиала с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,6,\'
            Копия заверенная свидетельства о регистрации компании или аналога (например: ОГРН) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,8,\'
            Генеральная доверенность на руководителя (легализованная) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,9,\'
            Копия удостоверения личности на директора ТОО гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,10,\'         
            Легализованная/апостилированные копии и переводы документов об образовании, соответствующие профилю компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,11,\'
            Опыт работы на аналогичной должности от 3 до 5 лет с приложением письменного подтверждения о трудовой деятельности работника на официальном бланке работодателя, у которого ранее работал работник, или иных подтверждающих документов, признаваемых в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,12,\'
            Информация о местном содержании в кадрах (штатное расписание компании и количество сотрудников в компании (для выявления процентного соотношения)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,13,\'
            Паспорт директора нерезидента, переведенный на русский/казахский язык и нот. заверенный казахстанским нотариусом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,14,\'
            Государственная пошлина  около 225 МРП (510,525 тенге), для первой категории работников\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,15,\'
            Открытый счет на компанию в банке\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,16,\'                                              
            Письмо в УМП ДВД на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,17,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,18,\'
            Копия генеральной доверенности на руководителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,19,\'
            Приказ о назначении на должность директора\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (116,20,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (116,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала; Рабочее разрешение на директора нерезидента\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (116,2100,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (117,34,\'Получение ИИН и ЭЦП на директора филиала нерезидента\',3,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,2,\'                                                                          
            Копия заверенная копия Устава головной компании с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,3,\'
            Копия заверенная выписка из торгового реестра или его аналог с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,4,\'
            Копия заверенный протокол, либо решение об учётной регистрации филиала в РК с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,5,\'
            Копия заверенное положение филиала с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,6,\'
            Копия заверенная свидетельства о регистрации компании или аналога (например: ОГРН) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,8,\'
            Генеральная доверенность на руководителя (легализованная) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,9,\'
            Копия удостоверения личности на директора ТОО гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,10,\'         
            Легализованная/апостилированные копии и переводы документов об образовании, соответствующие профилю компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,11,\'
            Опыт работы на аналогичной должности от 3 до 5 лет с приложением письменного подтверждения о трудовой деятельности работника на официальном бланке работодателя, у которого ранее работал работник, или иных подтверждающих документов, признаваемых в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,12,\'
            Информация о местном содержании в кадрах (штатное расписание компании и количество сотрудников в компании (для выявления процентного соотношения)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,13,\'
            Паспорт директора нерезидента, переведенный на русский/казахский язык и нот. заверенный казахстанским нотариусом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,14,\'
            Государственная пошлина  около 225 МРП (510,525 тенге), для первой категории работников\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,15,\'
            Открытый счет на компанию в банке\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,16,\'                                              
            Письмо в УМП ДВД на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,17,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,18,\'
            Копия генеральной доверенности на руководителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,19,\'
            Приказ о назначении на должность директора\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (117,20,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (117,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала; Рабочее разрешение на директора нерезидента\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (117,2100,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (118,34,\'Учетная регистрация филиала\',4,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,2,\'                                                                          
            Копия заверенная копия Устава головной компании с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,3,\'
            Копия заверенная выписка из торгового реестра или его аналог с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,4,\'
            Копия заверенный протокол, либо решение об учётной регистрации филиала в РК с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,5,\'
            Копия заверенное положение филиала с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,6,\'
            Копия заверенная свидетельства о регистрации компании или аналога (например: ОГРН) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,8,\'
            Генеральная доверенность на руководителя (легализованная) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,9,\'
            Копия удостоверения личности на директора ТОО гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,10,\'         
            Легализованная/апостилированные копии и переводы документов об образовании, соответствующие профилю компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,11,\'
            Опыт работы на аналогичной должности от 3 до 5 лет с приложением письменного подтверждения о трудовой деятельности работника на официальном бланке работодателя, у которого ранее работал работник, или иных подтверждающих документов, признаваемых в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,12,\'
            Информация о местном содержании в кадрах (штатное расписание компании и количество сотрудников в компании (для выявления процентного соотношения)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,13,\'
            Паспорт директора нерезидента, переведенный на русский/казахский язык и нот. заверенный казахстанским нотариусом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,14,\'
            Государственная пошлина  около 225 МРП (510,525 тенге), для первой категории работников\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,15,\'
            Открытый счет на компанию в банке\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,16,\'                                              
            Письмо в УМП ДВД на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,17,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,18,\'
            Копия генеральной доверенности на руководителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,19,\'
            Приказ о назначении на должность директора\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (118,20,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (118,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала; Рабочее разрешение на директора нерезидента\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (118,2100,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (119,34,\'Получение рабочего разрешения на директора нерезидента\',5,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,2,\'                                                                          
            Копия заверенная копия Устава головной компании с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,3,\'
            Копия заверенная выписка из торгового реестра или его аналог с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,4,\'
            Копия заверенный протокол, либо решение об учётной регистрации филиала в РК с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,5,\'
            Копия заверенное положение филиала с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,6,\'
            Копия заверенная свидетельства о регистрации компании или аналога (например: ОГРН) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,8,\'
            Генеральная доверенность на руководителя (легализованная) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,9,\'
            Копия удостоверения личности на директора ТОО гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,10,\'         
            Легализованная/апостилированные копии и переводы документов об образовании, соответствующие профилю компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,11,\'
            Опыт работы на аналогичной должности от 3 до 5 лет с приложением письменного подтверждения о трудовой деятельности работника на официальном бланке работодателя, у которого ранее работал работник, или иных подтверждающих документов, признаваемых в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,12,\'
            Информация о местном содержании в кадрах (штатное расписание компании и количество сотрудников в компании (для выявления процентного соотношения)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,13,\'
            Паспорт директора нерезидента, переведенный на русский/казахский язык и нот. заверенный казахстанским нотариусом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,14,\'
            Государственная пошлина  около 225 МРП (510,525 тенге), для первой категории работников\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,15,\'
            Открытый счет на компанию в банке\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,16,\'                                              
            Письмо в УМП ДВД на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,17,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,18,\'
            Копия генеральной доверенности на руководителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,19,\'
            Приказ о назначении на должность директора\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (119,20,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (119,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала; Рабочее разрешение на директора нерезидента\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (119,2100,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (120,34,\'Постановка на учет в УМП ДВД\',6,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,2,\'                                                                          
            Копия заверенная копия Устава головной компании с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,3,\'
            Копия заверенная выписка из торгового реестра или его аналог с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,4,\'
            Копия заверенный протокол, либо решение об учётной регистрации филиала в РК с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,5,\'
            Копия заверенное положение филиала с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,6,\'
            Копия заверенная свидетельства о регистрации компании или аналога (например: ОГРН) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,8,\'
            Генеральная доверенность на руководителя (легализованная) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,9,\'
            Копия удостоверения личности на директора ТОО гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,10,\'         
            Легализованная/апостилированные копии и переводы документов об образовании, соответствующие профилю компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,11,\'
            Опыт работы на аналогичной должности от 3 до 5 лет с приложением письменного подтверждения о трудовой деятельности работника на официальном бланке работодателя, у которого ранее работал работник, или иных подтверждающих документов, признаваемых в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,12,\'
            Информация о местном содержании в кадрах (штатное расписание компании и количество сотрудников в компании (для выявления процентного соотношения)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,13,\'
            Паспорт директора нерезидента, переведенный на русский/казахский язык и нот. заверенный казахстанским нотариусом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,14,\'
            Государственная пошлина  около 225 МРП (510,525 тенге), для первой категории работников\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,15,\'
            Открытый счет на компанию в банке\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,16,\'                                              
            Письмо в УМП ДВД на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,17,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,18,\'
            Копия генеральной доверенности на руководителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,19,\'
            Приказ о назначении на должность директора\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (120,20,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (120,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала; Рабочее разрешение на директора нерезидента\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (120,2100,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (121,34,\'Cмена руководителя с гражданина РК на директора нерезидента\',7,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,1,\'Копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,2,\'                                                                          
            Копия заверенная копия Устава головной компании с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,3,\'
            Копия заверенная выписка из торгового реестра или его аналог с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,4,\'
            Копия заверенный протокол, либо решение об учётной регистрации филиала в РК с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,5,\'
            Копия заверенное положение филиала с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,6,\'
            Копия заверенная свидетельства о регистрации компании или аналога (например: ОГРН) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,8,\'
            Генеральная доверенность на руководителя (легализованная) с нотариально заверенным переводом на русский или казахский языки\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,9,\'
            Копия удостоверения личности на директора ТОО гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,10,\'         
            Легализованная/апостилированные копии и переводы документов об образовании, соответствующие профилю компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,11,\'
            Опыт работы на аналогичной должности от 3 до 5 лет с приложением письменного подтверждения о трудовой деятельности работника на официальном бланке работодателя, у которого ранее работал работник, или иных подтверждающих документов, признаваемых в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,12,\'
            Информация о местном содержании в кадрах (штатное расписание компании и количество сотрудников в компании (для выявления процентного соотношения)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,13,\'
            Паспорт директора нерезидента, переведенный на русский/казахский язык и нот. заверенный казахстанским нотариусом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,14,\'
            Государственная пошлина  около 225 МРП (510,525 тенге), для первой категории работников\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,15,\'
            Открытый счет на компанию в банке\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,16,\'                                              
            Письмо в УМП ДВД на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,17,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,18,\'
            Копия генеральной доверенности на руководителя\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,19,\'
            Приказ о назначении на должность директора\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (121,20,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (121,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала; Рабочее разрешение на директора нерезидента\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (121,2100,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (10, 10, \'Регистрация филиала/представительства - Регистрация филиала/представительства (учредитель юр.лицо нерезидент)\', \'Регистрация филиала/представительства - Регистрация филиала/представительства (учредитель юр.лицо нерезидент)\');
            ');
            
            //service - 420
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      35, 10,  
                      \'420\',
                      \'Регистрация филиала/представительства учредитель юр.лицо нерезидент, директор РК\' ,
                      \'Регистрация филиала/представительства учредитель юр.лицо нерезидент, директор РК\',
                      15,
                      45,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (122,35,\'Учетная регистрация филиала/представительства\',1,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (122,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (122,2,\'    Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (122,3,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (122,4,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (122,5,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (122,6,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (122,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (122,8,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (122,9,\'
            Удостоверение личности гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (122,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; Полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (122,600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (123,35,\'Получение ИИН на учредителя и директора головной компании\',2,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (123,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (123,2,\'    Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (123,3,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (123,4,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (123,5,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (123,6,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (123,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (123,8,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (123,9,\'
            Удостоверение личности гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (123,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; Полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (123,600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (124,35,\'Получение БИН и ЭЦП на головную компанию\',3,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (124,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (124,2,\'    Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (124,3,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (124,4,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (124,5,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (124,6,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (124,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (124,8,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (124,9,\'
            Удостоверение личности гражданина РК\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (124,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; Полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (124,600,2,null,\'2018-01-01\');
            ');
            
            //service - 430
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      36, 10,  
                      \'430\',
                      \'Регистрация филиала/представительства учредитель юр.лицо нерезидент, директор ЕВРАЗЭС\' ,
                      \'Регистрация филиала/представительства учредитель юр.лицо нерезидент, директор ЕВРАЗЭС\',
                      10,
                      40,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (125,36,\'Получение ИИН на учредителя и директора головной компании\',1,true,10,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (125,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (125,2,\'
            Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (125,3,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (125,4,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (125,5,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (125,6,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (125,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (125,8,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (125,9,\'
            Легализованная/Апостилированная копия паспорта директора, все с переводом на казахский и русский языки   удостоверенным нотариально\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (125,10,\'
            Нотариально заверенная копия паспорта гражданина ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (125,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; Полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (125,600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (126,36,\'Получение ИИН и ЭЦП на директора филиала резидента ЕВРАЗЭС\',2,true,10,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (126,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (126,2,\'
            Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (126,3,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (126,4,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (126,5,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (126,6,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (126,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (126,8,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (126,9,\'
            Легализованная/Апостилированная копия паспорта директора, все с переводом на казахский и русский языки   удостоверенным нотариально\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (126,10,\'
            Нотариально заверенная копия паспорта гражданина ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (126,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; Полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (126,600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (127,36,\'Получение БИН и ЭЦП на головную компанию\',3,true,10,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (127,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (127,2,\'
            Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (127,3,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (127,4,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (127,5,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (127,6,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (127,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (127,8,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (127,9,\'
            Легализованная/Апостилированная копия паспорта директора, все с переводом на казахский и русский языки   удостоверенным нотариально\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (127,10,\'
            Нотариально заверенная копия паспорта гражданина ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (127,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; Полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (127,600,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (128,36,\'Учетная регистрация филиала/представительства\',4,true,10,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (128,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (128,2,\'
            Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (128,3,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (128,4,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (128,5,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (128,6,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (128,7,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (128,8,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (128,9,\'
            Легализованная/Апостилированная копия паспорта директора, все с переводом на казахский и русский языки   удостоверенным нотариально\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (128,10,\'
            Нотариально заверенная копия паспорта гражданина ЕВРАЗЭС\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (128,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; Полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (128,600,2,null,\'2018-01-01\');
            ');
            
            //service - 440
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      37, 10,  
                      \'440\',
                      \'Регистрация филиала/представительства учредитель юр.лицо нерезидент, директор нерезидент\' ,
                      \'Регистрация филиала/представительства учредитель юр.лицо нерезидент, директор нерезидент\',
                      45,
                      315,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (129,37,\'Получение ИИН на учредителя и директора головной компании\',1,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)  2. Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,2,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,3,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,4,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,5,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,6,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,7,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,8,\'
            Справка, удостоверяющая отсутствие долга перед налоговой организацией\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,9,\'
            Квитанция об уплате государственной пошлины в «Сбербанк» в Управление Миграционной полиции ДВД Республики Казахстан (0.5 МРП- 1134,50 тг)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,10,\'                                                                              
            Визовая анкета на получение визы с цветной либо черно-белой фотографией размером 3,5х4,5 см\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,11,\'
            Оригинал паспорта нерезидента\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,12,\'
            Оригинал платежных документов, подтверждающих уплату консульского сбора или государственной пошлины\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,13,\'                                        Письмо в УМП ДВД г. Алматы на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,14,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (129,15,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (129,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (129,800,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (130,37,\'Получение ИИН и ЭЦП на директора нерезидента\',2,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)  2. Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,2,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,3,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,4,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,5,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,6,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,7,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,8,\'
            Справка, удостоверяющая отсутствие долга перед налоговой организацией\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,9,\'
            Квитанция об уплате государственной пошлины в «Сбербанк» в Управление Миграционной полиции ДВД Республики Казахстан (0.5 МРП- 1134,50 тг)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,10,\'                                                                              
            Визовая анкета на получение визы с цветной либо черно-белой фотографией размером 3,5х4,5 см\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,11,\'
            Оригинал паспорта нерезидента\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,12,\'
            Оригинал платежных документов, подтверждающих уплату консульского сбора или государственной пошлины\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,13,\'                                        Письмо в УМП ДВД г. Алматы на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,14,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (130,15,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (130,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (130,800,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (131,37,\'Получение БИН и ЭЦП на головную компанию\',3,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)  2. Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,2,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,3,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,4,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,5,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,6,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,7,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,8,\'
            Справка, удостоверяющая отсутствие долга перед налоговой организацией\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,9,\'
            Квитанция об уплате государственной пошлины в «Сбербанк» в Управление Миграционной полиции ДВД Республики Казахстан (0.5 МРП- 1134,50 тг)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,10,\'                                                                              
            Визовая анкета на получение визы с цветной либо черно-белой фотографией размером 3,5х4,5 см\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,11,\'
            Оригинал паспорта нерезидента\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,12,\'
            Оригинал платежных документов, подтверждающих уплату консульского сбора или государственной пошлины\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,13,\'                                        Письмо в УМП ДВД г. Алматы на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,14,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (131,15,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (131,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (131,800,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (132,37,\'Учетная регистрация филиала/представительства\',4,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)  2. Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,2,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,3,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,4,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,5,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,6,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,7,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,8,\'
            Справка, удостоверяющая отсутствие долга перед налоговой организацией\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,9,\'
            Квитанция об уплате государственной пошлины в «Сбербанк» в Управление Миграционной полиции ДВД Республики Казахстан (0.5 МРП- 1134,50 тг)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,10,\'                                                                              
            Визовая анкета на получение визы с цветной либо черно-белой фотографией размером 3,5х4,5 см\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,11,\'
            Оригинал паспорта нерезидента\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,12,\'
            Оригинал платежных документов, подтверждающих уплату консульского сбора или государственной пошлины\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,13,\'                                        Письмо в УМП ДВД г. Алматы на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,14,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (132,15,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (132,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (132,800,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (133,37,\'Получение рабочей визы\',5,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)  2. Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,2,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,3,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,4,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,5,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,6,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,7,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,8,\'
            Справка, удостоверяющая отсутствие долга перед налоговой организацией\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,9,\'
            Квитанция об уплате государственной пошлины в «Сбербанк» в Управление Миграционной полиции ДВД Республики Казахстан (0.5 МРП- 1134,50 тг)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,10,\'                                                                              
            Визовая анкета на получение визы с цветной либо черно-белой фотографией размером 3,5х4,5 см\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,11,\'
            Оригинал паспорта нерезидента\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,12,\'
            Оригинал платежных документов, подтверждающих уплату консульского сбора или государственной пошлины\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,13,\'                                        Письмо в УМП ДВД г. Алматы на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,14,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (133,15,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (133,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (133,800,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (134,37,\'Постановка на учет в УМП ДВД\',6,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)  2. Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,2,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,3,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,4,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,5,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,6,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,7,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,8,\'
            Справка, удостоверяющая отсутствие долга перед налоговой организацией\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,9,\'
            Квитанция об уплате государственной пошлины в «Сбербанк» в Управление Миграционной полиции ДВД Республики Казахстан (0.5 МРП- 1134,50 тг)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,10,\'                                                                              
            Визовая анкета на получение визы с цветной либо черно-белой фотографией размером 3,5х4,5 см\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,11,\'
            Оригинал паспорта нерезидента\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,12,\'
            Оригинал платежных документов, подтверждающих уплату консульского сбора или государственной пошлины\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,13,\'                                        Письмо в УМП ДВД г. Алматы на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,14,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (134,15,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (134,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (134,800,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (135,37,\'Смена руководителя филиала с гражданина РК на нерезидента РК\',7,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,1,\'Легализованная/Апостилированная копия паспорта учредителя и директора головной компании, и все страницы, с нотариально засвидетельствованным переводом на русский и казахский языки (2 экз)  2. Легализованная/Апостилированная копия Устава головной компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,2,\'
            Легализованная/Апостилированная выписка из торгового реестра или его аналог\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,3,\'
            Легализованный/Апостилированный протокол, либо решение об учётной регистрации филиала в РК\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,4,\'
            Легализованное/Апостилированное положение филиала\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,5,\'
            Легализованная/Апостилированная копия свидетельства о регистрации компании или аналога (например: ОГРН)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,6,\'
            Место нахождения филиала (юридический адрес)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,7,\'
            Генеральная доверенность на руководителя (легализованная)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,8,\'
            Справка, удостоверяющая отсутствие долга перед налоговой организацией\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,9,\'
            Квитанция об уплате государственной пошлины в «Сбербанк» в Управление Миграционной полиции ДВД Республики Казахстан (0.5 МРП- 1134,50 тг)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,10,\'                                                                              
            Визовая анкета на получение визы с цветной либо черно-белой фотографией размером 3,5х4,5 см\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,11,\'
            Оригинал паспорта нерезидента\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,12,\'
            Оригинал платежных документов, подтверждающих уплату консульского сбора или государственной пошлины\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,13,\'                                        Письмо в УМП ДВД г. Алматы на фирменном бланке компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,14,\'
            Оригинал паспорта с визой С3 и миграционной карточкой\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (135,15,\'
            Трудовой договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (135,\'Справка о регистрации филиала; ИИН на учредителя и директора головной компании, директора филиала; БИН и ЭЦП на головную компанию; полный пакет учредительных документов филиала\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (135,800,2,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (11, 10, \'Перерегистрация и внесение изменеий и дополнений в учредительные документы юридического лица - Смена участников ТОО\', \'Перерегистрация и внесение изменеий и дополнений в учредительные документы юридического лица - Смена участников ТОО\');
            ');
            
            //service - 450
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      38, 11,  
                      \'450\',
                      \'Измение уставного капитала\' ,
                      \'Измение уставного капитала\',
                      3,
                      3,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (136,38,\'Измение уставного капитала\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (136,1,\'ПЕРЕРЕГИСТРАЦИЯ:                                                                                                    если уменьшается уставный капитал юридического лица – указать сумму, распределение долей в процентном и денежном выражении (товарищество обязано направить всем своим кредиторам письменные уведомления об уменьшении уставного капитала либо поместить соответствующее объявление в официальном издании «Юридическая газета» или «Заң газеті»);                                                                                                                            ВНЕСЕНИЕ ИЗМЕНЕНИЙ И ДОПОЛНЕНИЙ:                                                       если увеличивается уставный капитал – указать сумму, распределение долей в процентном и денежном выражении\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (136,\'Перерегистрация либо внесенние изменений и дополнений в учредительные документы юридического лица с новым измененным уставным капиталом\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (136,20000,1,null,\'2018-01-01\');
            ');
            
            //service - 460
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      39, 11,  
                      \'460\',
                      \'Смена юридического адреса\' ,
                      \'Смена юридического адреса\',
                      3,
                      3,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (137,39,\'Смена юридического адреса\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (137,1,\'Подлинники прежних учредительных документов юридического лица\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (137,2,\'
            Копия удостоверения личности директора\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (137,3,\'
            Предоставляется договор аренды либо заявление (согласие) собственника недвижимости на предоставление юридического адреса и справка об уточнении объекта недвижимости (с регистрационным кодом)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (137,4,\'
            Заполнение формы на внесение изменений и дополнений в учредительные документы\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (137,\'Внесенние изменений и дополнений в учредительные документы юридического лица с новым зарегистрированным  юридическим адресом\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (137,15000,1,null,\'2018-01-01\');
            ');
            
            //service - 470
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      40, 11,  
                      \'470\',
                      \'Смена исполнительного органа\' ,
                      \'Смена исполнительного органа\',
                      3,
                      3,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (138,40,\'Смена исполнительного органа\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (138,1,\'Подлинники прежних учредительных документов юридического лица\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (138,2,\'
            Копия удостоверения личности директора, либо нотариально заверенная копия паспорта учредителя гражданина страны-участника ЕВРАЗЭС, с нотариально заверенным переводом на русский и казахский язык либо Легализованная/Апостилированная копия паспорта нерезидента, с нотариально заверенным переводом на казахский и русский язык\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (138,3,\'
            Заполнение формы на внесение изменений и дополнений в учредительные документы\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (138,4,\'
            \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (138,\'Внесенние изменений и дополнений в учредительные документы юридического лица с новым зарегистрированным Руководителем/Директором\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (138,15000,1,null,\'2018-01-01\');
            ');
            
            //service - 480
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      41, 11,  
                      \'480\',
                      \'Изменение паспортных данных участников юридического лица\' ,
                      \'Изменение паспортных данных участников юридического лица\',
                      3,
                      3,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (139,41,\'Изменение паспортных данных участников юридического лица\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (139,1,\'Подлинники прежних учредительных документов юридического лица\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (139,2,\'
            Копия удостоверения личности участника/директора с новыми личными данными\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (139,3,\'
            Заполнение формы на внесение изменений и дополнений в учредительные документы\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (139,\'Внесенние изменений и дополнений в учредительные документы юридического лица с новым паспортными данными участника\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (139,15000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (12, 10, \'Реорганизация бизнеса - Ликвидация бизнеса\', \'Реорганизация бизнеса - Ликвидация бизнеса\');
            ');
            
            //service - 490
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      42, 12,  
                      \'490\',
                      \'Банкротство\' ,
                      \'Банкротство\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (140,42,\'Подготовка заявления в суд о признаии банкротом, представление интересов в суде, с временными администраторами, управляющим, кредиторами\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (140,1,\'Решение собственника его имущества, уполномоченного им органа или учредителей (участников), органов юридического лица, являющееся основанием обращения должника в суд с заявлением о признании его банкротом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (140,2,\'
            Финансовая отчетность за три последних года и на момент подачи заявления, налоговая отчетность по всем обязательствам должника за указанный период, перечень всех кредиторов и дебиторов (индивидуальный идентификационный номер или бизнес-идентификационный номер, Ф. И. О. (при его наличии) и (или) полное наименование, юридический адрес) с указанием сумм и даты образования соответствующей задолженности (в случае наличия дочерних организаций также прилагается консолидированная финансовая отчетность)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (140,3,\'
            Протокол собрания (конференции) кредиторов по оплате труда, на котором тайным голосованием избран их представитель для участия в деле о банкротстве\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (140,4,\'
            Копии учредительных документов\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (140,5,\'Заключение уполномоченного органа, осуществляющего руководство в сферах естественных монополий и на регулируемых рынках, представляемое им в срок, не превышающий 10 календарных дней с момента получения письменного уведомления должника об обращении в суд, о признании его банкротом, в случае, если должник является субъектом естественной монополии\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (140,6,\'
            Заключение антимонопольного органа, представляемое им в течение 10 рабочих дней с момента получения письменного уведомления должника об обращении в суд, о признании его банкротом, в случае, если должник является субъектом рынка, занимающим доминирующее (монопольное) положение на соответствующем товарном рынке\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (140,7,\'
            Сведения о принятых к производству судами исков к должнику, а также о требованиях, предъявленных к бесспорному (безакцептному) списанию\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (140,8,\'
            \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (140,\'Признаие юр лица банкротом\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (140,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (13, 10, \'Реорганизация бизнеса - Структурирование бизнеса\', \'Реорганизация бизнеса - Структурирование бизнеса\');
            ');
            
            //service - 500
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      43, 13,  
                      \'500\',
                      \'Разработка модели группы компании\' ,
                      \'Разработка модели группы компании\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (141,43,\'Полная первичная документация по всем видам деятельности\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (141,1,\'Нормативно правовая база\',null);
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (141,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (142,43,\'Ознакомление с предоставленными материалами\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (142,1,\'Полная первичная документация по всем видам деятельности\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (142,\'Создание нескольких юр лиц в зависимости от количества видов деятельности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (142,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (143,43,\'Распределение видов деятельности по группам\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (143,1,\'Полная первичная документация по всем видам деятельности\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (143,\'Создание нескольких юр лиц в зависимости от количества видов деятельности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (143,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (144,43,\'Разработка модели группы компании\',4,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (144,1,\'Полная первичная документация по всем видам деятельности\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (144,\'Создание нескольких юр лиц в зависимости от количества видов деятельности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (144,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (145,43,\'Создание компаний\',5,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (145,1,\'Полная первичная документация по всем видам деятельности\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (145,\'Создание нескольких юр лиц в зависимости от количества видов деятельности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (145,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (146,43,\'Распределение активов\',6,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (146,1,\'Полная первичная документация по всем видам деятельности\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (146,\'Создание нескольких юр лиц в зависимости от количества видов деятельности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (146,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (14, 10, \'Перемещение активов - Участие в переговорах на стороне клиента\', \'Перемещение активов - Участие в переговорах на стороне клиента\');
            ');
            
            //service - 510
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) 
                values
                  (
                      44, 14,  
                      \'510\',
                      \'Представительство\' ,
                      \'Представительство\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (147,44,\'Ознакомление предметом встречи\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (147,1,\'Вся первичная документация по предмету встречи - предоставляется клиентом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (147,2,\'Нормативно правовые акты регулирующие предмет встречи - собирается представителем компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (147,3,\'Клиент несет ответственность за непредставленную либо не полностью предоставленную информацию по предмету встречи, вследствие чего может привести к ухудшению интересов клиента\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (147,\'Письменные рекомендации по итогам встречи\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (147,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (148,44,\'Непосредственное участие либо ведение переговоров в интересах клиента\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (148,1,\'Вся первичная документация по предмету встречи - предоставляется клиентом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (148,2,\'Нормативно правовые акты регулирующие предмет встречи - собирается представителем компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (148,3,\'Клиент несет ответственность за непредставленную либо не полностью предоставленную информацию по предмету встречи, вследствие чего может привести к ухудшению интересов клиента\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (148,\'Письменные рекомендации по итогам встречи\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (148,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (149,44,\'Выработка рекомендаций клиенту по итогам встречи\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (149,1,\'Вся первичная документация по предмету встречи - предоставляется клиентом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (149,2,\'Нормативно правовые акты регулирующие предмет встречи - собирается представителем компании\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (149,3,\'Клиент несет ответственность за непредставленную либо не полностью предоставленную информацию по предмету встречи, вследствие чего может привести к ухудшению интересов клиента\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (149,\'Письменные рекомендации по итогам встречи\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (149,0,1,null,\'2018-01-01\');
            ');
                        
                        
            DB::commit();

        } catch  (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
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
