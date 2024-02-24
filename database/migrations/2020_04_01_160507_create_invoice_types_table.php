<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTypesTable extends Migration
{

    public function up()
    {
        Schema::create('invoice_type', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name',32);
        });

        DB::unprepared("
            insert into invoice_type
            values (1, 'Проверка клиента'),
            (2, 'Предоплата'),
            (3, 'Полная оплата')
        ");

        DB::unprepared("
            insert into document_template_type
            values (4, 'Договор проверки клиента');
        ");

        DB::unprepared("
             INSERT INTO document_type (id, name, document_template_type_id)
             VALUES (7, 'Договор на проверку', 4);

        ");

        Schema::create('agreement_type', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name',32);
        });

        DB::unprepared("
            insert into agreement_type
            values (1, 'Проверка клиента'),
            (3, 'Полная оплата')
        ");


        Schema::table('invoice', function (Blueprint $table) {
            $table->unsignedSmallInteger('invoice_type_id')->nullable();
            $table->foreign('invoice_type_id', 'invoice_invoice_type_fk')->references('id')->on('invoice_type');

            $table->dropForeign('invoice_service_journal_fk');
            $table->dropUnique('invoice_uix');
            $table->unique(['service_journal_id','invoice_type_id'],'invoice_uix');
            $table->foreign('service_journal_id', 'invoice_service_journal_fk')->references('id')->on('service_journal');
        });

        Schema::table('payment_invoice', function (Blueprint $table) {
            $table->unsignedSmallInteger('invoice_type_id')->nullable();
            $table->foreign('invoice_type_id', 'payment_invoice_invoice_type_fk')->references('id')->on('invoice_type');
            $table->dropForeign('payment_invoice_service_journal_fk');
            $table->dropUnique('payment_invoice_uix');
            $table->unique(['service_journal_id','invoice_type_id'],'payment_invoice_uix');
            $table->foreign('service_journal_id', 'payment_invoice_service_journal_fk')->references('id')->on('service_journal');

        });

        Schema::table('agreement', function (Blueprint $table) {
            $table->unsignedSmallInteger('agreement_type_id')->nullable();
            $table->foreign('agreement_type_id', 'agreement_agreement_type_fk')->references('id')->on('agreement_type');
            $table->dropForeign('agreement_service_journal_fk');
            $table->dropUnique('agreement_uix');
            $table->unique(['service_journal_id','agreement_type_id'],'agreement_uix');
            $table->foreign('service_journal_id','agreement_service_journal_fk')->references('id')->on('service_journal');

        });

    }

    public function down()
    {
        Schema::dropIfExists('invoice_type');
        Schema::dropIfExists('agreement_type');
    }
}
