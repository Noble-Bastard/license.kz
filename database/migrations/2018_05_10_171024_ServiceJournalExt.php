<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceJournalExt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            create or replace view service_journal_ext
            as
            select
              sj.id,
              sj.service_status_id,
              ss.name service_status_name,
              sj.service_id,
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
              msg.is_read,
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
