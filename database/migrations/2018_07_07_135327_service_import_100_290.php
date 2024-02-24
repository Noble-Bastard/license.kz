<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceImport100290 extends Migration
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
                insert into service_category(id, name, description)
                values
                  (10, \'Корпоративное Право\', \'Корпоративное Право\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (4, 10, \'Регистрация бизнеса\', \'Регистрация бизнеса\');
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
                (13,7,\'1 этап\',1,true,2,1,true);
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
                (14,8,\'1 этап\',1,true,2,1,true);
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
                (15,9,\'1 этап\',1,true,2,1,true);
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
                (16,10,\'1 этап\',1,true,2,1,true);
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
                  (5, 10, \' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)\', \' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)\');
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
                (18,1,\'см. услугу получение ЭЦП на учредителя (на физ.лицо РК)\',null);
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
                insert into service_step_result (service_step_id, description)
                values
                (19,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы\');
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
                insert into service_step_result (service_step_id, description)
                values
                (20,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы\');
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
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы\');
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
                insert into service_step_result (service_step_id, description)
                values
                (22,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (23,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (25,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (27,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (28,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (30,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (31,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (32,30000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (6, 10, \'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)\', \'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)\');
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
                insert into service_step_result (service_step_id, description)
                values
                (33,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (34,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (36,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (37,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (39,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (40,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (41,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (42,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (43,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (44,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (46,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы\');
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
                insert into service_step_result (service_step_id, description)
                values
                (47,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы\');
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
                insert into service_step_result (service_step_id, description)
                values
                (48,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы\');
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
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы\');
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
                insert into service_step_result (service_step_id, description)
                values
                (50,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (51,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (52,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (54,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (55,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (56,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
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
                insert into service_step_result (service_step_id, description)
                values
                (57,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (57,260000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (58,22,\'Получение письма-приглашения с номером визовой поддержки\',5,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (58,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (58,260000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (59,22,\'Постановка в течении 5 (пяти) календарных суток на регистрационный учёт в УМС ДВД (по месту нахождения) по факту въезда на территорию Республики Казахстан.\',6,true,30,1,true);
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
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (59,260000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (60,22,\'Регистрация компании в реестре Миграционной Полиции\',7,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (60,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (60,260000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (61,22,\'Подача заявления в уполномоченный орган о смене директора на нерезидента Республике Казахстан\',8,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (61,\'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
            - ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (61,260000,1,null,\'2018-01-01\');
            ');



            DB::commit();

        } catch
        (\Exception $e) {
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
