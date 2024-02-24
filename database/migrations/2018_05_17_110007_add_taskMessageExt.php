<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaskMessageExt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
