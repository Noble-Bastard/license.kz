<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceImport520980 extends Migration
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


            Schema::table('service_step', function(Blueprint $table)
            {
                $table->string('description',4096)->change();
            });


            Schema::table('service_step_required_document', function(Blueprint $table)
            {
                $table->string('description',4096)->change();
            });

            DB::statement('                    
                update service 
                set
                 counter_type_id = 1
                where counter_type_id is null;                     
            ');


            DB::statement('
                insert into service_category(id, name, description)
                values
                  (11, \'Визы для бизнеса в РК\', \'Визы для бизнеса в РК\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (15, 11, \'Миграционные услуги\', \'Миграционные услуги\');
            ');
            
            //service - 520
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      45, 15,  
                      \'520\',
                      \'Виза А5\' ,
                      \'Виза А5\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (150,45,\'\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (150,0,1,null,\'2018-01-01\');
            ');
            
            //service - 530
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      46, 15,  
                      \'530\',
                      \'Виза B1\' ,
                      \'Виза B1\',
                      14,
                      56,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (151,46,\'Получение регистрационного номера приглашающей компании\',1,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (151,1,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, приказ юридического лица о назначении своего представителя для сдачи документов или доверенность; в случае внесения изменений в Устав - копии документов, подтверждающих данные изменения (приказ, решения и т.д.)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (151,2,\'
            Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц); документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; документ, подтверждающий проведение конференций, симпозиумов, форумов, выставок, концертов, культурных, научных, спортивных и других мероприятий\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (151,3,\'                                                  Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); иные документы, запрашиваемые консулом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (151,4,\'  Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (151,5,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (151,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (151,60000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (152,46,\'Получение номера визовой поддержки\',2,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (152,1,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, приказ юридического лица о назначении своего представителя для сдачи документов или доверенность; в случае внесения изменений в Устав - копии документов, подтверждающих данные изменения (приказ, решения и т.д.)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (152,2,\'
            Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц); документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; документ, подтверждающий проведение конференций, симпозиумов, форумов, выставок, концертов, культурных, научных, спортивных и других мероприятий\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (152,3,\'                                                  Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); иные документы, запрашиваемые консулом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (152,4,\'  Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (152,5,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (152,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (152,60000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (153,46,\'Получение визы в загранучреждениях РК\',3,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (153,1,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, приказ юридического лица о назначении своего представителя для сдачи документов или доверенность; в случае внесения изменений в Устав - копии документов, подтверждающих данные изменения (приказ, решения и т.д.)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (153,2,\'
            Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц); документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; документ, подтверждающий проведение конференций, симпозиумов, форумов, выставок, концертов, культурных, научных, спортивных и других мероприятий\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (153,3,\'                                                  Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); иные документы, запрашиваемые консулом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (153,4,\'  Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (153,5,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (153,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (153,60000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (154,46,\'Постановка на регистрационный учет в органы миграционной службы\',4,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (154,1,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, приказ юридического лица о назначении своего представителя для сдачи документов или доверенность; в случае внесения изменений в Устав - копии документов, подтверждающих данные изменения (приказ, решения и т.д.)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (154,2,\'
            Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц); документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; документ, подтверждающий проведение конференций, симпозиумов, форумов, выставок, концертов, культурных, научных, спортивных и других мероприятий\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (154,3,\'                                                  Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); иные документы, запрашиваемые консулом\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (154,4,\'  Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (154,5,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (154,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (154,60000,1,null,\'2018-01-01\');
            ');
            
            //service - 540
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      47, 15,  
                      \'540\',
                      \'Виза B2\' ,
                      \'Виза B2\',
                      14,
                      56,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (155,47,\'Постановка на регистрационный учет приглашающей компании\',1,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (155,1,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, приказ юридического лица о назначении своего представителя для сдачи документов или доверенность; в случае внесения изменений в Устав - копии документов, подтверждающих данные изменения (приказ, решения и т.д.)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (155,2,\'  Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (155,3,\'Документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; Документ, подтверждающий осуществление монтажа, ремонта и технического обслуживания, оказания консультационных или аудиторских услуг (соответствующий договор)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (155,4,\'Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); Иные документы, запрашиваемые консулом.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (155,5,\'Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); Оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (155,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (155,60000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (156,47,\'Получение номера визовой поддержки\',2,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (156,1,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, приказ юридического лица о назначении своего представителя для сдачи документов или доверенность; в случае внесения изменений в Устав - копии документов, подтверждающих данные изменения (приказ, решения и т.д.)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (156,2,\'  Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (156,3,\'Документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; Документ, подтверждающий осуществление монтажа, ремонта и технического обслуживания, оказания консультационных или аудиторских услуг (соответствующий договор)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (156,4,\'Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); Иные документы, запрашиваемые консулом.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (156,5,\'Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); Оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (156,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (156,60000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (157,47,\'Получение визы в загранучреждениях РК\',3,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (157,1,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, приказ юридического лица о назначении своего представителя для сдачи документов или доверенность; в случае внесения изменений в Устав - копии документов, подтверждающих данные изменения (приказ, решения и т.д.)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (157,2,\'  Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (157,3,\'Документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; Документ, подтверждающий осуществление монтажа, ремонта и технического обслуживания, оказания консультационных или аудиторских услуг (соответствующий договор)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (157,4,\'Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); Иные документы, запрашиваемые консулом.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (157,5,\'Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); Оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (157,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (157,60000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (158,47,\'Регистрация иностранца по въезду в Республику Казахстан\',4,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (158,1,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, приказ юридического лица о назначении своего представителя для сдачи документов или доверенность; в случае внесения изменений в Устав - копии документов, подтверждающих данные изменения (приказ, решения и т.д.)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (158,2,\'  Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (158,3,\'Документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; Документ, подтверждающий осуществление монтажа, ремонта и технического обслуживания, оказания консультационных или аудиторских услуг (соответствующий договор)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (158,4,\'Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); Иные документы, запрашиваемые консулом.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (158,5,\'Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); Оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (158,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (158,60000,1,null,\'2018-01-01\');
            ');
            
            //service - 550
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      48, 15,  
                      \'550\',
                      \'Виза B3\' ,
                      \'Виза B3\',
                      14,
                      56,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (159,48,\'Получение регистрационного номера приглашающей компании\',1,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (159,1,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, приказ юридического лица о назначении своего представителя для сдачи документов или доверенность;
            принимающая сторона, ходатайствующая о приглашении членов совета директоров – копию протокола общего собрания акционеров об избрании членов совета директоров;  в случае внесения изменений в Устав - копии документов, подтверждающих данные изменения (приказ, решения и т.д.)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (159,2,\'Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц); документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; документ, подтверждающий намерение проведения переговоров, заключение контракта (соответствующий договор), копию протокола общего собрания акционеров об избрании членов совета директоров\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (159,3,\'Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); иные документы, запрашиваемые консулом.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (159,4,\'  Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (159,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (159,60000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (160,48,\'Получение номера визовой поддержки\',2,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (160,1,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, приказ юридического лица о назначении своего представителя для сдачи документов или доверенность;
            принимающая сторона, ходатайствующая о приглашении членов совета директоров – копию протокола общего собрания акционеров об избрании членов совета директоров;  в случае внесения изменений в Устав - копии документов, подтверждающих данные изменения (приказ, решения и т.д.)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (160,2,\'Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц); документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; документ, подтверждающий намерение проведения переговоров, заключение контракта (соответствующий договор), копию протокола общего собрания акционеров об избрании членов совета директоров\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (160,3,\'Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); иные документы, запрашиваемые консулом.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (160,4,\'  Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (160,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (160,60000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (161,48,\'Получение визы в загранучреждениях РК      \',3,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (161,1,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, приказ юридического лица о назначении своего представителя для сдачи документов или доверенность;
            принимающая сторона, ходатайствующая о приглашении членов совета директоров – копию протокола общего собрания акционеров об избрании членов совета директоров;  в случае внесения изменений в Устав - копии документов, подтверждающих данные изменения (приказ, решения и т.д.)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (161,2,\'Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц); документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; документ, подтверждающий намерение проведения переговоров, заключение контракта (соответствующий договор), копию протокола общего собрания акционеров об избрании членов совета директоров\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (161,3,\'Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); иные документы, запрашиваемые консулом.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (161,4,\'  Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (161,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (161,60000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (162,48,\'Постановка на регистрационный учет в органы миграционной службы    \',4,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (162,1,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, приказ юридического лица о назначении своего представителя для сдачи документов или доверенность;
            принимающая сторона, ходатайствующая о приглашении членов совета директоров – копию протокола общего собрания акционеров об избрании членов совета директоров;  в случае внесения изменений в Устав - копии документов, подтверждающих данные изменения (приказ, решения и т.д.)\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (162,2,\'Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц); документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; документ, подтверждающий намерение проведения переговоров, заключение контракта (соответствующий договор), копию протокола общего собрания акционеров об избрании членов совета директоров\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (162,3,\'Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); иные документы, запрашиваемые консулом.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (162,4,\'  Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (162,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (162,60000,1,null,\'2018-01-01\');
            ');
            
            //service - 560
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      49, 15,  
                      \'560\',
                      \'Получение визы С5 (бизнес-иммигрант)\' ,
                      \'Получение визы С5 (бизнес-иммигрант)\',
                      15,
                      57,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (163,49,\'Получение ходатайства в местном исполнительном органе на нерезидента РК для получения письма-приглашения «об отсутствии возражений на ведение предпринимательской деятельности на территории Республики Казахстан» на визу категории «С5» – бизнес-иммигрант, с целью стать участником юридического лица, выступающего ходатаем\',1,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (163,1,\'Справка о зарегистрированном юридическом лице;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (163,2,\'
            Нотариально заверенная копия паспорта нерезидента Республики Казахстан с переводом на казахский/русский язык;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (163,3,\'
            Доверенность на представителя Ipravo\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (163,\'Получение однократной визы категории «С5» - бизнес-иммигрант сроком на 90 суток\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (163,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (164,49,\'Регистрация компании в реестре Управления Миграционной Полиции Департамента Внутренних Дел РК (УМП ДВД РК)\',2,true,7,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (164,1,\'Справка о государственной регистрации юридического лица;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (164,2,\'
            Справка о зарегистрированном юридическом лице;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (164,3,\'
            Нотариально заверенные копии учредительных документов: Устав, Решение учредителя/Протокол общего собрания учредителей, Приказ на директора;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (164,4,\'
            Доверенность на представителя Ipravo\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (164,\'Получение однократной визы категории «С5» - бизнес-иммигрант сроком на 90 суток\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (164,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (165,49,\'Получение письма-приглашения с номером визовой поддержки от УМП ДВД РК\',3,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (165,1,\'Справка о государственной регистрации юридического лица;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (165,2,\'
            Легализованная/апостилированная копия паспорта нерезидента (не менее 2 свободные страницы, предназначенных для виз, срок действия паспорта должен истекать не ранее 3 месяцев с даты окончания срока действия запрашиваемой визы);\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (165,3,\'
            Оригинал квитанции об уплате государственной пошлины (0.5 МРП- 1202,50 тенге);\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (165,4,\'
            Доверенность на представителя Ipravo\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (165,5,\'
            \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (165,\'Получение однократной визы категории «С5» - бизнес-иммигрант сроком на 90 суток\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (165,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (166,49,\'Получение визы в посольстве Республики Казахстан в стране нерезидента РК\',4,true,5,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (166,1,\'Визовая анкета на получение визы с цветной, либо черно-белой фотографией размером 3,5 х 4,5 сантиметров;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (166,2,\'
            Письмо-приглашение с номером визовой поддержки;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (166,3,\'
            Действительный заграничный паспорт иностранного государства предоставляющий право на пересечение Государственной границы Республики Казахстан;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (166,4,\'
            Оригинал платежных документов, подтверждающих уплату консульского сбора или государственной пошлины;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (166,5,\'
            Медицинская справка, подтверждающая отсутствие заболеваний, препятствующих трудовой деятельности;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (166,6,\'
            Медицинская страховка;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (166,7,\'
            Справка о наличии либо отсутствии судимости, выданная уполномоченным органом страны гражданства или постоянного места жительства;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (166,8,\'
            Справка о наличии либо отсутствии запрета на осуществление предпринимательской деятельности на основании решения суда, выданной уполномоченным органом страны гражданства или постоянного места жительства\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (166,\'Получение однократной визы категории «С5» - бизнес-иммигрант сроком на 90 суток\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (166,150000,1,null,\'2018-01-01\');
            ');
            
            //service - 570
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      50, 15,  
                      \'570\',
                      \'Получение визы С3 (рабочая виза)\' ,
                      \'Получение визы С3 (рабочая виза)\',
                      14,
                      70,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (167,50,\'Получение разрешения на привлечение иностранной рабочей силы в РК\',1,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (167,1,\'Процедура получения разрешения на привлечение иностранной рабочей силы описана во вкладке ""Трудовое право""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (167,2,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, справка об отсутствии налоговой задолженности\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (167,3,\'                 Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц); документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; разрешение на привлечение иностранной рабочей силы, Уведомление о выдаче разрешения\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (167,4,\'                                                                       Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); иные документы, запрашиваемые консулом.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (167,5,\'  Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (167,6,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (167,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (167,100000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (168,50,\'Получение регистрационного номера компании\',2,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (168,1,\'Процедура получения разрешения на привлечение иностранной рабочей силы описана во вкладке ""Трудовое право""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (168,2,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, справка об отсутствии налоговой задолженности\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (168,3,\'                 Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц); документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; разрешение на привлечение иностранной рабочей силы, Уведомление о выдаче разрешения\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (168,4,\'                                                                       Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); иные документы, запрашиваемые консулом.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (168,5,\'  Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (168,6,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (168,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (168,100000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (169,50,\'Получение номера визовой поддержки\',3,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (169,1,\'Процедура получения разрешения на привлечение иностранной рабочей силы описана во вкладке ""Трудовое право""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (169,2,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, справка об отсутствии налоговой задолженности\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (169,3,\'                 Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц); документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; разрешение на привлечение иностранной рабочей силы, Уведомление о выдаче разрешения\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (169,4,\'                                                                       Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); иные документы, запрашиваемые консулом.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (169,5,\'  Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (169,6,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (169,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (169,100000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (170,50,\'Получение визы в загранучреждениях РК\',4,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (170,1,\'Процедура получения разрешения на привлечение иностранной рабочей силы описана во вкладке ""Трудовое право""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (170,2,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, справка об отсутствии налоговой задолженности\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (170,3,\'                 Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц); документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; разрешение на привлечение иностранной рабочей силы, Уведомление о выдаче разрешения\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (170,4,\'                                                                       Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); иные документы, запрашиваемые консулом.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (170,5,\'  Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (170,6,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (170,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (170,100000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (171,50,\'Постановка на регистрационный учет в УМС ДВД\',5,true,14,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (171,1,\'Процедура получения разрешения на привлечение иностранной рабочей силы описана во вкладке ""Трудовое право""\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (171,2,\'Нотариально заверенная текущим годом копия Устава, справка о всех регистрационных действиях юр. лица, справка об отсутствии налоговой задолженности\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (171,3,\'                 Заполненная заявка на получение визы, копия паспорта иностранца(срок окончания действия паспорта должен превышать как минимум 6месячный срок от даты окончания действия визы и иметь не менее 2 чистых страниц); документ, подтверждающий уплату налогового сбора (0,5 МРП) с печатью банка; разрешение на привлечение иностранной рабочей силы, Уведомление о выдаче разрешения\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (171,4,\'                                                                       Письмо -приглашение с номером визовой поддержки; Оригинал паспорта (в случае замены паспорта, возникнет необходимость повторого получения номера визовой поддержки); иные документы, запрашиваемые консулом.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (171,5,\'  Подписанное клиентом письмо приглашающей организации о постановке на регистрационный учет иностранного гражданина (составляемое юристами ТОО ""Ipravo""); оригинал паспорта иностранного гражданина со всеми вложениями (миграц. карточка, свидетельство о постановке ИС ""Беркут""); 2 фото 3х4\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (171,6,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (171,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК;                                    
            Получение письма - приглашения с номером визовой поддержки для дальнейшего получения визы; Постановка на регистрационный учет, предоставляющий право законного пребывания на территории РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (171,100000,1,null,\'2018-01-01\');
            ');
            
            //service - 580
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      51, 15,  
                      \'580\',
                      \'Регистрация приглашающей компании в миграционных органах\' ,
                      \'Регистрация приглашающей компании в миграционных органах\',
                      7,
                      7,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (172,51,\'Регистрация компании в реестре Управления Миграционной Полиции Департамента Внутренних Дел РК (УМП ДВД РК)\',1,true,7,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (172,1,\'Справка о государственной регистрации юридического лица;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (172,2,\' 
            Справка о зарегистрированном юридическом лице;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (172,3,\' 
            Нотариально заверенные копии учредительных документов: Устав, Решение учредителя/Протокол общего собрания учредителей, Приказ на директора;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (172,4,\' 
            Доверенность на представителя Ipravo\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (172,5,\' \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (172,\'Получение регистрационного номера компании, находящейся в реестре УМП ДВД РК\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (172,10000,1,null,\'2018-01-01\');
            ');
            
            //service - 590
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      52, 15,  
                      \'590\',
                      \'Получение ходатайства в исполнительном органе (только для визы С5)\' ,
                      \'Получение ходатайства в исполнительном органе (только для визы С5)\',
                      15,
                      15,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (173,52,\'Получение ходатайства в местном исполнительном органе на нерезидента РК для получения письма-приглашения «об отсутствии возражений на ведение предпринимательской деятельности на территории Республики Казахстан» на визу категории «С5» – бизнес-иммигрант, с целью стать участником юридического лица, выступающего ходатаем\',1,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (173,1,\'Справка о зарегистрированном юридическом лице (в альбомном формате);\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (173,2,\'          Нотариально заверенная копия паспорта нерезидента Республики Казахстан с переводом на казахский/русский язык;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (173,3,\'                  
             Доверенность на представителя Ipravo\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (173,\'Получение ходатайства в местном исполнительном органе на нерезидента РК для получения письма-приглашения «об отсутствии возражений на ведение предпринимательской деятельности на территории Республики Казахстан» на визу категории «С5» – бизнес-иммигрант, с целью стать участником юридического лица, выступающего ходатаем\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (173,50000,1,null,\'2018-01-01\');
            ');
            
            //service - 600
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      53, 15,  
                      \'600\',
                      \'Регистрация пребывающих иностранцев\' ,
                      \'Регистрация пребывающих иностранцев\',
                      3,
                      3,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (174,53,\'Постановка в течении 5 (пяти) календарных дней на регистрационный учёт в УМП ДВД (по месту нахождения) по факту въезда на территорию Республики Казахстан\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (174,1,\'Письмо в УМП ДВД (по месту нахождения) на фирменном бланке компании;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (174,2,\'                            
            Оригинал паспорта с визой для осуществления трудовой деятельности категории «С5»   и миграционной карточкой;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (174,3,\'   Фотография 3х4 сантиметра (2 шт.)\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (174,\'Постановка в течении 5 (пяти) календарных дней на регистрационный учёт в УМП ДВД (по месту нахождения) по факту въезда на территорию Республики Казахстан\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (174,15000,1,null,\'2018-01-01\');
            ');
            
            //service - 610
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      54, 15,  
                      \'610\',
                      \'Продление действующих виз для иностранных граждан\' ,
                      \'Продление действующих виз для иностранных граждан\',
                      30,
                      60,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (175,54,\'Получение ходатайства в местном исполнительном органе на продление визы категории «С5» – бизнес-иммигрант\',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (175,1,\'Справка о зарегистрированном юридическом лице;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (175,2,\'
            Копия паспорта нерезидента Республики Казахстан;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (175,3,\'
            Копия визы категории «С5» – бизнес-иммигрант;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (175,4,\'
            Свидетельство ИИН нерезидента Республики Казахстан;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (175,5,\'
            Доверенность на представителя Ipravo\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (175,\'Получение многократной визы категории «С5» - бизнес-иммигрант сроком на 1-3 года\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (175,100000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (176,54,\'Подача документов на продление визы категории «С5» - Бизнес-иммигрант в УМП ДВД РК за 10 дней до окончания срока её действия.\',2,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (176,1,\'Заполненная визовая анкета на получение визы;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (176,2,\'
            Фотография размером 3,5 х 4,5 сантиметров;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (176,3,\'
            Оригинал паспорта нерезидента Республики Казахстан;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (176,4,\'
            Копия паспорта нерезидента Республики Казахстан;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (176,5,\'
            Оригинал квитанции об уплате государственной пошлины (30 МРП- 72 150 тенге);\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (176,6,\'
            Доверенность на представителя Ipravo\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (176,7,\'
            \',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (176,\'Получение многократной визы категории «С5» - бизнес-иммигрант сроком на 1-3 года\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (176,100000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (16, 11, \'Миграционные услуги - Представление интересов иностранных лиц в административном процессе\', \'Миграционные услуги - Представление интересов иностранных лиц в административном процессе\');
            ');
            
            //service - 620
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      55, 16,  
                      \'620\',
                      \'Консультирование по миграционным вопросам\' ,
                      \'Консультирование по миграционным вопросам\',
                      2,
                      8,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (177,55,\'Проведение переговоров по проблемной тематике клиента.\',1,true,2,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (177,1,\'Определяется при проведении переговоров с Клиентом\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (177,\'Юридическое заключение по проблемному вопросу Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (177,20000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (178,55,\'Формирование списка необходимых документов от Клиента.\',2,true,2,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (178,1,\'Определяется при проведении переговоров с Клиентом\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (178,\'Юридическое заключение по проблемному вопросу Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (178,20000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (179,55,\'Получение и анализ представленных Клиентом документов.\',3,true,2,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (179,1,\'Определяется при проведении переговоров с Клиентом\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (179,\'Юридическое заключение по проблемному вопросу Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (179,20000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (180,55,\'Формирование и формализация правовой позиции для Клиента.\',4,true,2,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (180,1,\'Определяется при проведении переговоров с Клиентом\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (180,\'Юридическое заключение по проблемному вопросу Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (180,20000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_category(id, name, description)
                values
                  (12, \'Контрактное Право\', \'Контрактное Право\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (17, 12, \'Контрактное Право\', \'Контрактное Право\');
            ');
            
            //service - 630
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      56, 17,  
                      \'630\',
                      \'Анализ договоров\' ,
                      \'Анализ договоров\',
                      3,
                      3,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (181,56,\'Рассмотрение договора\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (181,1,\'Договор\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (181,\'Договор с правками в режиме рецензирования\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (181,15000,1,null,\'2018-01-01\');
            ');
            
            //service - 640
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      57, 17,  
                      \'640\',
                      \'Составление договоров под конкретные цели и задачи\' ,
                      \'Составление договоров под конкретные цели и задачи\',
                      3,
                      6,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (182,57,\'Составление\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (182,1,\'Тех задание и особые условия договора\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (182,\'Проект договора\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (182,20000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (183,57,\'Согласование\',2,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (183,1,\'Тех задание и особые условия договора\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (183,\'Проект договора\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (183,20000,1,null,\'2018-01-01\');
            ');
            
            //service - 650
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      58, 17,  
                      \'650\',
                      \'Сопровождение изменений и прекращение договоров\' ,
                      \'Сопровождение изменений и прекращение договоров\',
                      3,
                      3,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (184,58,\'Сопровождение изменений и прекращение договоров\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (184,1,\'Тех задание на изменение условий договора, либо задание на его расторжение\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (184,\'Проект дополнений в договор, либо соглашение о расторжении\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (184,20000,1,null,\'2018-01-01\');
            ');
            
            //service - 660
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      59, 17,  
                      \'660\',
                      \'Сопровождение международных сделок на иностранных языках\' ,
                      \'Сопровождение международных сделок на иностранных языках\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (185,59,\'Проведение переговоров по интересующей Клиента сделке, а также участие в переговорах на английском языке с иностранным партнером.\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (185,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (185,\'Полное всестороннее сопровождение внешнеэкономической сделки.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (185,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (186,59,\'Проведение личных, телефонных переговоров с иностранными контрагентами, ведение переписки по электронной почте, составление и направление деловых писем, оформление и направление запросов.\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (186,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (186,\'Полное всестороннее сопровождение внешнеэкономической сделки.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (186,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (187,59,\'Организация сделки (выбор нотариуса, банка, способа взаиморасчетов, и т. д.);\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (187,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (187,\'Полное всестороннее сопровождение внешнеэкономической сделки.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (187,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (188,59,\'Оформление документации по результатам переговоров и встреч (меморандумы, внешнеторговые договоры, соглашения о намерениях).\',4,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (188,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (188,\'Полное всестороннее сопровождение внешнеэкономической сделки.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (188,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (189,59,\'Экспертиза документов, составленных для проведения международных сделок.\',5,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (189,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (189,\'Полное всестороннее сопровождение внешнеэкономической сделки.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (189,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (190,59,\'Формирование списка необходимых документов от Клиента.\',6,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (190,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (190,\'Полное всестороннее сопровождение внешнеэкономической сделки.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (190,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (191,59,\'Получение и проведение юридического анализа представленной Клиентом документации.\',7,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (191,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (191,\'Полное всестороннее сопровождение внешнеэкономической сделки.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (191,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (192,59,\'Анализ национального и иностранного законодательства, судебной практики по вопросам, составляющим предмет переговоров.\',8,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (192,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (192,\'Полное всестороннее сопровождение внешнеэкономической сделки.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (192,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (193,59,\'Формирование и формализация правовой позиции для Клиента.\',9,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (193,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (193,\'Полное всестороннее сопровождение внешнеэкономической сделки.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (193,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (194,59,\'Оформление и направление коммерческих предложений;\',10,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (194,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (194,\'Полное всестороннее сопровождение внешнеэкономической сделки.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (194,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (195,59,\'Международное сопровождение при исполнении требований партнёров, полное оформление документов для заключения международных контрактов с ними.\',11,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (195,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (195,\'Полное всестороннее сопровождение внешнеэкономической сделки.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (195,150000,1,null,\'2018-01-01\');
            ');
            
            //service - 670
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      60, 17,  
                      \'670\',
                      \'Определение правовых рисков\' ,
                      \'Определение правовых рисков\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (196,60,\'Проведение переговоров по интересующей Клиента сделке, а также участие в переговорах на английском языке с иностранным партнером\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (196,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (196,\'Юридическое заключение по выявленным правовым рискам Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (196,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (197,60,\'Формирование списка необходимых документов от Клиента\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (197,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (197,\'Юридическое заключение по выявленным правовым рискам Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (197,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (198,60,\'Получение и проведение юридического анализа представленной Клиентом документации\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (198,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (198,\'Юридическое заключение по выявленным правовым рискам Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (198,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (199,60,\'Оформление и направление коммерческих предложений\',4,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (199,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (199,\'Юридическое заключение по выявленным правовым рискам Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (199,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (200,60,\'Осуществление правового Due Diligence: 
            • Анализ учредительных документов и проверка имущественных прав владельцев компании;
            • Анализ прав компании на движимое и недвижимое имущество, финансовых вложений в капиталы других компаний (анализ титула собственности);
            • Проверка легитимности принятия решений органами управления компании;
            • Оценка законности проведения cделок;
            • Проверка на наличие споров с третьими лицами, судебных разбирательств, арестов имущества и др. обременений;
            • Выявление предпринимательских налоговых рисков, возможных претензий контрагентов и органов государственного контроля.
            • Проверка наличия необходимых лицензий и разрешений на проведение работ и осуществление деятельности;
            • Анализ соблюдения компанией законодательства о труде
            • Исследование узких областей деятельности компании, таких как проверка природопользования, внешнеэкономической деятельности, антимонопольного законодательства и т.д.\',5,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (200,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (200,\'Юридическое заключение по выявленным правовым рискам Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (200,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (201,60,\'Формирование и формализация правовой позиции для Клиента\',6,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (201,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (201,\'Юридическое заключение по выявленным правовым рискам Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (201,150000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (202,60,\'Оформление документации по результатам переговоров и анализа документации (меморандумы, юридические заключения)\',7,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (202,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (202,\'Юридическое заключение по выявленным правовым рискам Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (202,150000,1,null,\'2018-01-01\');
            ');
            
            //service - 680
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      61, 17,  
                      \'680\',
                      \'Определение правосубъектности контрагента\' ,
                      \'Определение правосубъектности контрагента\',
                      3,
                      6,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (203,61,\'Рассмотрение представленных документов\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (203,1,\'Проект договора, иные документы в зависимости от предмета договора\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (203,\'Юридическое заключение о правоспособности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (203,50000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (204,61,\'Сверка\',2,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (204,1,\'Проект договора, иные документы в зависимости от предмета договора\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (204,\'Юридическое заключение о правоспособности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (204,50000,1,null,\'2018-01-01\');
            ');
            
            //service - 690
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      62, 17,  
                      \'690\',
                      \'Правовое сопровождение инвестиционных контрактов\' ,
                      \'Правовое сопровождение инвестиционных контрактов\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (205,62,\'Проведение переговоров по интересующей Клиента сделке, а также участие в переговорах на английском языке с иностранным партнером\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (205,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (205,\'Полное всестороннее сопровождение инвестиционных контрактов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (205,300000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (206,62,\'Формирование списка необходимых документов от Клиента\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (206,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (206,\'Полное всестороннее сопровождение инвестиционных контрактов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (206,300000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (207,62,\'Получение и проведение юридического анализа представленной Клиентом документации\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (207,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (207,\'Полное всестороннее сопровождение инвестиционных контрактов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (207,300000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (208,62,\'Формирование и формализация правовой позиции для Клиента\',4,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (208,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (208,\'Полное всестороннее сопровождение инвестиционных контрактов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (208,300000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (209,62,\'Оформление и направление коммерческих предложений\',5,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (209,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (209,\'Полное всестороннее сопровождение инвестиционных контрактов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (209,300000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (210,62,\'Организация сделки:
            • Правовая проверка (legal due diligence) статуса выбранной для размещения инвестиционных объектов площадки;
            • Подготовка проектов инвестиционных договоров, протокола о намерениях с органами государственной власти;
            • Урегулирование корпоративных вопросов (создание юридического лица, подготовка корпоративных документов, вопросы найма персонала и т. д.);
            • Правовое сопровождение приобретения выбранной площадки (юридическое обеспечение сделки, участие в переговорах по условиям приобретения площадки);
            • Участие в подготовке предпроектной документации;
            • Регистрация права собственности на возведенные сооружения или объекты незавершенного строительства;
            • Консультации по импорту оборудования, в том числе в качестве вклада в уставный капитал (правовое сопровождение процедуры получения льгот по уплате таможенной пошлины и НДС);
            • Участие в разработке проектной документации в части соблюдения требований градостроительного и земельного законодательства РК;
            • Правовое сопровождение приобретения актива, включая подготовку проектов заключаемых договоров, представительство интересов в государственных органах;
            • Прогнозирование и анализ коммерческих рисков после приобретения актива, разработка мер по минимизации рисков, анализ и оценка налоговых последствий сделки;
            • Консультации по выбору модели договорных взаимоотношений клиента и его контрагентов (совместная деятельность, инвестирование, проектное финансирование, договор франчайзинга);
            • Урегулирование земельных правоотношений (аренда муниципальных земель и субаренда у частных компаний);
            • Представление интересов инвестора в органах государственной власти по вопросам получения разрешения на строительство;
            • Получение всех предусмотренных законом согласований и разрешений в органах архитектуры и градостроительства;
            • Представление интересов инвестора в государственных органах РК. 
            • Постинвестиционная юридическая помощь (вопросы охраны окружающей среды, сертификации продукции, урегулирования споров, страхования, налоговые вопросы, дальнейшее юридическое сопровождение финансово-хозяйственной деятельности инвестора и др.);
            • Консультации на этапе строительства.\',6,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (210,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (210,\'Полное всестороннее сопровождение инвестиционных контрактов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (210,300000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (211,62,\'Оформление документации по результатам переговоров и встреч (меморандумы, договоры, соглашения о намерениях)\',7,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (211,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (211,\'Полное всестороннее сопровождение инвестиционных контрактов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (211,300000,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_category(id, name, description)
                values
                  (13, \'Суды и Арбитраж\', \'Суды и Арбитраж\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (18, 13, \'Суды и Арбитраж\', \'Суды и Арбитраж\');
            ');
            
            //service - 700
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      63, 18,  
                      \'700\',
                      \'Досудебное урегулирование споров\' ,
                      \'Досудебное урегулирование споров\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (212,63,\'Проведение переговоров по проблемной тематике Клиента\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (212,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (212,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (212,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (213,63,\'Формирование списка необходимых документов от Клиента\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (213,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (213,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (213,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (214,63,\'Правовая оценка представленной Клиентом документации после тщательного изучения всех материалов и обстоятельств, послуживших возникновению спора\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (214,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (214,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (214,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (215,63,\'Формирование и формализация правовой позиции и подготовка стратегии разрешения спора.\',4,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (215,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (215,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (215,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (216,63,\'Подготовка пакета документов и обоснованных предложений, необходимых для решения правового спора\',5,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (216,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (216,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (216,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (217,63,\'Подготовка обоснованных ответов на претензии, поступающие от представителя оппонента, грамотных с точки зрения закона\',6,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (217,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (217,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (217,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (218,63,\'Проведение переговоров и ведение переписки от имени Клиента\',7,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (218,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (218,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (218,0,1,null,\'2018-01-01\');
            ');
            
            //service - 710
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      64, 18,  
                      \'710\',
                      \'Сопровождение исполнитепьного производства\' ,
                      \'Сопровождение исполнитепьного производства\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (219,64,\'Проведение переговоров по проблемной тематике Клиента\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (219,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (219,\'Юридическое сопровождение на всех этапах исполнительного производства\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (219,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (220,64,\'Формирование списка необходимых документов от Клиента\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (220,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (220,\'Юридическое сопровождение на всех этапах исполнительного производства\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (220,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (221,64,\'Правовая оценка представленной Клиентом документации после тщательного изучения всех материалов и обстоятельств, послуживших возникновению спора\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (221,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (221,\'Юридическое сопровождение на всех этапах исполнительного производства\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (221,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (222,64,\'Формирование и формализация правовой позиции\',4,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (222,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (222,\'Юридическое сопровождение на всех этапах исполнительного производства\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (222,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (223,64,\'Юридическое сопровождение на всех этапах исполнительного производства:
            - юридическое консультирование о всех особенностях исполнительного производства;
            - представление интересов Клиента на этапе возбуждения исполнительного производства
            - подготовка и подача ходатайств о розыске имущества должника, его аресте, оценке, реализации;
            - подготовка жалоб и заявлений на действия и бездействия приставов;
            - подготовка обращений в суд о приостановлении исполнения, пересмотре, изменению способов и размеров возмещения;
            - Подготовка документов для возбуждения уголовного производства в случае уклонения должника от исполнения судебного решения;
            - Представление интересов клиента при заключении мирового соглашения, продаже или правопреемстве долга;
            - помощь в снятии ареста с имущества, банковских счетов;
            - отмена решения о запрете на выезд за границу;
            - составление жалоб на действия приставов;
            - подача иска в суд на возмещение ущерба от неправомерных действий приставов.\',5,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (223,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (223,\'Юридическое сопровождение на всех этапах исполнительного производства\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (223,0,1,null,\'2018-01-01\');
            ');
            
            //service - 720
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      65, 18,  
                      \'720\',
                      \'Обжалование вступивших в законную силу судебных актов\' ,
                      \'Обжалование вступивших в законную силу судебных актов\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (224,65,\'Проведение переговоров по проблемной тематике Клиента\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (224,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (224,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (224,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (225,65,\'Формирование списка необходимых документов от Клиента\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (225,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (225,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (225,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (226,65,\'Правовая оценка представленной Клиентом документации после тщательного изучения всех материалов и обстоятельств, послуживших возникновению спора\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (226,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (226,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (226,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (227,65,\'Формирование и формализация правовой позиции\',4,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (227,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (227,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (227,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (228,65,\'Подбор нормативно – правовой базы, которая регулирует правоотношения по обжалованию судебных решений\',5,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (228,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (228,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (228,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (229,65,\'Установление обстоятельств, способствующих пересмотру судебных решений\',6,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (229,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (229,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (229,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (230,65,\'Непосредственное оформление процессуального документа\',7,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (230,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (230,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (230,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (231,65,\'Непосредственное оформление процессуального документа\',8,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (231,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (231,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (231,0,1,null,\'2018-01-01\');
            ');
            
            //service - 730
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      66, 18,  
                      \'730\',
                      \'Составление процессуальных документов\' ,
                      \'Составление процессуальных документов\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (232,66,\'Определяется при проведении переговоров с Клиентом.\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (232,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (232,\'Составление процессуальных документов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (232,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (233,66,\'Формирование списка необходимых документов от Клиента\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (233,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (233,\'Составление процессуальных документов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (233,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (234,66,\'Правовая оценка представленной Клиентом документации после тщательного изучения всех материалов и обстоятельств, послуживших возникновению спора\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (234,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (234,\'Составление процессуальных документов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (234,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (235,66,\'Формирование и формализация правовой позиции\',4,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (235,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (235,\'Составление процессуальных документов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (235,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (236,66,\'Подбор нормативно – правовой базы, которая регулирует круг правоотношений по проблемной тематике Клиента\',5,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (236,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (236,\'Составление процессуальных документов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (236,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (237,66,\'Принятие оптимального решения и выводов с учетом преследуемой цели\',6,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (237,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (237,\'Составление процессуальных документов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (237,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (238,66,\'Непосредственное оформление процессуального документа.\',7,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (238,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (238,\'Составление процессуальных документов.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (238,0,1,null,\'2018-01-01\');
            ');
            
            //service - 740
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      67, 18,  
                      \'740\',
                      \'Представление интересов в судах всех инстанций\' ,
                      \'Представление интересов в судах всех инстанций\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (239,67,\'Проведение переговоров по проблемной тематике Клиента\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (239,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (239,\'Представление интересов Клиента в судебных органах.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (239,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (240,67,\'Формирование списка необходимых документов от Клиента\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (240,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (240,\'Представление интересов Клиента в судебных органах.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (240,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (241,67,\'Правовая оценка представленной Клиентом документации после тщательного изучения всех материалов и обстоятельств, послуживших возникновению спора\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (241,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (241,\'Представление интересов Клиента в судебных органах.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (241,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (242,67,\'Соблюдение претензионного или иного досудебного порядка урегулирование споров\',4,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (242,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (242,\'Представление интересов Клиента в судебных органах.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (242,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (243,67,\'При невозможности мирного урегулирования спора составление и подача искового заявления\',5,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (243,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (243,\'Представление интересов Клиента в судебных органах.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (243,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (244,67,\'Выработка наилучшей стратегии сопровождения процесса\',6,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (244,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (244,\'Представление интересов Клиента в судебных органах.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (244,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (245,67,\'Защита прав клиента в ходе разбирательства в судебных инстанциях\',7,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (245,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (245,\'Представление интересов Клиента в судебных органах.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (245,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (246,67,\'В случае достижения сторонами договоренностей о мировом соглашении: составление и согласование с клиентом текста мирового соглашения, а также подача ходатайства об утверждении мирового соглашения в арбитражный суд\',8,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (246,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (246,\'Представление интересов Клиента в судебных органах.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (246,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (247,67,\'Подготовка процессуальных документов (заявления, ходатайства, отводы и пр.)\',9,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (247,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (247,\'Представление интересов Клиента в судебных органах.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (247,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (248,67,\'Представление интересов в суде.\',10,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (248,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (248,\'Представление интересов Клиента в судебных органах.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (248,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (249,67,\'Возбуждение исполнительного производства: передача исполнительного листа судебным приставам, контроль их работы, обжалование их действий и пр.\',11,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (249,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (249,\'Представление интересов Клиента в судебных органах.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (249,0,1,null,\'2018-01-01\');
            ');
            
            //service - 750
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      68, 18,  
                      \'750\',
                      \'Признание и исполнение решений иностранных судов\' ,
                      \'Признание и исполнение решений иностранных судов\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (250,68,\'Проведение переговоров по проблемной тематике Клиента.\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (250,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (250,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (250,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (251,68,\'Формирование списка необходимых документов от Клиента.\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (251,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (251,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (251,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (252,68,\'Правовая оценка представленной Клиентом документации после тщательного изучения всех материалов и обстоятельств, послуживших возникновению спора.\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (252,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (252,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (252,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (253,68,\'Формирование и формализация правовой позиции.\',4,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (253,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (253,\'Определяются в зависимости от характера и сложности спора.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (253,0,1,null,\'2018-01-01\');
            ');
            
            //service - 760
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      69, 18,  
                      \'760\',
                      \'Консультирование по выбору правовой позиции\' ,
                      \'Консультирование по выбору правовой позиции\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (254,69,\'Проведение переговоров по проблемной тематике Клиента.\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (254,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (254,\'Подбор правовой стратегии по проблемной тематике в соответствии с требованиями и пожеланиями Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (254,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (255,69,\'Формирование списка необходимых документов от Клиента.\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (255,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (255,\'Подбор правовой стратегии по проблемной тематике в соответствии с требованиями и пожеланиями Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (255,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (256,69,\'Правовая оценка представленной Клиентом документации после тщательного изучения всех материалов и обстоятельств, послуживших возникновению спора.\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (256,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (256,\'Подбор правовой стратегии по проблемной тематике в соответствии с требованиями и пожеланиями Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (256,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (257,69,\'Формирование и формализация правовой позиции и подготовка стратегии разрешения спора.\',4,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (257,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (257,\'Подбор правовой стратегии по проблемной тематике в соответствии с требованиями и пожеланиями Клиента.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (257,0,1,null,\'2018-01-01\');
            ');
            
            //service - 770
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      70, 18,  
                      \'770\',
                      \'Правовая оценка доказательств\' ,
                      \'Правовая оценка доказательств\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (258,70,\'Проведение переговоров по проблемной тематике Клиента.\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (258,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (258,\'Правовая оценка представленной Клиентом документации на предмет гражданско-процессуальных требований.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (258,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (259,70,\'Формирование списка необходимых документов от Клиента.\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (259,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (259,\'Правовая оценка представленной Клиентом документации на предмет гражданско-процессуальных требований.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (259,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (260,70,\'Правовая оценка представленной Клиентом документации после тщательного изучения всех материалов и обстоятельств, послуживших возникновению спора на предмет гражданско-процессуальных требований.\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (260,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (260,\'Правовая оценка представленной Клиентом документации на предмет гражданско-процессуальных требований.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (260,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (261,70,\'Формирование и формализация правовой позиции.\',4,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (261,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (261,\'Правовая оценка представленной Клиентом документации на предмет гражданско-процессуальных требований.\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (261,0,1,null,\'2018-01-01\');
            ');
            
            //service - 780
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      71, 18,  
                      \'780\',
                      \'Правовая помощь в поиске ответчиков\' ,
                      \'Правовая помощь в поиске ответчиков\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (262,71,\'Проведение переговоров по проблемной тематике Клиента.\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (262,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (262,\'Оказание правовой помощи в поиске ответчиков\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (262,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (263,71,\'Формирование списка необходимых документов от Клиента.\',2,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (263,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (263,\'Оказание правовой помощи в поиске ответчиков\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (263,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (264,71,\'Правовая оценка представленной Клиентом документации после тщательного изучения всех материалов и обстоятельств, послуживших возникновению спора.\',3,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (264,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (264,\'Оказание правовой помощи в поиске ответчиков\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (264,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (265,71,\'Формирование и формализация правовой позиции и подготовка стратегии разрешения спора.\',4,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (265,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (265,\'Оказание правовой помощи в поиске ответчиков\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (265,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (266,71,\'Поиск информации о местонахождении должника, его расчетных счетах, имуществе, на которое может быть наложен арест.\',5,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (266,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (266,\'Оказание правовой помощи в поиске ответчиков\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (266,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (267,71,\'Предоставление собранной информации Клиенту.\',6,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (267,1,\'Определяется при проведении переговоров с Клиентом.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (267,\'Оказание правовой помощи в поиске ответчиков\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (267,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_category(id, name, description)
                values
                  (14, \'Трудовое  Право\', \'Трудовое  Право\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (19, 14, \'Трудовое  Право\', \'Трудовое  Право\');
            ');
            
            //service - 790
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      72, 19,  
                      \'790\',
                      \'Сопровождение процедуры привлечения иностранной рабочей силы\' ,
                      \'Сопровождение процедуры привлечения иностранной рабочей силы\',
                      45,
                      270,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (268,72,\'Следует иметь ввиду, что юридические лица, привлекающие иностранных специалистов направляют в районный отдел занятости и социальных программ соответствующего района заявку на получение квоты установленного образца. Заявка подается заранее. В случае, если в следующем году юридическое лицо планирует привлечь иностранное лицо для осуществления трудовой деятельности, оно подает заявку на выдачу квоты до 1 августа текущего года. Если юридическим лицом данный срок упущен, Управлением занятости принимается решение о выдаче разрешения в случае наличия свободной квоты либо отказе в выдаче разрешение в случае отсутствия квоты.\',1,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (268,1,\'Для проверки на сооответствие заявленной клиентом рабочей позиции иностранного лица квалификационным требованиям для указанной должности достаточно копии диплома и послужного списка. После успешной проверки на соответсвие от клиента необходимо:    Копия диплома с нотариально заверенным текущим годом переводом на русский/казахский языки (Апостилированная либо легализованная копия диплома. Апостиль для государств-участников Гаагской конвенции 1961 года).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (268,2,\'2.Копия паспорта иностранного лица с нотариально заверенным текущим годом переводом на русский/казахский языки.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (268,3,\'Штатное расписание сотрудников с обязательным указанием иностранного гражданства каждого сотрудника (при наличии).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (268,4,\'Послужной список иностранного лица на фирменном бланке предыдущего работодателя (данный документ подтверждает трудовой стаж. Обязательное название документа в переводе на русский язык "Послужной список". Должность и стаж иностранца, указанные в документе должны соответствовать квалификационным требования к указанной должности в Квалификационном справочнике должностей руководителей, специалистов и других служащих. Также, количество работников, указанных в штатном расписании должно соответствовать количеству работников, за которых клиент выполняет уплату налоговых сборов (форма налоговой отчетности).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (268,5,\'ЭЦП приглашающего юридического лица с указанием пароля для подачи заявление на получение разрешения на привлечение иностранной рабочей силы через электронный портал e-license.   Заполненная заявка (высылается клиенту заранее юристами ТОО "Ipravo".\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (268,6,\'После получения Уведомления от Управления занятости о выдаче разрешения на привлечение иностранной рабочей силы выполнения оплаты - квитанция об уплате гос пошлины с печатью банка\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (268,\'Уведомление о выдаче разрешения на привлечение иностранной рабочей силы; Разрешение на привлечение иностранной рабочей силы\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (268,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (269,72,\'Соответствие заявленной клиентом рабочей позиции иностранного лица квалификационным требованиям для указанной должности (В соответствии с Квалификационным справочником должностей руководителей, специалистов и других служащих). Должность подбирается на основании диплома и трудового стажа иностранного работника. Несоответсвие трудового стажа и дипломной специальности заявленной трудовой позиции влечет за собой отказ в выдаче разрешения на привлечение иностранной рабочей силы\',2,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (269,1,\'Для проверки на сооответствие заявленной клиентом рабочей позиции иностранного лица квалификационным требованиям для указанной должности достаточно копии диплома и послужного списка. После успешной проверки на соответсвие от клиента необходимо:    Копия диплома с нотариально заверенным текущим годом переводом на русский/казахский языки (Апостилированная либо легализованная копия диплома. Апостиль для государств-участников Гаагской конвенции 1961 года).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (269,2,\'2.Копия паспорта иностранного лица с нотариально заверенным текущим годом переводом на русский/казахский языки.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (269,3,\'Штатное расписание сотрудников с обязательным указанием иностранного гражданства каждого сотрудника (при наличии).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (269,4,\'Послужной список иностранного лица на фирменном бланке предыдущего работодателя (данный документ подтверждает трудовой стаж. Обязательное название документа в переводе на русский язык "Послужной список". Должность и стаж иностранца, указанные в документе должны соответствовать квалификационным требования к указанной должности в Квалификационном справочнике должностей руководителей, специалистов и других служащих. Также, количество работников, указанных в штатном расписании должно соответствовать количеству работников, за которых клиент выполняет уплату налоговых сборов (форма налоговой отчетности).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (269,5,\'ЭЦП приглашающего юридического лица с указанием пароля для подачи заявление на получение разрешения на привлечение иностранной рабочей силы через электронный портал e-license.   Заполненная заявка (высылается клиенту заранее юристами ТОО "Ipravo".\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (269,6,\'После получения Уведомления от Управления занятости о выдаче разрешения на привлечение иностранной рабочей силы выполнения оплаты - квитанция об уплате гос пошлины с печатью банка\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (269,\'Уведомление о выдаче разрешения на привлечение иностранной рабочей силы; Разрешение на привлечение иностранной рабочей силы\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (269,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (270,72,\'Подготовка документов и подача заявления на получение разрешения на привлечение иностранной рабочей силы (с приложением документов) через электронный портал\',3,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (270,1,\'Для проверки на сооответствие заявленной клиентом рабочей позиции иностранного лица квалификационным требованиям для указанной должности достаточно копии диплома и послужного списка. После успешной проверки на соответсвие от клиента необходимо:    Копия диплома с нотариально заверенным текущим годом переводом на русский/казахский языки (Апостилированная либо легализованная копия диплома. Апостиль для государств-участников Гаагской конвенции 1961 года).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (270,2,\'2.Копия паспорта иностранного лица с нотариально заверенным текущим годом переводом на русский/казахский языки.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (270,3,\'Штатное расписание сотрудников с обязательным указанием иностранного гражданства каждого сотрудника (при наличии).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (270,4,\'Послужной список иностранного лица на фирменном бланке предыдущего работодателя (данный документ подтверждает трудовой стаж. Обязательное название документа в переводе на русский язык "Послужной список". Должность и стаж иностранца, указанные в документе должны соответствовать квалификационным требования к указанной должности в Квалификационном справочнике должностей руководителей, специалистов и других служащих. Также, количество работников, указанных в штатном расписании должно соответствовать количеству работников, за которых клиент выполняет уплату налоговых сборов (форма налоговой отчетности).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (270,5,\'ЭЦП приглашающего юридического лица с указанием пароля для подачи заявление на получение разрешения на привлечение иностранной рабочей силы через электронный портал e-license.   Заполненная заявка (высылается клиенту заранее юристами ТОО "Ipravo".\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (270,6,\'После получения Уведомления от Управления занятости о выдаче разрешения на привлечение иностранной рабочей силы выполнения оплаты - квитанция об уплате гос пошлины с печатью банка\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (270,\'Уведомление о выдаче разрешения на привлечение иностранной рабочей силы; Разрешение на привлечение иностранной рабочей силы\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (270,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (271,72,\'Рассмотрение заявление уполномоченным органом и получение Уведомления об уплате государственной пошлины за выдачу разрешения на привлечение иностранной рабочей силы\',4,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (271,1,\'Для проверки на сооответствие заявленной клиентом рабочей позиции иностранного лица квалификационным требованиям для указанной должности достаточно копии диплома и послужного списка. После успешной проверки на соответсвие от клиента необходимо:    Копия диплома с нотариально заверенным текущим годом переводом на русский/казахский языки (Апостилированная либо легализованная копия диплома. Апостиль для государств-участников Гаагской конвенции 1961 года).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (271,2,\'2.Копия паспорта иностранного лица с нотариально заверенным текущим годом переводом на русский/казахский языки.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (271,3,\'Штатное расписание сотрудников с обязательным указанием иностранного гражданства каждого сотрудника (при наличии).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (271,4,\'Послужной список иностранного лица на фирменном бланке предыдущего работодателя (данный документ подтверждает трудовой стаж. Обязательное название документа в переводе на русский язык "Послужной список". Должность и стаж иностранца, указанные в документе должны соответствовать квалификационным требования к указанной должности в Квалификационном справочнике должностей руководителей, специалистов и других служащих. Также, количество работников, указанных в штатном расписании должно соответствовать количеству работников, за которых клиент выполняет уплату налоговых сборов (форма налоговой отчетности).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (271,5,\'ЭЦП приглашающего юридического лица с указанием пароля для подачи заявление на получение разрешения на привлечение иностранной рабочей силы через электронный портал e-license.   Заполненная заявка (высылается клиенту заранее юристами ТОО "Ipravo".\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (271,6,\'После получения Уведомления от Управления занятости о выдаче разрешения на привлечение иностранной рабочей силы выполнения оплаты - квитанция об уплате гос пошлины с печатью банка\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (271,\'Уведомление о выдаче разрешения на привлечение иностранной рабочей силы; Разрешение на привлечение иностранной рабочей силы\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (271,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (272,72,\'Получение разрешения на привлечение иностранной рабочей силы (на основании квитанции об уплате налогового сбора за разрешение)\',5,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (272,1,\'Для проверки на сооответствие заявленной клиентом рабочей позиции иностранного лица квалификационным требованиям для указанной должности достаточно копии диплома и послужного списка. После успешной проверки на соответсвие от клиента необходимо:    Копия диплома с нотариально заверенным текущим годом переводом на русский/казахский языки (Апостилированная либо легализованная копия диплома. Апостиль для государств-участников Гаагской конвенции 1961 года).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (272,2,\'2.Копия паспорта иностранного лица с нотариально заверенным текущим годом переводом на русский/казахский языки.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (272,3,\'Штатное расписание сотрудников с обязательным указанием иностранного гражданства каждого сотрудника (при наличии).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (272,4,\'Послужной список иностранного лица на фирменном бланке предыдущего работодателя (данный документ подтверждает трудовой стаж. Обязательное название документа в переводе на русский язык "Послужной список". Должность и стаж иностранца, указанные в документе должны соответствовать квалификационным требования к указанной должности в Квалификационном справочнике должностей руководителей, специалистов и других служащих. Также, количество работников, указанных в штатном расписании должно соответствовать количеству работников, за которых клиент выполняет уплату налоговых сборов (форма налоговой отчетности).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (272,5,\'ЭЦП приглашающего юридического лица с указанием пароля для подачи заявление на получение разрешения на привлечение иностранной рабочей силы через электронный портал e-license.   Заполненная заявка (высылается клиенту заранее юристами ТОО "Ipravo".\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (272,6,\'После получения Уведомления от Управления занятости о выдаче разрешения на привлечение иностранной рабочей силы выполнения оплаты - квитанция об уплате гос пошлины с печатью банка\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (272,\'Уведомление о выдаче разрешения на привлечение иностранной рабочей силы; Разрешение на привлечение иностранной рабочей силы\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (272,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (273,72,\'Начало процедуры получения визы категории С3\',6,true,45,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (273,1,\'Для проверки на сооответствие заявленной клиентом рабочей позиции иностранного лица квалификационным требованиям для указанной должности достаточно копии диплома и послужного списка. После успешной проверки на соответсвие от клиента необходимо:    Копия диплома с нотариально заверенным текущим годом переводом на русский/казахский языки (Апостилированная либо легализованная копия диплома. Апостиль для государств-участников Гаагской конвенции 1961 года).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (273,2,\'2.Копия паспорта иностранного лица с нотариально заверенным текущим годом переводом на русский/казахский языки.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (273,3,\'Штатное расписание сотрудников с обязательным указанием иностранного гражданства каждого сотрудника (при наличии).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (273,4,\'Послужной список иностранного лица на фирменном бланке предыдущего работодателя (данный документ подтверждает трудовой стаж. Обязательное название документа в переводе на русский язык "Послужной список". Должность и стаж иностранца, указанные в документе должны соответствовать квалификационным требования к указанной должности в Квалификационном справочнике должностей руководителей, специалистов и других служащих. Также, количество работников, указанных в штатном расписании должно соответствовать количеству работников, за которых клиент выполняет уплату налоговых сборов (форма налоговой отчетности).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (273,5,\'ЭЦП приглашающего юридического лица с указанием пароля для подачи заявление на получение разрешения на привлечение иностранной рабочей силы через электронный портал e-license.   Заполненная заявка (высылается клиенту заранее юристами ТОО "Ipravo".\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (273,6,\'После получения Уведомления от Управления занятости о выдаче разрешения на привлечение иностранной рабочей силы выполнения оплаты - квитанция об уплате гос пошлины с печатью банка\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (273,\'Уведомление о выдаче разрешения на привлечение иностранной рабочей силы; Разрешение на привлечение иностранной рабочей силы\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (273,0,1,null,\'2018-01-01\');
            ');
            
            //service - 800
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      73, 19,  
                      \'800\',
                      \'Получение квоты для процедуру привлечения иностранной рабочей силы\' ,
                      \'Получение квоты для процедуру привлечения иностранной рабочей силы\',
                      3,
                      3,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (274,73,\'Следует иметь ввиду, что юридические лица, привлекающие иностранных специалистов направляют в районный отдел занятости и социальных программ соответствующего района заявку на получение квоты установленного образца. Заявка подается заранее. В заявке указывается предположительное количество привлекаемых иностранных работников и их должность. В случае, если в следующем году юридическое лицо планирует привлечь иностранное лицо для осуществления трудовой деятельности, оно подает заявку на выдачу квоты до 1 августа текущего года. Если юридическим лицом данный срок упущен, Управлением занятости принимается решение о выдаче разрешения в случае наличия свободной квоты либо отказе в выдаче разрешение в случае отсутствия квоты.\',1,true,3,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (274,1,\'Штатное расписание.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (274,\'Заявка на получение квоты с печатью уполномоченного органа, подтверждающая факт подачи\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (274,0,1,null,\'2018-01-01\');
            ');
            
            //service - 810
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      74, 19,  
                      \'810\',
                      \'Формирование кадрового документооборота\' ,
                      \'Формирование кадрового документооборота\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (275,74,\'\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (275,0,1,null,\'2018-01-01\');
            ');
            
            //service - 820
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      75, 19,  
                      \'820\',
                      \'Сопровождение проверок проводимые государственнными органами\' ,
                      \'Сопровождение проверок проводимые государственнными органами\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (276,75,\'\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (276,0,1,null,\'2018-01-01\');
            ');
            
            //service - 830
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      76, 19,  
                      \'830\',
                      \'Сопровождение процедуры внутрикорпоративного перевода\' ,
                      \'Сопровождение процедуры внутрикорпоративного перевода\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (277,76,\'\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (277,0,1,null,\'2018-01-01\');
            ');
            
            //service - 840
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      77, 19,  
                      \'840\',
                      \'Минимизация рисков ответственности работодателя при несчастных случаях на производстве\' ,
                      \'Минимизация рисков ответственности работодателя при несчастных случаях на производстве\',
                      0,
                      0,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (278,77,\'\',1,true,0,1,true);
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (278,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_category(id, name, description)
                values
                  (15, \'Лицензии и разрешения\', \'Лицензии и разрешения\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (20, 15, \'Лицензии и разрешения\', \'Лицензии и разрешения\');
            ');
            
            //service - 850
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      78, 20,  
                      \'850\',
                      \'Строительство\' ,
                      \'Строительство\',
                      15,
                      15,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (279,78,\'Получение ЭЦП на компанию лицензиата, сбор копий всех документов, оплата гос.пошлины, подача заявки на портале Elicense.kz\',1,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (279,1,\'Учредительные документы, Оплата гос.пошлины 10 МРП, Если имеется: Наличие в собственности или договор аренда производственной базы , Трудовые договора со специалистами, Договора аренды по технике, Материально-техническая оснащенность, Лицензия(для I и II категории), Акты-выполненных работ\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (279,\'Государственная лицензия\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (279,900000,1,null,\'2018-01-01\');
            ');
            
            //service - 860
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      79, 20,  
                      \'860\',
                      \'Промышленность\' ,
                      \'Промышленность\',
                      30,
                      30,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (280,79,\'Получение ЭЦП на компанию лицензиата, сбор копий всех документов, оплата гос.пошлины, подача заявки на портале Elicense.kz\',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (280,1,\'Учредительные документы.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (280,2,\'Оплата гос пшлины от 10 до 50 МРП.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (280,3,\'Наличие офиса.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (280,4,\'Диплом о высшем образовании руководителя заявителя.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (280,5,\'Трудовые договора со специалистами.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (280,6,\'Материально-техническая оснащенность.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (280,7,\'Документы аккредитованной специализированной лаборатории.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (280,8,\'В зависимости от подвидов деятельности, могут быть запрошены дополнительные документы.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (280,\'Государственная лицензия\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (280,12000,2,null,\'2018-01-01\');
            ');
            
            //service - 870
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      80, 20,  
                      \'870\',
                      \'Безопасность\' ,
                      \'Безопасность\',
                      15,
                      15,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (281,80,\'Получение ЭЦП на компанию лицензиата или физ.лицо, сбор копий всех документов, подача заявки на портале Elicense.kz\',1,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (281,1,\'Копии документов специалистов экспертной организации об образовании, и подтверждающие трудовую деятельность в противопожарных службах.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (281,2,\'Копии докумнтов о материально-технической оснащенности.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (281,3,\'Копии документов о помещении, принадлежащем экспертной организации (предоставляются в случае отсутствия указанных объектов на балансе услугополучателя).\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (281,\'Аттестат аккредитации по аудиту в области пожарной безопасности\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (281,0,1,null,\'2018-01-01\');
            ');
            
            //service - 880
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      81, 20,  
                      \'880\',
                      \'Здравоохранение\' ,
                      \'Здравоохранение\',
                      15,
                      15,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (282,81,\'Получение ЭЦП на компанию лицензиата или физ. лицо, сбор документов, оплата гос.пошлины, подача заявки на портале Elicense.kz\',1,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (282,1,\'Учредительные документы.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (282,2,\'Оплата Гос пошлины 10 МР.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (282,3,\'Копию договора удостоверяющего право собственности или аренды на помещение.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (282,4,\'Диплом о высшем или среднем медицинском образовании.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (282,5,\'Копии удостоверений о прохождении переподготовки или свидетельств о прохождении повышения квалификации.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (282,6,\'Копия сертификата специалиста по заявляемой специальности.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (282,7,\'Копия документа, подтверждающего трудовую деятельность работника.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (282,\'Выдача лицензии на медицинскую деятельность\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (282,0,1,null,\'2018-01-01\');
            ');
            
            //service - 890
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      82, 20,  
                      \'890\',
                      \'Импорт - Экспорт\' ,
                      \'Импорт - Экспорт\',
                      30,
                      30,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (283,82,\'Получение ЭЦП на компанию лицензиата или физ.лицо, сбор документов, оплата гос.пошлины, подача заявки на портале Elicense.kz\',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (283,1,\'Копия внешнеторгового договора (контракта), приложения.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (283,2,\'Учредительные документы или документ удостоверяющий личность.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (283,3,\'Оплата гос.пошлины 10 МРП.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (283,4,\'Документы, подтверждающие соответствие услугополучателя квалификационным требованиям.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (283,5,\'В зависимости от подвидов деятельности, могут быть запрошены дополнительные документы.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (283,\'Выдача лицензии на импорт и (или) экспорт отдельных видов товаров\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (283,0,1,null,\'2018-01-01\');
            ');
            
            //service - 900
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      83, 20,  
                      \'900\',
                      \'Экология\' ,
                      \'Экология\',
                      30,
                      30,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (284,83,\'Получение ЭЦП на компанию лицензиата, сбор копий всех документов, оплата гос.пошлины, подача заявки на портале Elicense.kz\',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (284,1,\'Учредительные документы.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (284,2,\'Оплата гос.пошлины 50 МРП.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (284,3,\'Наличие офиса.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (284,4,\'Диплом о высшем образовании руководителя заявителя.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (284,5,\'Трудовые договора со специалистами.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (284,6,\'Материально-техническая оснащенность.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (284,7,\'Документы аккредитованной специализированной лаборатории.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (284,8,\'Наличие программного комплекса по расчету нормативов эмиссий в окружающую среду.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (284,\'Государственная лицензия\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (284,5000,2,null,\'2018-01-01\');
            ');
            
            //service - 910
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      84, 20,  
                      \'910\',
                      \'Финансы\' ,
                      \'Финансы\',
                      30,
                      30,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (285,84,\'Получение ЭЦП на компанию лицензиата, сбор копий всех документов, оплата гос.пошлины, подача заявки на портале Elicense.kz\',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (285,1,\'Оплата гос.пошлины 470МРП.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (285,2,\'Положение о кредитном комитете.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (285,3,\'Штатное расписание.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (285,4,\'Документы, подтверждающие соответствие программных технических средств банка.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (285,5,\'Копии документов, подтверждающие оплату уставного капитала.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (285,6,\'Заявление согласно Приложению 7 к Правилам выдачи разрешения на открытие банка.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (285,7,\'Положения о структурных подразделениях (соответствующих требованиям Закона Республики Казахстан «О рынке ценных бумаг»), на которые будут возложены функции по осуществлению деятельности на рынке ценных бумаг.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (285,\'Выдача лицензии банкам на проведение банковских и иных операций, предусмотренных банковским законодательством Республики Казахстан\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (285,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (21, 2, \'Недвижимость\', \'Недвижимость\');
            ');
            
            //service - 920
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      85, 21,  
                      \'920\',
                      \'Сопровождение сделок с недвижимым имуществом\' ,
                      \'Сопровождение сделок с недвижимым имуществом\',
                      30,
                      450,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (286,85,\'Юридическое сопровождение сделок с недвижимым имуществом (здания, сооружения, квартиры, дома, имущественные комплексы).
            \',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (286,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (286,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (286,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (286,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (286,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (286,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (286,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (286,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (287,85,\'Анализ предстоящей сделки на соответствие законодательству и потенциальных рисков.
            Проверка истории объекта.
            \',2,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (287,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (287,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (287,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (287,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (287,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (287,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (287,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (287,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (288,85,\'Участие в переговорах и выработка условий предстоящей сделки.
            \',3,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (288,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (288,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (288,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (288,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (288,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (288,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (288,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (288,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (289,85,\'Разработка оптимальной схемы сделки.
            Обеспечение интересов клиента.
            \',4,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (289,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (289,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (289,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (289,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (289,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (289,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (289,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (289,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (290,85,\'Обеспечение исполнения обязательств контрагентом по сделке.
            \',5,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (290,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (290,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (290,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (290,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (290,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (290,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (290,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (290,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (291,85,\'Определение налоговых последствий сделки.
            \',6,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (291,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (291,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (291,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (291,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (291,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (291,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (291,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (291,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (292,85,\'Установление порядка оплаты.
            \',7,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (292,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (292,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (292,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (292,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (292,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (292,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (292,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (292,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (293,85,\'Составление и согласование текста сделки с недвижимостью.
            \',8,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (293,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (293,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (293,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (293,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (293,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (293,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (293,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (293,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (294,85,\'Составление договоров (купли-продажи, дарения, аренды, доверительного управления).
            \',9,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (294,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (294,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (294,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (294,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (294,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (294,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (294,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (294,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (295,85,\'Сопровождение оценки объекта сделки.
            \',10,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (295,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (295,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (295,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (295,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (295,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (295,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (295,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (295,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (296,85,\'Сопровождение технического обследования объекта сделки.
            \',11,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (296,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (296,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (296,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (296,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (296,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (296,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (296,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (296,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (297,85,\'Изготовление технического паспорта.
            \',12,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (297,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (297,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (297,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (297,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (297,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (297,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (297,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (297,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (298,85,\'Регистрация текущих изменений на объекте.
            \',13,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (298,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (298,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (298,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (298,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (298,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (298,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (298,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (298,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (299,85,\'Сопровождение процедуры регистрации сделки.
            \',14,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (299,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (299,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (299,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (299,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (299,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (299,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (299,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (299,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (300,85,\'Комплексный правовой анализ приобретаемого объекта.\',15,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (300,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (300,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (300,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (300,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (300,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (300,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (300,\'Правоустанавливающие документы на объект недвижимости\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (300,0,1,null,\'2018-01-01\');
            ');
            
            //service - 930
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      86, 21,  
                      \'930\',
                      \'Изменение регистрационных данных недвижимого имущества\' ,
                      \'Изменение регистрационных данных недвижимого имущества\',
                      15,
                      45,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (301,86,\'Сбор документов для изменения рестрационных данных\',1,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (301,1,\'Правоустанавливающие документы, подтверждающие регистрацию недвижимого имущества.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (301,2,\'
            Документ, послуживший основанием для внесения изменения в регистрационные данные недвижимого имущества.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (301,\'Правоустанавливающий документ с отметкой об изменении регистрационных данных\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (301,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (302,86,\'Проверка документов, представленных\',2,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (302,1,\'Правоустанавливающие документы, подтверждающие регистрацию недвижимого имущества.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (302,2,\'
            Документ, послуживший основанием для внесения изменения в регистрационные данные недвижимого имущества.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (302,\'Правоустанавливающий документ с отметкой об изменении регистрационных данных\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (302,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (303,86,\'Подача документов в уполномоченный орган\',3,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (303,1,\'Правоустанавливающие документы, подтверждающие регистрацию недвижимого имущества.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (303,2,\'
            Документ, послуживший основанием для внесения изменения в регистрационные данные недвижимого имущества.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (303,\'Правоустанавливающий документ с отметкой об изменении регистрационных данных\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (303,0,1,null,\'2018-01-01\');
            ');
            
            //service - 940
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      87, 21,  
                      \'940\',
                      \'Регистрация прав и обременений недвижимого имущества\' ,
                      \'Регистрация прав и обременений недвижимого имущества\',
                      30,
                      90,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (304,87,\'Сбор документов для государственной регистрации
            \',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (304,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (304,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (304,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (304,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (304,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (304,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (304,\'Правоустанавливающий документ с отметкой о произведенной регистрации\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (304,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (305,87,\'Проверка документов, представленных на государственную регистрацию, включая проверку законности совершаемой сделки и (или) иных юридических фактов (юридических составов), являющихся основаниями возникновения, изменения, прекращения прав (обременении прав) на недвижимое имущество или иных объектов государственной регистрации на соответствие действующему законодательству\',2,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (305,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (305,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (305,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (305,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (305,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (305,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (305,\'Правоустанавливающий документ с отметкой о произведенной регистрации\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (305,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (306,87,\'Сведения о технических и идентификационных характеристиках объекта недвижимости, необходимые для государственной регистрации прав на недвижимое имущество, регистрирующий орган получает из соответствующей государственной информационной системы\',3,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (306,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (306,2,\'
            Учредительные и регистрационные документы (для юридических лиц, индивидуальных предпринимателей).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (306,3,\'
            Правоустанавливающие документы на недвижимое имущество (договор купли-продажи, дарения, обмена, акт приемки в эксплуатацию, свидетельство о праве на наследство и т. п.).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (306,4,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (306,5,\'
            Технический паспорт.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (306,6,\'
            Другие документы, относящиеся к объекту недвижимости.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (306,\'Правоустанавливающий документ с отметкой о произведенной регистрации\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (306,0,1,null,\'2018-01-01\');
            ');
            
            //service - 950
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      88, 21,  
                      \'950\',
                      \'Раздел земельного участка\' ,
                      \'Раздел земельного участка\',
                      15,
                      45,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (307,88,\'Сбор документов для изменения целевого назначения земельного участка\',1,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (307,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (307,2,\'
            Правоустанавливающие документы на земельный участок.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (307,3,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (307,4,\'
            Другие документы, относящиеся к земельному участку.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (307,\'Идентификационные документы (государственные акты)\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (307,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (308,88,\'Проверка представленных документов\',2,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (308,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (308,2,\'
            Правоустанавливающие документы на земельный участок.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (308,3,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (308,4,\'
            Другие документы, относящиеся к земельному участку.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (308,\'Идентификационные документы (государственные акты)\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (308,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (309,88,\'Подача документов в упономоченный орган\',3,true,15,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (309,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (309,2,\'
            Правоустанавливающие документы на земельный участок.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (309,3,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (309,4,\'
            Другие документы, относящиеся к земельному участку.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (309,\'Идентификационные документы (государственные акты)\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (309,0,1,null,\'2018-01-01\');
            ');
            
            //service - 960
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      89, 21,  
                      \'960\',
                      \'Изменение целевого назначения земельного участка\' ,
                      \'Изменение целевого назначения земельного участка\',
                      30,
                      90,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (310,89,\'Сбор документов для изменения целевого назначения земельного участка\',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (310,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (310,2,\'
            Правоустанавливающие документы на земельный участок.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (310,3,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (310,4,\'
            Другие документы, относящиеся к земельному участку.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (310,\'Идентификационный документ (государственный акт)\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (310,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (311,89,\'Проверка представленных документов\',2,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (311,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (311,2,\'
            Правоустанавливающие документы на земельный участок.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (311,3,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (311,4,\'
            Другие документы, относящиеся к земельному участку.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (311,\'Идентификационный документ (государственный акт)\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (311,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (312,89,\'Подача документов в упономоченный орган\',3,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (312,1,\'Документ, удостоверяющий личность Клиента.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (312,2,\'
            Правоустанавливающие документы на земельный участок.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (312,3,\'
            Идентификационные документы на земельный участок (акт).\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (312,4,\'
            Другие документы, относящиеся к земельному участку.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (312,\'Идентификационный документ (государственный акт)\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (312,0,1,null,\'2018-01-01\');
            ');
            
            //service - 970
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      90, 21,  
                      \'970\',
                      \'Получение акта ввода в эксплуатацию\' ,
                      \'Получение акта ввода в эксплуатацию\',
                      30,
                      120,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (313,90,\'Сбор документов для получения акта в эксплуатацию\',1,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (313,1,\'Приемка объектов в эксплуатацию собственником самостоятельно допускается при наличии  разрешительной документации, включающей:
            разрешение на производство строительно-монтажных работ;
            решение местных исполнительных органов на строительство (реконструкцию, перепланировку, переоборудование);
            архитектурно-планировочное задание;
            проектная (проектно-сметная) документация либо эскиз (эскизный проект).\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (313,\'Зарегистрированный акт ввода в эксплуатацию\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (313,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (314,90,\'Проверка представленных документов\',2,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (314,1,\'Приемка объектов в эксплуатацию собственником самостоятельно допускается при наличии  разрешительной документации, включающей:
            разрешение на производство строительно-монтажных работ;
            решение местных исполнительных органов на строительство (реконструкцию, перепланировку, переоборудование);
            архитектурно-планировочное задание;
            проектная (проектно-сметная) документация либо эскиз (эскизный проект).\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (314,\'Зарегистрированный акт ввода в эксплуатацию\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (314,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (315,90,\'Подача документов в упономоченный орган\',3,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (315,1,\'Приемка объектов в эксплуатацию собственником самостоятельно допускается при наличии  разрешительной документации, включающей:
            разрешение на производство строительно-монтажных работ;
            решение местных исполнительных органов на строительство (реконструкцию, перепланировку, переоборудование);
            архитектурно-планировочное задание;
            проектная (проектно-сметная) документация либо эскиз (эскизный проект).\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (315,\'Зарегистрированный акт ввода в эксплуатацию\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (315,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (316,90,\'Регистрация документов\',4,true,30,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (316,1,\'Приемка объектов в эксплуатацию собственником самостоятельно допускается при наличии  разрешительной документации, включающей:
            разрешение на производство строительно-монтажных работ;
            решение местных исполнительных органов на строительство (реконструкцию, перепланировку, переоборудование);
            архитектурно-планировочное задание;
            проектная (проектно-сметная) документация либо эскиз (эскизный проект).\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (316,\'Зарегистрированный акт ввода в эксплуатацию\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (316,0,1,null,\'2018-01-01\');
            ');
            
            //service - 980
            DB::statement('
                insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment, counter_type_id, service_country_id) 
                values
                  (
                      91, 21,  
                      \'980\',
                      \'Снятие обременения с недвижимого имущества\' ,
                      \'Снятие обременения с недвижимого имущества\',
                      7,
                      21,
                      true,
                      \'2018-01-01\',
                      null,
                      null,
                      1,
                      1
                  );
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (317,91,\'Сбор документов для изменения целевого назначения земельного участка\',1,true,7,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (317,1,\'Перечень документов, необходимых для оказания государственной услуги при обращении услугополучателя (правообладателя) либо его представителя по доверенности) для физического лица:
            Заявление о государственной регистрации установленной формы;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (317,2,\'
            Документ, удостоверяющий личность услугополучателя (физического лица) (оригинал предоставляется для идентификации личности услугополучателя);\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (317,3,\'
            Удостоверение личности уполномоченного представителя услугополучателя, и документ, удостоверяющий полномочия на представительство услугополучателя, с указанием сведений документа, удостоверяющего личность услугополучателя (при обращении представителя услугополучателя);\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (317,4,\'Правоустанавливающие и иные документы, подтверждающие объект регистрации, с приложением технического паспорта недвижимости и (или) идентификационного документа на земельный участок;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (317,5,\'
            Документ, подтверждающий оплату в бюджет суммы регистрационного сбора, либо документ, подтверждающий освобождение от оплаты сбора.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (317,6,\'
            Помимо указанных документов в зависимости от объекта регистрации представляются иные документы. Для юридического лица:
            1) заявление о государственной регистрации установленной формы;
            2) удостоверение личности уполномоченного представителя услугополучателя и документ, удостоверяющий полномочия (оригинал предоставляется для идентификации личности услугополучателя) на представительство услугополучателя (при обращении представителя услугополучателя);
            3) правоустанавливающие и иные документы, подтверждающие объект регистрации, с приложением технического паспорта недвижимости и (или) идентификационного документа на земельный участок;
            4) документ, подтверждающий оплату в бюджет суммы регистрационного сбора, либо документ, подтверждающий освобождение от оплаты сбора;
            5) учредительные документы, справку о государственной регистрации юридического лица;
            6) протоколы собраний (выписки из них) учредителей (участников, совета директоров, совета акционеров) на приобретение или отчуждение объектов недвижимости, в случаях, предусмотренных законодательными актами Республики Казахстан либо учредительными документами;
            7) иностранные юридические лица представляют легализованную выписку из торгового реестра или другой легализованный документ, удостоверяющий, что иностранное юридическое лицо является юридическим лицом по законодательству иностранного государства, с нотариально засвидетельствованным переводом на государственный и русский языки.
            Помимо указанных документов в зависимости от объекта регистрации представляются иные документы.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (317,\'Правоустанавливающий документ с отметкой о снятие обременений\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (317,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (318,91,\'Проверка представленных документов\',2,true,7,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (318,1,\'Перечень документов, необходимых для оказания государственной услуги при обращении услугополучателя (правообладателя) либо его представителя по доверенности) для физического лица:
            Заявление о государственной регистрации установленной формы;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (318,2,\'
            Документ, удостоверяющий личность услугополучателя (физического лица) (оригинал предоставляется для идентификации личности услугополучателя);\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (318,3,\'
            Удостоверение личности уполномоченного представителя услугополучателя, и документ, удостоверяющий полномочия на представительство услугополучателя, с указанием сведений документа, удостоверяющего личность услугополучателя (при обращении представителя услугополучателя);\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (318,4,\'Правоустанавливающие и иные документы, подтверждающие объект регистрации, с приложением технического паспорта недвижимости и (или) идентификационного документа на земельный участок;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (318,5,\'
            Документ, подтверждающий оплату в бюджет суммы регистрационного сбора, либо документ, подтверждающий освобождение от оплаты сбора.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (318,6,\'
            Помимо указанных документов в зависимости от объекта регистрации представляются иные документы. Для юридического лица:
            1) заявление о государственной регистрации установленной формы;
            2) удостоверение личности уполномоченного представителя услугополучателя и документ, удостоверяющий полномочия (оригинал предоставляется для идентификации личности услугополучателя) на представительство услугополучателя (при обращении представителя услугополучателя);
            3) правоустанавливающие и иные документы, подтверждающие объект регистрации, с приложением технического паспорта недвижимости и (или) идентификационного документа на земельный участок;
            4) документ, подтверждающий оплату в бюджет суммы регистрационного сбора, либо документ, подтверждающий освобождение от оплаты сбора;
            5) учредительные документы, справку о государственной регистрации юридического лица;
            6) протоколы собраний (выписки из них) учредителей (участников, совета директоров, совета акционеров) на приобретение или отчуждение объектов недвижимости, в случаях, предусмотренных законодательными актами Республики Казахстан либо учредительными документами;
            7) иностранные юридические лица представляют легализованную выписку из торгового реестра или другой легализованный документ, удостоверяющий, что иностранное юридическое лицо является юридическим лицом по законодательству иностранного государства, с нотариально засвидетельствованным переводом на государственный и русский языки.
            Помимо указанных документов в зависимости от объекта регистрации представляются иные документы.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (318,\'Правоустанавливающий документ с отметкой о снятие обременений\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (318,0,1,null,\'2018-01-01\');
            ');
            
            DB::statement('
                insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)
                values
                (319,91,\'Подача документов в упономоченный орган\',3,true,7,1,true);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (319,1,\'Перечень документов, необходимых для оказания государственной услуги при обращении услугополучателя (правообладателя) либо его представителя по доверенности) для физического лица:
            Заявление о государственной регистрации установленной формы;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (319,2,\'
            Документ, удостоверяющий личность услугополучателя (физического лица) (оригинал предоставляется для идентификации личности услугополучателя);\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (319,3,\'
            Удостоверение личности уполномоченного представителя услугополучателя, и документ, удостоверяющий полномочия на представительство услугополучателя, с указанием сведений документа, удостоверяющего личность услугополучателя (при обращении представителя услугополучателя);\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (319,4,\'Правоустанавливающие и иные документы, подтверждающие объект регистрации, с приложением технического паспорта недвижимости и (или) идентификационного документа на земельный участок;\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (319,5,\'
            Документ, подтверждающий оплату в бюджет суммы регистрационного сбора, либо документ, подтверждающий освобождение от оплаты сбора.\',null);
            ');
            
            DB::statement('
                insert into service_step_required_document (service_step_id, document_number, description, document_template_id)
                values
                (319,6,\'
            Помимо указанных документов в зависимости от объекта регистрации представляются иные документы. Для юридического лица:
            1) заявление о государственной регистрации установленной формы;
            2) удостоверение личности уполномоченного представителя услугополучателя и документ, удостоверяющий полномочия (оригинал предоставляется для идентификации личности услугополучателя) на представительство услугополучателя (при обращении представителя услугополучателя);
            3) правоустанавливающие и иные документы, подтверждающие объект регистрации, с приложением технического паспорта недвижимости и (или) идентификационного документа на земельный участок;
            4) документ, подтверждающий оплату в бюджет суммы регистрационного сбора, либо документ, подтверждающий освобождение от оплаты сбора;
            5) учредительные документы, справку о государственной регистрации юридического лица;
            6) протоколы собраний (выписки из них) учредителей (участников, совета директоров, совета акционеров) на приобретение или отчуждение объектов недвижимости, в случаях, предусмотренных законодательными актами Республики Казахстан либо учредительными документами;
            7) иностранные юридические лица представляют легализованную выписку из торгового реестра или другой легализованный документ, удостоверяющий, что иностранное юридическое лицо является юридическим лицом по законодательству иностранного государства, с нотариально засвидетельствованным переводом на государственный и русский языки.
            Помимо указанных документов в зависимости от объекта регистрации представляются иные документы.\',null);
            ');
            
            DB::statement('
                insert into service_step_result (service_step_id, description)
                values
                (319,\'Правоустанавливающий документ с отметкой о снятие обременений\');
            ');
            
            DB::statement('
                insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)
                values
                (319,0,1,null,\'2018-01-01\');
            ');


            DB::commit();

        } catch (\Exception $e) {
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
