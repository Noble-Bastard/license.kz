<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceJournalLogicPrepare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('  
            update role set name = \'Client\' where id = 3;                        
        ');

        Schema::table('messages', function(Blueprint $table)
        {
            $table->dropForeign('messages_reply_fk');
            $table->dropForeign( 'messages_services_fk');
            $table->dropForeign('messages_from_user_fk');
            $table->dropForeign( 'messages_to_user_fk');
        });

        Schema::table('messages', function(Blueprint $table)
        {
            $table->dropColumn('from_user_id');
            $table->dropColumn( 'to_user_id');
            $table->dropColumn('services_id');
            $table->dropColumn( 'reply_id');
        });

        Schema::table('service', function(Blueprint $table)
        {
            $table->smallInteger('counter_type_id')->unsigned()->nullable();
        });

        Schema::table('service', function(Blueprint $table)
        {
            $table->foreign('counter_type_id', 'service_counter_type_fk')->references('id')->on('counter_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        DB::statement('  
            update service set counter_type_id = 1;                        
        ');


        DB::statement('
            create or replace view service_ext
            as
            select
               s.id,
               s.description,
               s.is_active,
               s.name,
               s.code,
               s.service_start_date,
               s.service_end_date,
               s.service_thematic_group_id,
               stg.name service_thematic_group_name,
               s.execution_days_from,
               s.execution_days_to,
               s.counter_type_id,
               ct.name counter_type_name
            from service s
               left join service_thematic_group stg
               on stg.id = s.service_thematic_group_id
               left join counter_type ct
               on ct.id = s.counter_type_id
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('  
            update role set name = \'Customer\' where id = 3;                        
        ');
    }
}
