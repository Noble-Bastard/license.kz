<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExecutionParallelNoToServiceStepMapTable extends Migration
{

    public function up()
    {
        Schema::table('service_step_map', function (Blueprint $table) {
            $table->unsignedInteger('execution_parallel_no')->nullable();
            $table->boolean('is_required')->nullable();
            $table->boolean('is_active')->nullable();
        });

        DB::unprepared('
            delete from service_step_map;
        ');

        DB::unprepared("
            insert into service_step_map(
                service_id, 
                service_step_id,
                execution_parallel_no,
                is_required,
                is_active
            )
            select
                service_id,
                id,
                execution_parallel_no,
                is_required,
                is_active
            from service_step
        ");

        DB::unprepared("
            create or replace view service_step_ext
            as
            select
              ss.id,
              ss.service_id,
              srv.name service_name,
              srv.code service_code,
              ss.description,
              ss.step_number,
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
    }


    public function down()
    {
        Schema::table('service_step', function (Blueprint $table) {
            $table->dropColumn('execution_parallel_no');
            $table->dropColumn('is_required');
            $table->dropColumn('is_active');
        });
    }
}
