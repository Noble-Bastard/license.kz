<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTemplateTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('document_template_type', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned();
            $table->string('name', 32);
        });

        Schema::table('document_type', function (Blueprint $table){
            $table->unsignedSmallInteger('document_template_type_id')->nullable();
            $table->foreign('document_template_type_id','document_type_document_template_type_fk')->references('id')->on('document_template_type');
        });

        DB::statement('
            insert into document_template_type (id, name)
            values
              (1, \'Шаблон счета на оплату\'),
              (2, \'Шаблон договора\');
        ');

        DB::statement('
            insert into document_type (id, name, document_template_type_id)
            values
              (4, \'Cчета на оплату\',1),
              (5, \'Договор\',2);
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_template_type');
    }
}
