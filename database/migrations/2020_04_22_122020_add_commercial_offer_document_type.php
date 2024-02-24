<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommercialOfferDocumentType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            insert into document_template_type (id, name)
            values
              (5, 'Коммерческое предложение');
        ");
        DB::statement("
            insert into document_type (id, name, document_template_type_id)
            values
              (8, 'Коммерческое предложение', 5);
        ");
        DB::statement("
            insert into document_template (country_id, document_template_type_id)
            values
              (1, 5);
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
