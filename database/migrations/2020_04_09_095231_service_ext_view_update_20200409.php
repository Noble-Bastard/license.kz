<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ServiceExtViewUpdate20200409 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
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
                s.execution_days_to,
                s.counter_type_id,
                ct.name counter_type_name,
                ss.total_service_cost,
                ss.total_execution_work_day_cnt,
                ss.currency_id,
                crn.name currency_name,
                sctg.id as service_category_id,
                sctg.country_id,
                s.comment,
                srft.registration_form_template_id,
                rft.name registration_form_template_name,
                s.license_type_id
              from service s
                left join service_thematic_group stg
                  on stg.id = s.service_thematic_group_id
                  left join service_category sctg
                    on sctg.id = stg.service_category_id
                left join counter_type ct
                  on ct.id = s.counter_type_id
                left join (select
                             ss.service_id,
                             sum(st.execution_work_day_cnt) total_execution_work_day_cnt,
                             sum(ch.cost) total_service_cost,
                             ch.currency_id
                           from service_step_map ss
                             left join (  select
                                            service_step_id,
                                            max(create_date) as max_create_date
                                          from service_step_cost_hist
                                          group by service_step_id) schm
                               on schm.service_step_id = ss.service_step_id
                                left join service_step st
                                on st.id = ss.service_step_id
                             left join service_step_cost_hist ch
                               on ch.service_step_id = ss.service_step_id
                                  and ch.create_date = schm.max_create_date
                           group by ss.service_id, ch.currency_id) ss
                  on ss.service_id = s.id
                left join currency crn
                  on crn.id = ss.currency_id
                left join service_registration_form_template srft
                on srft.service_id = s.id
                    left join registration_form_template rft
                    on rft.id = srft.registration_form_template_id


        ");


        DB::unprepared("
            create or replace view service_step_ext
            as
            select
              stm.Id as service_step_map_id,
              ss.id,
              stm.service_id,
              srv.name service_name,
              srv.code service_code,
              ss.description,
              stm.step_number,
              stm.is_required,
              ss.execution_work_day_cnt,
              ss.counter_type_id,
              ct.name counter_type_name,
              stm.is_active,
              ss.execution_time_plan,
              ch.cost step_cost,
              ch.tax step_tax,
              ch.currency_id step_currency_id,
              crn.name step_currency_name,
              stm.execution_parallel_no,
              ss.license_type_id,
                lt.name license_type_name
            from service_step_map stm
              left join service_step ss
              on ss.id = stm.service_step_id
              left join service srv
              on srv.id = stm.service_id
              left join counter_type ct
                on ct.id =  ss.counter_type_id
              left join (  select
                             service_step_id,
                             max(create_date) as max_create_date
                           from service_step_cost_hist
                           group by service_step_id) schm
                on schm.service_step_id = ss.id
              left join service_step_cost_hist ch
                on ch.service_step_id = ss.id
                   and ch.create_date = schm.max_create_date
              left join currency crn
                on crn.id = ch.currency_id
                left join license_type lt
                on ss.license_type_id = lt.id


        ");

        DB::unprepared("
            create or replace view service_journal_ext
            as
            select
                sj.id,
                sj.service_status_id,
                ss.name service_status_name,
                sj.client_id,
                cprf.full_name client_full_name,
                cprf.email client_email,
                sj.manager_id,
                mprf.full_name manager_full_name,
                mprf.email manager_email,
                sj.service_no,
                sj.create_date,
                sj.modify_date,
                sjp.amount,
                sjp.prepayment_percent,
                sjp.tax,
                sjp.currency_id,
                crc.name currency_name,
                case when pinvc.payment_status_id = 2 then 1 else 0 end as is_client_check_paid,
                pinvc.amount client_check_amount,
                case when pinvp.payment_status_id = 2 then 1 else 0 end as is_prepayment_paid,
                pinvp.amount prepayment_amount,
                case when pinvf.payment_status_id = 2 then 1 else 0 end as is_final_paid,
                pinvf.amount final_amount,
                prj.id project_id,
                prj.project_status_id,
                prjs.name project_status_name,
                sj.country_id,
                sj.reject_reason
            from service_journal sj
                     left join service_status ss
                               on ss.id = sj.service_status_id
                     left join profile cprf
                               on cprf.id = sj.client_id
                     left join profile mprf
                               on mprf.id = sj.manager_id
                     left join service_journal_payment sjp
                               on sjp.service_journal_id = sj.id
                     left join currency crc
                               on crc.id = sjp.currency_id
                     left join project prj
                               on prj.service_journal_id = sj.id
                     left join project_status prjs
                               on prjs.id = prj.project_status_id
                     left join payment_invoice pinvc
                               on pinvc.service_journal_id = sj.id
                                   and  pinvc.invoice_type_id = 1
                     left join payment_invoice pinvp
                               on pinvp.service_journal_id = sj.id
                                   and  pinvp.invoice_type_id = 2
                     left join payment_invoice pinvf
                               on pinvf.service_journal_id = sj.id
                                   and  pinvf.invoice_type_id = 3
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
