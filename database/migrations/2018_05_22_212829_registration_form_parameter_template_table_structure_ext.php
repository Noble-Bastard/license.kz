<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistrationFormParameterTemplateTableStructureExt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registration_form_parameter_template_table', function(Blueprint $table)
        {
            $table->unique('registration_form_parameter_template_id','registration_form_parameter_template_table_uix');
        });

        DB::statement('
            create or replace view registration_form_parameter_template_table_structure_ext
            as
            select
              rfptts.id,
              rfptts.registration_form_parameter_template_table_id,
              rfptts.column_parameter_template_id,
              rfptt.registration_form_parameter_template_id,
              rfptt.table_caption
            from registration_form_parameter_template_table_structure  rfptts
              left join registration_form_parameter_template_table rfptt
              on rfptt.id = rfptts.registration_form_parameter_template_table_id
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
