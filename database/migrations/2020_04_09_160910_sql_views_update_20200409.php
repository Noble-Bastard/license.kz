<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SqlViewsUpdate20200409 extends Migration
{

    public function up()
    {
        DB::unprepared("
            create or replace view executor_group_body_ext
            as
            SELECT
              egb.id,
              egb.executor_group_id,
              eg.name executor_group_name,
              egb.profile_id,
              prf.full_name profile_full_name
            FROM executor_group_body egb
              left join executor_group eg
              on eg.id = egb.executor_group_id
              left join profile prf
              on prf.id = egb.profile_id
        ");

        DB::unprepared("
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
        ");

        DB::unprepared("
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
                pl.company_name as company_legal_name,
                pl.business_identification_number,
                pl.contact_person,
                pl.position,
                pl.scope_activity,
                p.photo_id,
                d.path photo_path,
                p.manager_id,
                pm.full_name manager_name,
                p.company_id,
                cpa_c.value company_name,
                p.city_id,
                c.value city_name
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
                left join company cpa
                    on p.company_id = cpa.id
                    left join city cpa_c
                        on cpa.city_id = cpa_c.id
                left join city c on p.city_id = c.id

        ");

        DB::unprepared("
            create or replace view project_ext
            as
              SELECT
                     p.id,
                     p.project_status_id,
                     ps.name project_status_name,
                     p.created_by,
                     p.description,
                     p.create_date,
                     p.manager_id,
                     prf.full_name manager_full_name,
                     p.service_journal_id,
                     pro.id project_review_id,
                     pro.project_review_status,
                     prs.name project_review_status_name,
                     trc.taskReviewCommentCnt task_review_comment_cnt,
                     pro.assigned_to project_review_assigned_to,
                     pro.create_date project_review_create_date,
                     pmcd.maxCreateDate
              FROM project p
                     left join project_status ps
                       on ps.id = p.project_status_id
                     left join profile prf
                       on prf.id = p.manager_id
                     left join (
                               select
                                      pr.project_id,
                                      max(create_date) maxCreateDate
                               from project_review pr
                               group by pr.project_id) pmcd
                       on p.id = pmcd.project_id
                     left join project_review pro
                       on pro.project_id = pmcd.project_id
                            and pro.create_date = pmcd.maxCreateDate
                     left join (
                               select
                                      tr.project_review_id,
                                      count(*) taskReviewCommentCnt
                               from task_review tr
                               group by tr.project_review_id
                               ) trc
                       on trc.project_review_id = pro.id
                     left join project_review_status prs
                       on prs.id = pro.project_review_status
        ");

        DB::unprepared("
            create or replace view project_review_ext
            as
            SELECT
              pr.id,
              pr.created_by,
              cb.name created_by_name,
              pr.create_date,
              pr.assigned_to,
              ato.name assigned_to_name,
              pr.project_review_status,
              prs.name project_review_status_name,
              pr.project_id,
              p.description project_description
            FROM project_review pr
              left join project_review_status prs
              on prs.id = pr.project_review_status
              left join project p
              on p.id = pr.project_id
              left join users cb
              on cb.id = pr.created_by
              left join users ato
              on ato.id = pr.assigned_to;
        ");

        DB::unprepared("
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
        ");

        DB::unprepared("
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
                                 group_concat(optionset_value SEPARATOR ';') optionset_value_list,
                                 group_concat(optionset_id SEPARATOR ';') optionset_id_list
                               from optionset_value_template
                               group by optionset_type_id) ovt
                      on ovt.optionset_type_id = ot.id
        ");

        DB::unprepared("
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
                             group_concat(optionset_value SEPARATOR ';') optionset_value_list,
                             group_concat(optionset_id SEPARATOR ';') optionset_id_list
                           from optionset_value_template
                           group by optionset_type_id) ovt
                  on ovt.optionset_type_id = ot.id
        ");

        DB::unprepared("
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
        ");

        DB::unprepared("
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


        ");

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

        DB::unprepared("
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
        ");

        DB::unprepared("
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
        ");

        DB::unprepared("
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
              sjs.completion_date,
              ss.execution_time_plan,
              tsk.id task_id,
              ss.execution_work_day_cnt,
              ss.execution_parallel_no
            from service_journal_step sjs
              left join service_journal sj
              on sj.id = sjs.service_journal_id
              left join service_step ss
              on ss.id = sjs.service_step_id
              left join task tsk
              on tsk.service_journal_step_id = sjs.id
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
                td.description,
                tsk.project_id
              from
                task_document td
                left join document d
                  on td.document_id = d.id
                left join document_type t
                  on d.document_type_id = t.id
                left join task tsk
                on tsk.id = td.task_id
        ");
        DB::unprepared("
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

        ");
        DB::unprepared("
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
              t.execution_time_plan,
              t.execution_time_fact,
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

        ");

        DB::unprepared("
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
              t.execution_time_plan,
              t.execution_time_fact,
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

        ");
        DB::unprepared("
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
        ");
        DB::unprepared("
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

        ");

    }


    public function down()
    {
        //
    }
}
