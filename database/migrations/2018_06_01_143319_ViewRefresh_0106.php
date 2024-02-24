<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ViewRefresh0106 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            create or replace view company_profile_ext
            as
              select
                cp.id,
                cp.bin,
                cp.web_site,
                cp.email,
                cp.skype,
                cp.mobile_phone,
                cp.name,
                cp.description,
                cp.post_code,
                cp.director_id,
                prf.full_name director_name
              from
                company_profile cp
                join profile prf
                  on cp.director_id=prf.id
        ');

        DB::statement('
            create or replace view profile_document_ext
              as
              select
                  pd.id,
                  p.id profile_id,
                  p.full_name profile_full_name,
                  p.user_id,
                  u.name profile_user_name,
                  pd.document_id,
                  d.name document_name,
                  d.path document_path
              from profile p
                  inner join profile_document pd
                  on pd.profile_id = p.id
                    inner join document d
                    on d.id = pd.document_id
                  inner join users u
                  on u.id = p.user_id;
        ');
        DB::statement('
            create or replace view profile_ext
            as
            select
                p.id,
                p.full_name,
                p.user_id,
                u.name user_name,
                ur.role_id,
                r.name role_name,
                u.is_active,
                p.phone,
                p.email,
                p.last_login_date,
                p.create_date,
                p.created_by,
                p.is_resident,
                p.profile_state_type_id,
                pst.name profile_state_type_name,
                pl.id profile_legal_id,
                pl.company_name,
                pl.business_identification_number,
                pl.contact_person,
                pl.position,
                pl.scope_activity,
                p.photo_id,
                d.path photo_path,
                p.manager_id,
                pm.full_name manager_name
            from profile p
                left join users u
                    on u.id = p.user_id
                left join user_role ur
                    on ur.user_id = u.id
                left join role r
                    on r.id = ur.role_id
                left join profile_state_type pst
                    on pst.id = p.profile_state_type_id
                left join profile_legal pl
                    on pl.profile_id = p.id
                left join document d
                on d.id = p.photo_id
                left join profile pm
                  on pm.id = p.manager_id
            where u.is_active = 1;
        ');
        DB::statement('
            create or replace view registration_form_group_template_ext
            as
            select
              rfgt.id,
              rfgt.registration_form_template_id,
              rft.name registration_form_template_name,
              rfgt.parameter_group_id,
              pg.name parameter_group_name,
              rfgt.order_number
            from registration_form_group_template rfgt
              left join parameter_group pg
              on pg.id = rfgt.parameter_group_id
              left join registration_form_template rft
              on rft.id = rfgt.registration_form_template_id
        ');
        DB::statement('
            create or replace view registration_form_parameter_ext
            as
              select
                rfpt.id,
                rfpt.registration_form_parameter_template_id,
                rfpt.registration_form_group_id,
                rfpt.registration_form_id,
                rf.form_number registration_form_form_number,
                rf.create_date registration_form_create_date,
                rf.service_journal_id,
                rfg.parameter_group_id,
                pg.name parameter_group_name,
                rfpt.parameter_type_id,
                pt.name parameter_type_name,
                pt.data_type parameter_type_data_type,
                rfpt.caption,
                rfpt.comment,
                rfpt.order_number,
                rfpt.parameter_formatted_value,
                pnv.parameter_value parameter_number_value,
                pdv.parameter_value parameter_datetime_value,
                pbv.parameter_value parameter_bool_value,
                pov.optionset_id parameter_optionset_id,
                pov.optionset_type_id parameter_optionset_type_id,
                pov.optionset_value parameter_optionset_value,
                ot.name parameter_optionset_type_name,
                ovt.optionset_id_list,
                ovt.optionset_value_list,
                pds.date_format parameter_datetime_format,
                pds.default_value parameter_datetime_default_value,
                pns.max_value parameter_number_max_value,
                pns.min_value parameter_number_min_value,
                pns.round_type parameter_number_round_type,
                pns.default_value parameter_number_default_value,
                pts.validation_mask parameter_text_validation_mask,
                pts.default_value parameter_text_default_value
              from registration_form_parameter rfpt
                left join registration_form rf
                on rf.id = rfpt.registration_form_id
                left join registration_form_group rfg
                on rfg.id = rfpt.registration_form_group_id
                  left join parameter_group pg
                  on pg.id = rfg.parameter_group_id
                  left join parameter_type pt
                  on pt.id = rfpt.parameter_type_id
                    left join parameter_datetime_setting pds
                    on pds.parameter_type_id = pt.id
                    left join parameter_number_setting pns
                    on pns.parameter_type_id = pt.id
                    left join parameter_text_setting pts
                    on pts.parameter_type_id = pt.id
                left join parameter_number_value pnv
                on pnv.registration_form_parameter_id = rfpt.id
                left join parameter_datetime_value pdv
                on pdv.registration_form_parameter_id = rfpt.id
                left join parameter_bool_value pbv
                on pbv.registration_form_parameter_id = rfpt.id
                left join parameter_optionset_value pov
                on pov.registration_form_parameter_id = rfpt.id
                  left join optionset_type ot
                  on ot.id = pov.optionset_type_id
                      left join (select
                                 optionset_type_id,
                                 group_concat(optionset_value SEPARATOR \';\') optionset_value_list,
                                 group_concat(optionset_id SEPARATOR \';\') optionset_id_list
                               from optionset_value_template
                               group by optionset_type_id) ovt
                      on ovt.optionset_type_id = ot.id
        ');
        DB::statement('
            create or replace view registration_form_parameter_template_ext
            as
              select
                rfpt.id,
                rfgt.registration_form_template_id,
                rfpt.registration_form_group_template_id,
                pg.name registration_form_group_template_name,
                rfgt.order_number registration_form_group_template_order_number,
                rfpt.parameter_type_id,
                pt.name parameter_type_name,
                pt.data_type parameter_type_data_type,
                rfpt.caption,
                rfpt.is_active,
                rfpt.comment,
                rfpt.order_number,
                rfpt.optionset_type_id,
                ot.name optionset_type_name,
                ovt.optionset_id_list,
                ovt.optionset_value_list,
                pds.date_format parameter_datetime_format,
                pds.default_value parameter_datetime_default_value,
                pns.max_value parameter_number_max_value,
                pns.min_value parameter_number_min_value,
                pns.round_type parameter_number_round_type,
                pns.default_value parameter_number_default_value,
                pts.validation_mask parameter_text_validation_mask,
                pts.default_value parameter_text_default_value
              from registration_form_parameter_template rfpt
                left join registration_form_group_template rfgt
                  on rfgt.id = rfpt.registration_form_group_template_id
                left join parameter_group pg
                  on pg.id = rfgt.parameter_group_id
                left join parameter_type pt
                  on pt.id = rfpt.parameter_type_id
                  left join parameter_datetime_setting pds
                  on pds.parameter_type_id = pt.id
                  left join parameter_number_setting pns
                    on pns.parameter_type_id = pt.id
                  left join parameter_text_setting pts
                    on pts.parameter_type_id = pt.id
                left join optionset_type ot
                  on ot.id = rfpt.optionset_type_id
                left join (select
                             optionset_type_id,
                             group_concat(optionset_value SEPARATOR \';\') optionset_value_list,
                             group_concat(optionset_id SEPARATOR \';\') optionset_id_list
                           from optionset_value_template
                           group by optionset_type_id) ovt
                  on ovt.optionset_type_id = ot.id
        ');
        DB::statement('
            create or replace view registration_form_parameter_template_table_structure_ext
            as
            select
              rfptts.id,
              rfptts.registration_form_parameter_template_table_id,
              rfptts.column_parameter_template_id,
              rfptt.registration_form_parameter_template_id,
              rfptt.table_caption
            from registration_form_parameter_template_table_structure  rfptts
              left join registration_form_parameter_template_table rfptt
              on rfptt.id = rfptts.registration_form_parameter_template_table_id
        ');
        DB::statement('
            create or replace view registration_form_template_ext
            as
            select
              rft.id,
              rft.counter_type_id,
              ct.name counter_type_name,
              rft.name
            from registration_form_template rft
              left join counter_type ct
              on ct.id = rft.counter_type_id
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
                  s.execution_days_to,
                  s.counter_type_id,
                  ct.name counter_type_name,
                  ss.total_serice_cost,
                  ss.total_execution_work_day_cnt
               from service s
                  left join service_thematic_group stg
                     on stg.id = s.service_thematic_group_id
                  left join counter_type ct
                     on ct.id = s.counter_type_id
                  left join (select
                                ss.service_id,
                                sum(ss.execution_work_day_cnt) total_execution_work_day_cnt,
                                sum(ch.cost) total_serice_cost
                             from service_step ss
                                left join (  select
                                                service_step_id,
                                                max(create_date) as max_create_date
                                             from service_step_cost_hist
                                             group by service_step_id) schm
                                   on schm.service_step_id = ss.id
                                left join service_step_cost_hist ch
                                   on ch.service_step_id = ss.id
                                      and ch.create_date = schm.max_create_date
                             group by ss.service_id) ss
                     on ss.service_id = s.id

        ');
        DB::statement('
            create or replace view service_journal_ext
            as
            select
              sj.id,
              sj.service_status_id,
              ss.name service_status_name,
              sj.service_id,
              rft.counter_type_id registration_form_template_counter_type_id,
              s.name service_name,
              s.description service_description,
              s.code service_code,
              s.execution_days_from service_execution_days_from,
              s.execution_days_to service_execution_days_to,
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
              sjp.currency_id,
              crc.name currency_name,
              sjp.is_payed
            from service_journal sj
              left join service_status ss
              on ss.id = sj.service_status_id
              left join service s
              on s.id = sj.service_id
                left join service_registration_form_template srft
                on srft.service_id = s.id
                  left join registration_form_template rft
                  on rft.id = srft.registration_form_template_id
              left join profile cprf
              on cprf.id = sj.client_id
              left join profile mprf
              on mprf.id = sj.manager_id
              left join service_journal_payment sjp
              on sjp.service_journal_id = sj.id
                left join currency crc
                on crc.id = sjp.currency_id
        ');
        DB::statement('
            create or replace view service_journal_message_ext
            as
            select
              sjm.id,
              sjm.service_journal_id,
              sj.service_no service_journal_no,
              sjm.message_id,
              msg.caption message_caption,
              msg.create_date message_create_date,
              msg.message,
              sjm.create_date,
              sjm.created_by,
              prf.full_name created_by_full_name,
              r.id created_by_role_id,
              r.name created_by_role_name
            from service_journal_message sjm
              left join service_journal sj
              on sj.id = sjm.service_journal_id
              left join messages msg
              on msg.id = sjm.message_id
              left join users usr
              on usr.id = sjm.created_by
                left join user_role ur
                on ur.user_id = usr.id
                  left join role r
                  on r.id = ur.role_id
              left join profile prf
              on prf.user_id = sjm.created_by
        ');
        DB::statement('
            create or replace view service_journal_message_read_hist_ext
            as
              select
                sjm.id,
                sjm.service_journal_id,
                sj.client_id,
                sj.manager_id,
                sjm.message_id message_id,
                mc.create_date message_create_date,
                mrh_c.read_date message_client_read_date,
                mrh_c.read_by message_client_read_by,
                mrh_m.read_date message_manager_read_date,
                mrh_m.read_by message_manager_read_by
              from
                service_journal_message sjm
                left join service_journal sj on sjm.service_journal_id = sj.id
                left join profile pc on sj.client_id = pc.id
                left join profile pm on sj.manager_id = pm.id
                left join messages mc on sjm.message_id = mc.id
                left join messages_read_hist mrh_c on mc.id = mrh_c.message_id and mrh_c.read_by = pc.user_id
                left join messages mm on sjm.message_id = mm.id
                left join messages_read_hist mrh_m on mm.id = mrh_m.message_id and mrh_m.read_by = pm.user_id

        ');
        DB::statement('
            create or replace view service_journal_step_ext
            as
            select
              sjs.id,
              sjs.service_journal_id,
              sj.service_no service_journal_service_no,
              sjs.service_step_id,
              ss.description service_step_description,
              sjs.service_step_no,
              sjs.is_completed,
              sjs.execution_start_date,
              sjs.completion_date
            from service_journal_step sjs
              left join service_journal sj
              on sj.id = sjs.service_journal_id
              left join service_step ss
              on ss.id = sjs.service_step_id
        ');
        DB::statement('
            create or replace view service_step_ext
            as
            select
              ss.id,
              ss.service_id,
              srv.name service_name,
              srv.code service_code,
              ss.description,
              ss.step_number,
              ss.is_required,
              ss.execution_work_day_cnt,
              ss.counter_type_id,
              ct.name counter_type_name,
              ss.is_active,
              ch.cost step_cost,
              ch.currency_id step_currency_id,
              crn.name step_currency_name
            from service_step ss
              left join service srv
              on srv.id = ss.service_id
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
        ');
        DB::statement('
            create or replace view service_step_required_document_ext
            as
            select
              srd.id,
              ss.service_id,
              srv.name service_name,
              srv.code service_code,
              srd.service_step_id,
              ss.description service_step_description,
              srd.document_number,
              srd.description,
              srd.document_template_id,
              d.name document_template_name,
              d.path document_template_path,
              d.document_type_id,
              dt.name document_type_name
            from service_step_required_document srd
              left join service_step ss
              on ss.id = srd.service_step_id
                left join service srv
                on srv.id = ss.service_id
              left join document d
              on d.id = srd.document_template_id
                left join document_type dt
                on dt.id = d.document_type_id
        ');
        DB::statement('
            create or replace view service_step_result_ext
            as
              select
                ssr.id,
                ssr.description,
                ss.service_id,
                srv.name service_name,
                srv.code service_code,
                ssr.service_step_id,
                ss.description service_step_description
              from service_step_result ssr
                left join service_step ss
                  on ss.id = ssr.service_step_id
                left join service srv
                  on srv.id = ss.service_id
        ');
        DB::statement('
            create or replace view task_document_ext
            as
              select
                td.id,
                td.task_id,
                td.document_id,
                d.name document_name,
                d.path document_path,
                d.document_type_id,
                t.name document_type_name,
                td.create_date,
                td.description
              from
                task_document td
                left join document d
                  on td.document_id = d.id
                left join document_type t
                  on d.document_type_id = t.id
        ');
        DB::statement('
            create or replace view task_executor_ext
            as
            SELECT
              te.id,
              te.task_id,
              te.executor_id,
              pr.full_name executor_full_name,
              pr.email executor_email,
              te.assign_date
            FROM
              task_executor te
                LEFT JOIN profile pr
                ON te.executor_id = pr.id;
        ');
        DB::statement('
            create or replace view task_ext
            as
            SELECT
              t.id,
              t.project_id,
              p.description project_description,
              p.service_journal_id project_service_journal_id,
              p.create_date project_create_date,
              pr.id manager_id,
              pr.full_name manager_full_name,
              pr.email manager_email,
              t.task_relevance_id,
              tr.name task_relevance_name,
              t.service_journal_step_id,
              t.task_status_id,
              ts.name task_status_name,
              t.execution_time,
              t.description,
              t.result,
              t.actual_execution_time,
              t.created_by,
              u.name created_by_name
            FROM
              task t
              LEFT JOIN project p
              ON t.project_id = p.id
                LEFT JOIN profile pr
                ON p.manager_id = pr.id
              LEFT JOIN task_relevance tr
              ON t.task_relevance_id = tr.id
              LEFT JOIN task_status ts
              ON t.task_status_id = ts.id
              LEFT JOIN users u
              ON t.created_by = u.id;
        ');
        DB::statement('
            create or replace view task_hist_ext
            as
            SELECT
              t.id,
              t.task_id,
              t.project_id,
              p.description project_description,
              p.service_journal_id project_service_journal_id,
              p.create_date project_create_date,
              pr.id manager_id,
              pr.full_name manager_full_name,
              pr.email manager_email,
              t.task_relevance_id,
              tr.name task_relevance_name,
              t.service_journal_step_id,
              t.task_status_id,
              ts.name task_status_name,
              t.execution_time,
              t.description,
              t.result,
              t.actual_execution_time,
              t.modify_by,
              u.name created_by_name,
              t.modify_date
            FROM
              task_hist t
              LEFT JOIN project p
              ON t.project_id = p.id
                LEFT JOIN profile pr
                ON p.manager_id = pr.id
              LEFT JOIN task_relevance tr
              ON t.task_relevance_id = tr.id
              LEFT JOIN task_status ts
              ON t.task_status_id = ts.id
              LEFT JOIN users u
              ON t.modify_by = u.id;

        ');
        DB::statement('
            create or replace view task_message_ext
            as
            select
              tm.id,
              tm.task_id,
              tm.message_id,
              msg.caption message_caption,
              msg.create_date message_create_date,
              msg.message,
              tm.create_date,
              tm.created_by,
              prf.full_name created_by_full_name,
              r.id created_by_role_id,
              r.name created_by_role_name
            from task_message tm
              left join task t
              on tm.task_id = t.id
              left join messages msg
              on msg.id = tm.message_id
              left join users usr
              on usr.id = tm.created_by
                left join user_role ur
                on ur.user_id = usr.id
                  left join role r
                  on r.id = ur.role_id
              left join profile prf
              on prf.user_id = tm.created_by
        ');
        DB::statement('
            create or replace view users_ext
            as
            select
                u.id,
                u.name,
                u.email,
                u.password,
                ur.role_id,
                r.name role_name,
                u.is_active
            from users u
                left join user_role ur
                on ur.user_id = u.id
                  left join role r
                  on r.id = ur.role_id;
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
