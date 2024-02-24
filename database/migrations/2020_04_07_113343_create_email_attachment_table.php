<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_attachment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('email_journal_id');
            $table->string('file_path', 1024);
            $table->string('name', 256);

            $table->foreign('email_journal_id', 'email_attachment_email_journal_fk')->references('id')->on('email_journal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_attachment');
    }
}
