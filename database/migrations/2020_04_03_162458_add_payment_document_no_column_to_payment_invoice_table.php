<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentDocumentNoColumnToPaymentInvoiceTable extends Migration
{
    public function up()
    {
        Schema::table('payment_invoice', function (Blueprint $table) {
            $table->string('payment_document_no', 64)->nullable();
        });
    }

    public function down()
    {
        Schema::table('payment_invoice', function (Blueprint $table) {
            $table->dropColumn('payment_document_no', 64);
        });
    }
}
