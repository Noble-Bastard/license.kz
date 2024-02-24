<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProjectExt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
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
              pro.assigned_to project_review_assigned_to
            FROM project p
              left join project_status ps
              on ps.id = p.project_status_id
              left join profile prf
              on prf.id = p.manager_id
              left join (
                select
                  pr.id project_id,
                  max(create_date) maxCreateDate
                from project_review pr
                group by pr.id) pmcd
              on p.id = pmcd.project_id
                left join project_review pro
                on pro.project_id = p.id
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
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('
            drop view project_ext
        ');
    }
}
