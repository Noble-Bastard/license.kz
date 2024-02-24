<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddIsProfileLegalExistColumnToServiceJournalView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::unprepared("
            create or replace view service_journal_ext
            as
            select
              sj.id,
              sj.service_status_id,
              ss.name service_status_name,
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
              sjp.prepayment_percent,
              sjp.tax,
              sjp.currency_id,
              crc.name currency_name,
              case when pinvc.payment_status_id = 2 then 1 else 0 end as is_client_check_paid,
              pinvc.amount client_check_amount,
              case when pinvp.payment_status_id = 2 then 1 else 0 end as is_prepayment_paid,
              pinvp.amount prepayment_amount,
              case when pinvf.payment_status_id = 2 then 1 else 0 end as is_final_paid,
              pinvf.amount final_amount,
              prj.id project_id,
              prj.project_status_id,
              prjs.name project_status_name,
              sj.country_id,
              sj.reject_reason,
              prv.project_review_id,
              case when sjpl.id is null then 0 else 1 end is_profile_legal_exist
            from service_journal sj
              left join service_journal_profile_legal sjpl
              on sjpl.service_journal_id = sj.id
              left join service_status ss
              on ss.id = sj.service_status_id
              left join profile cprf
              on cprf.id = sj.client_id
              left join profile mprf
              on mprf.id = sj.manager_id
              left join service_journal_payment sjp
              on sjp.service_journal_id = sj.id
                left join currency crc
                on crc.id = sjp.currency_id
              left join project prj
              on prj.service_journal_id = sj.id
                left join project_status prjs
                on prjs.id = prj.project_status_id
                left join (   select project_id, max(id) project_review_id
                            from project_review group by project_id) prv
                on prv.project_id = prj.id
              left join payment_invoice pinvc
              on pinvc.service_journal_id = sj.id
              and  pinvc.invoice_type_id = 1
              left join payment_invoice pinvp
              on pinvp.service_journal_id = sj.id
              and  pinvp.invoice_type_id = 2
              left join payment_invoice pinvf
              on pinvf.service_journal_id = sj.id
              and  pinvf.invoice_type_id = 3

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
