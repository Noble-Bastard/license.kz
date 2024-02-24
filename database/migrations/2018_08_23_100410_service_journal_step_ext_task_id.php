<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceJournalStepExtTaskId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
              ss.execution_time_plan,
              tsk.id task_id
            from service_journal_step sjs
              left join service_journal sj
                on sj.id = sjs.service_journal_id
              left join service_step ss
                on ss.id = sjs.service_step_id
              left join task tsk
                on tsk.service_journal_step_id = sjs.id
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
