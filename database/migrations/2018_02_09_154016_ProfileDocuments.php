<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProfileDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('document', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->string('name', 256)->nullable();
            $table->string('path', 1024)->nullable();
        });

        Schema::create('profile_document', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('profile_id')->unsigned();
            $table->integer('document_id')->unsigned();
            $table->unique(array('profile_id', 'document_id'));
        });

        Schema::table('profile_document', function(Blueprint $table)
        {
            $table->foreign('profile_id', 'profile_document_profile_fk')->references('id')->on('profile')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('document_id', 'profile_document_document_fk')->references('id')->on('document')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        DB::statement('
            create or replace view profile_document_ext
            as
            select
                pd.id,
                p.id profile_id,
                p.full_name profile_full_name,
                p.user_id,
                u.name profile_user_name,
                pd.document_id,
                d.name document_name,
                d.path document_path
            from profile p
                inner join profile_document pd 
                on pd.profile_id = p.id
                  inner join document d 
                  on d.id = pd.document_id
                inner join users u
                on u.id = p.user_id;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW profile_document_ext RESTRICT;');
        Schema::drop('profile_document');
        Schema::drop('document');

    }
}
