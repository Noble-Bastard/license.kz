<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailJournal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_journal', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->dateTime('planed_send_date');
            $table->string('message_content');
            $table->string('recipients', 1024);
            $table->string('subject', 1024);
            $table->dateTime('actual_send_date')->nullable();
            $table->timestamp('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('created_by')->unsigned();
            $table->smallInteger('email_notify_type_id')->unsigned();
            $table->string('send_status_message',1024)->nullable();
        });


        DB::statement(' 
          ALTER TABLE email_journal MODIFY message_content LONGTEXT;
        ');

        Schema::table('email_journal', function(Blueprint $table)
        {
            $table->foreign('created_by', 'email_journal_created_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('email_notify_type_id', 'email_journal_email_notify_type_fk')->references('id')->on('email_notify_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('email_journal');
    }
}
