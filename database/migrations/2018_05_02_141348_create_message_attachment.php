<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageAttachment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_attachment', function (Blueprint $table){
           $table->Integer('id', true)->unsigned();
           $table->integer('messages_id')->unsigned();
           $table->string('link', 2048);
       });

        Schema::table('messages_attachment', function(Blueprint $table) {
            $table->foreign('messages_id', 'messages_attachment_messages_fk')->references('id')->on('messages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages_attachment');
    }
}
