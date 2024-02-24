<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessageReadHist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function(Blueprint $table)
        {
            $table->dropColumn('is_read');
        });

        DB::statement('
            create or replace view service_journal_message_ext
            as
            select
              sjm.id,
              sjm.service_journal_id,
              sj.service_no service_journal_no,
              sjm.message_id,
              msg.caption message_caption,
              msg.create_date message_create_date,
              msg.message,
              sjm.create_date,
              sjm.created_by,
              prf.full_name created_by_full_name,
              r.id created_by_role_id,
              r.name created_by_role_name
            from service_journal_message sjm
              left join service_journal sj
              on sj.id = sjm.service_journal_id
              left join messages msg
              on msg.id = sjm.message_id
              left join users usr
              on usr.id = sjm.created_by
                left join user_role ur
                on ur.user_id = usr.id
                  left join role r
                  on r.id = ur.role_id
              left join profile prf
              on prf.user_id = sjm.created_by

        ');

        Schema::create('messages_read_hist', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('message_id')->unsigned();
            $table->integer('read_by')->unsigned();
            $table->timestamp('read_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('messages_read_hist', function(Blueprint $table)
        {
            $table->foreign('message_id', 'messages_read_hist_messages_fk')->references('id')->on('messages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('read_by', 'messages_read_hist_read_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
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
