<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ForceRecreateProfileDocumentExt extends Migration
{
    public function up()
    {
        // Drop the view first to ensure clean recreation
        DB::unprepared("DROP VIEW IF EXISTS profile_document_ext");
        
        // Recreate the view without definer
        DB::unprepared("
            CREATE VIEW profile_document_ext AS
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
                on u.id = p.user_id
        ");
    }

    public function down()
    {
        DB::unprepared("DROP VIEW IF EXISTS profile_document_ext");
    }
}






