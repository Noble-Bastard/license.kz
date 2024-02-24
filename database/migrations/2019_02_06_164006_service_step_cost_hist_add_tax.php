<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceStepCostHistAddTax extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_step_cost_hist', function(Blueprint $table){
            $table->decimal('tax', 9, 2);
        });
        Schema::table('service_journal_payment', function(Blueprint $table){
            $table->decimal('tax', 9, 2);
        });

        \Illuminate\Support\Facades\DB::statement("
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
              ch.tax step_tax,
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

        \Illuminate\Support\Facades\DB::statement("
            create or replace view service_journal_ext
            as
            select
              sj.id,
              sj.service_status_id,
              ss.name service_status_name,
              sj.service_id,
              rft.counter_type_id registration_form_template_counter_type_id,
              s.name service_name,
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
              sjp.tax,
              sjp.currency_id,
              crc.name currency_name,
              sjp.is_payed,
              prj.id project_id,
              prj.project_status_id,
              prjs.name project_status_name,
              sj.country_id,
              agr.agreement_no,
              agr.agreement_date,
              pinv.payment_invoice_no,
              pinv.payment_invoice_date,
              pinv.payment_status_id,
              pays.name payment_status_name
            from service_journal sj
              left join service_status ss
              on ss.id = sj.service_status_id
              left join service s
              on s.id = sj.service_id
                left join service_registration_form_template srft
                on srft.service_id = s.id
                  left join registration_form_template rft
                  on rft.id = srft.registration_form_template_id
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
              left join agreement agr
              on agr.service_journal_id = sj.id
              left join payment_invoice pinv
              on pinv.service_journal_id = sj.id
                left join payment_type pays
                on pays.id = pinv.payment_status_id
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
