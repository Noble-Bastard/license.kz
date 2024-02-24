<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequiredDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_required_document', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->string('description', 4096);
            $table->integer('document_template_id')->unsigned()->nullable();
        });

        Schema::table('service_required_document', function(Blueprint $table)
        {
            $table->foreign('document_template_id', 'service_required_document_document_fk')->references('id')->on('document')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        DB::unprepared("
            insert into service_required_document(description, document_template_id)
            select 
                description,
                max(document_template_id)
            from service_step_required_document
            group by description
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_required_document');
    }
}
