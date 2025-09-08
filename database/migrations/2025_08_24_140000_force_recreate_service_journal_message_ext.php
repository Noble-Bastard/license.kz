<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ForceRecreateServiceJournalMessageExt extends Migration
{
    public function up()
    {
        // Drop the view first to ensure clean recreation
        DB::unprepared("DROP VIEW IF EXISTS service_journal_message_read_hist_ext");
        
        // Recreate the view without definer
        DB::unprepared("
            CREATE VIEW service_journal_message_read_hist_ext AS
              select
                  sjm.id,
                  sjm.service_journal_id,
                  sj.client_id,
                  sj.manager_id,
                  sjm.id message_id,
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
    }

    public function down()
    {
        DB::unprepared("DROP VIEW IF EXISTS service_journal_message_read_hist_ext");
    }
}






