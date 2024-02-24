<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaskExt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
