<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistrationFormParameterExt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('registration_form_parameter', function ($table) {
            $table->integer('registration_form_parameter_template_id')->unsigned();
        });

        Schema::table('registration_form_parameter', function ($table) {
            $table->foreign('registration_form_parameter_template_id','registration_form_parameter_parameter_template_fk')->references('id')->on('registration_form_parameter_template');
        });


        DB::statement('
            create or replace view registration_form_parameter_ext
            as
              select
                rfpt.id,
                rfpt.registration_form_parameter_template_id,
                rfpt.registration_form_group_id,
                rfg.registration_form_id,
                rf.form_number registration_form_form_number,
                rf.create_date registration_form_create_date,
                rf.service_journal_id,
                rfg.parameter_group_id,
                pg.name parameter_group_name,
                rfpt.parameter_type_id,
                pt.name parameter_type_name,
                pt.data_type parameter_type_data_type,
                rfpt.caption,
                rfpt.comment,
                rfpt.order_number,
                rfpt.parameter_formatted_value,
                pnv.parameter_value parameter_number_value,
                pdv.parameter_value parameter_datetime_value,
                pbv.parameter_value parameter_bool_value,
                pov.optionset_id parameter_optionset_id,
                pov.optionset_type_id parameter_optionset_type_id,
                pov.optionset_value parameter_optionset_value,
                ot.name parameter_optionset_type_name,
                ovt.optionset_id_list,
                ovt.optionset_value_list,
                pds.date_format parameter_datetime_format,
                pds.default_value parameter_datetime_default_value,
                pns.max_value parameter_number_max_value,
                pns.min_value parameter_number_min_value,
                pns.round_type parameter_number_round_type,
                pns.default_value parameter_number_default_value,
                pts.validation_mask parameter_text_validation_mask,
                pts.default_value parameter_text_default_value
              from registration_form_parameter rfpt
                left join registration_form_group rfg
                on rfg.id = rfpt.registration_form_group_id
                  left join registration_form rf
                  on rf.id = rfg.registration_form_id
                  left join parameter_group pg
                  on pg.id = rfg.parameter_group_id
                  left join parameter_type pt
                  on pt.id = rfpt.parameter_type_id
                    left join parameter_datetime_setting pds
                    on pds.parameter_type_id = pt.id
                    left join parameter_number_setting pns
                    on pns.parameter_type_id = pt.id
                    left join parameter_text_setting pts
                    on pts.parameter_type_id = pt.id
                left join parameter_number_value pnv
                on pnv.registration_form_parameter_id = rfpt.id
                left join parameter_datetime_value pdv
                on pdv.registration_form_parameter_id = rfpt.id
                left join parameter_bool_value pbv
                on pbv.registration_form_parameter_id = rfpt.id
                left join parameter_optionset_value pov
                on pov.registration_form_parameter_id = rfpt.id
                  left join optionset_type ot
                  on ot.id = pov.optionset_type_id
                      left join (select
                                 optionset_type_id,
                                 group_concat(optionset_value SEPARATOR \';\') optionset_value_list,
                                 group_concat(optionset_id SEPARATOR \';\') optionset_id_list
                               from optionset_value_template
                               group by optionset_type_id) ovt
                      on ovt.optionset_type_id = ot.id

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
