<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('reply_id')->nullable()->unsigned();
            $table->text('caption')->nullable();
            $table->text('message');
            $table->integer('from_user_id')->unsigned();
            $table->integer('to_user_id')->unsigned();
            $table->integer('services_id')->unsigned();
            $table->integer('email_journal_id')->nullable()->unsigned();
            $table->boolean('is_read')->default(false);
            $table->timestamp('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('messages', function(Blueprint $table)
        {
            $table->foreign('reply_id', 'messages_reply_fk')->references('id')->on('messages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('services_id', 'messages_services_fk')->references('id')->on('service')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('email_journal_id', 'messages_email_journal_fk')->references('id')->on('email_journal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('from_user_id', 'messages_from_user_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('to_user_id', 'messages_to_user_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
    }
}
