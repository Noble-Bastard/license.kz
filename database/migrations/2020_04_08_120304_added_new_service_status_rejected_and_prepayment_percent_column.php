<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddedNewServiceStatusRejectedAndPrepaymentPercentColumn extends Migration
{

    public function up()
    {
        DB::unprepared("
            INSERT INTO service_status(id, name) VALUES(10, 'Отклонена');
            INSERT INTO ilicense.translation (translation_attribute_id, language_id, pk_value, value) VALUES (18, 2, 10, 'Rejected);
        ");

        Schema::table('service_journal', function (Blueprint $table) {
            $table->decimal('prepayment_percent',9,2)->nullable();
            $table->string('reject_reason',1024)->nullable();
        });
    }


    public function down()
    {
        //
    }
}
