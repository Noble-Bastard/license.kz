<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceExtCommentColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::unprepared("create or replace view service_ext
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
    s.comment
  from service s
    left join service_thematic_group stg
      on stg.id = s.service_thematic_group_id
      left join service_category sctg
        on sctg.id = stg.service_category_id
    left join counter_type ct
      on ct.id = s.counter_type_id
    left join (select
                 ss.service_id,
                 sum(ss.execution_work_day_cnt) total_execution_work_day_cnt,
                 sum(ch.cost) total_service_cost,
                 ch.currency_id
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
               group by ss.service_id, ch.currency_id) ss
      on ss.service_id = s.id
    left join currency crn
      on crn.id = ss.currency_id
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
