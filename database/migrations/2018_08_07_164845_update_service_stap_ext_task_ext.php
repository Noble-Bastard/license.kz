<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateServiceStapExtTaskExt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
              ss.execution_time_plan,
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
              sjs.completion_date,
              ss.execution_time_plan
            from service_journal_step sjs
              left join service_journal sj
              on sj.id = sjs.service_journal_id
              left join service_step ss
              on ss.id = sjs.service_step_id
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
