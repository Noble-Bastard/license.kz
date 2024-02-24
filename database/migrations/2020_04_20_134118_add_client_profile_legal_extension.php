<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddClientProfileLegalExtension extends Migration
{

    public function up()
    {
        Schema::create('bank_code_type', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name',32);
        });

        DB::unprepared("
            insert into bank_code_type
            values (1, 'БИК'),
            (2, 'ИИК')
        ");

        Schema::table('profile_legal', function (Blueprint $table) {
            $table->unsignedSmallInteger('bank_code_type_id')->nullable();
            $table->string('bank_code', 128)->nullable();
            $table->string('director_name', 128)->nullable();
            $table->string('legal_address', 128)->nullable();
            $table->foreign('bank_code_type_id', 'profile_legal_bat_fk')
                ->references('id')->on('bank_code_type');
        });

        Schema::create('service_journal_profile_legal', function(Blueprint $table)
        {
            $table->integerIncrements('id');
            $table->integer('service_journal_id')->unsigned()->nullable();
            $table->string('company_name', 128)->nullable();
            $table->string('business_identification_number', 16)->nullable();
            $table->string('contact_person', 128)->nullable();
            $table->string('position', 256)->nullable();
            $table->string('scope_activity', 1024)->nullable();
            $table->unsignedSmallInteger('bank_code_type_id')->nullable();
            $table->string('bank_code', 128)->nullable();
            $table->string('director_name', 128)->nullable();
            $table->string('legal_address', 512)->nullable();
            $table->unique(['service_journal_id'], 'service_journal_profile_legal_uix');
        });

        Schema::table('service_journal_profile_legal', function (Blueprint $table) {
            $table->foreign('service_journal_id','service_journal_profile_legal_sj_fk')
                ->references('id')->on('service_journal');
            $table->foreign('bank_code_type_id', 'service_journal_profile_legal_bat_fk')
                ->references('id')->on('bank_code_type');
        });
    }

    public function down()
    {
        Schema::table('profile_legal', function (Blueprint $table) {
            $table->dropForeign('profile_legal_bat_fk');
            $table->dropColumn('bank_code_type_id');
            $table->dropColumn('bank_code');
            $table->dropColumn('director_name');
            $table->dropColumn('legal_address');
        });

        Schema::dropIfExists("service_journal_profile_legal");
        Schema::dropIfExists("bank_code_type");
    }
}
