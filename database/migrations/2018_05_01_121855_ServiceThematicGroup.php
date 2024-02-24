<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceThematicGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_thematic_group', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned();
            $table->smallInteger('service_category_id')->unsigned();
            $table->string('name', 256);
            $table->string('description', 1024);
        });

        Schema::table('service_thematic_group', function(Blueprint $table)
        {
            $table->foreign('service_category_id', 'service_thematic_group_service_category_fk')->references('id')->on('service_category')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        DB::statement('                    
            insert into service_thematic_group (id, service_category_id, name, description) 
            values
              (1, 1, \'Семья\', \'Семья\'),
              (2, 1, \'Недвижимость\', \'Недвижимость\');                                     
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('service_thematic_group');
    }
}
