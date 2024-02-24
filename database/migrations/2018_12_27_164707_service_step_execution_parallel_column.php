<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceStepExecutionParallelColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_step', function (Blueprint $table) {
            $table->unsignedInteger('execution_parallel_no')->nullable();
        });

        DB::statement("
            update service_step
            set
              execution_parallel_no = step_number;
        ");

        DB::statement("
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
              crn.name step_currency_name,
              ss.execution_parallel_no
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
                on crn.id = ch.currency_id;      
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
