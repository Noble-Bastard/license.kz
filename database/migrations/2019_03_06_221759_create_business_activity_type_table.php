<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessActivityTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_activity_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',256);
        });

        DB::statement("
            insert into business_activity_type(id, name)
            values (1, 'торговая'),
            (2, 'сервисная'),
            (3, 'промышленная')  
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_activity_type');
    }
}
