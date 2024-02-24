<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',256);
        });

        DB::statement("
            insert into event_type(id, name)
            values (1, 'Собственное мероприятие'),
            (2, 'Стороннее мероприятие')
        ");

        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('event_date');
            $table->string('name', 1024);
            $table->text('content');
            $table->string('city', 128);
            $table->string('place', 512);
            $table->string('preview_photo', 2048)->nullable();
            $table->string('logo_photo', 2048)->nullable();
            $table->unsignedInteger('event_type_id');

            $table->foreign('event_type_id','event_event_type_fk')->references('id')->on('event_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event');
        Schema::dropIfExists('event_type');
    }
}
