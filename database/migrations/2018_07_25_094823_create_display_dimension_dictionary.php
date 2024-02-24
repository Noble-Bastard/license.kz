<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisplayDimensionDictionary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('display_dimension_type', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->string('name', 8);
            $table->string('description', 128);
        });

        DB::statement("
            insert into display_dimension_type values 
            (1, 'xl', '≥ 1200px'),
            (2, 'lg', '992px - 1200px'),
            (3, 'md', '768px - 992px'),
            (4, 'sm', '576px - 768px'),            
            (5, 'xs', '< 576px')           
        ");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('display_dimension_type');
    }
}
