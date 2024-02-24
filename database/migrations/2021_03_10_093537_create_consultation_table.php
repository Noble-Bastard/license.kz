<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('consultation_no', 32);
            $table->timestamp('create_date')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));
            $table->string('name', 256);
            $table->string('phone', 32);
            $table->string('activity', 1024);
            $table->string('question', 4096);
        });

        \Illuminate\Support\Facades\DB::statement("
            insert into counter_type(id, code, name)
            values(
                14,
                'ADDITIONAL_SERVICE',
                'Консультация'
            );
        ");

        \Illuminate\Support\Facades\DB::statement('
            insert into counter(id, counter_type_id, mask, length, increase, sequence, country_id)
            values
            ( 17,14,\'КОНС-\',6,1,0, null);
        ');

        Schema::create('consultation_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('consultation_id');
            $table->string('pg_status');
            $table->integer('pg_payment_id')->nullable();
            $table->string('pg_error_code')->nullable();
            $table->string('pg_error_description')->nullable();
            $table->string('pg_currency')->nullable();
            $table->integer('pg_amount')->nullable();
            $table->string('pg_payment_system')->nullable();
            $table->integer('pg_result')->nullable();
            $table->string('pg_payment_date')->nullable();
            $table->integer('pg_can_reject')->nullable();
            $table->string('pg_card_brand')->nullable();
            $table->string('pg_card_pan')->nullable();
            $table->integer('pg_failure_code')->nullable();
            $table->string('pg_failure_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultation_payment');
        Schema::dropIfExists('consultation');
    }
}
