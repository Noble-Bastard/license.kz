<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskLogic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_status', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned();
            $table->string('name', 128);
        });

        DB::statement('                    
            insert into task_status (id, name) 
            values
              (1, \'Ожидает\'),
              (2, \'В работе\'),
              (3, \'Закрыто\');  
        ');

        Schema::create('task_relevance', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned();
            $table->string('name', 128);
        });

        DB::statement('                    
            insert into task_relevance (id, name) 
            values
              (1, \'Срочная\'),
              (2, \'Важная\'),
              (3, \'Обычная\');
        ');

        Schema::create('project', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('service_journal_id')->nullable()->unsigned();
            $table->integer('manager_id')->unsigned();
            $table->string('description', 1024);
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('created_by')->unsigned();
        });

        Schema::table('project', function (Blueprint $table){
            $table->foreign('service_journal_id','project_service_journal_fk')->references('id')->on('service_journal');
            $table->foreign('manager_id','project_manager_fk')->references('id')->on('profile');
            $table->foreign('created_by','project_created_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');;
        });

        Schema::create('task', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('project_id')->unsigned();
            $table->smallInteger('task_relevance_id')->nullable()->unsigned();
            $table->integer('service_journal_step_id')->unsigned();
            $table->smallInteger('task_status_id')->unsigned();
            $table->dateTime('execution_time');
            $table->text('description');
            $table->text('result');
            $table->integer('actual_execution_time');
            $table->integer('created_by')->unsigned();
        });

        Schema::table('task', function (Blueprint $table){
            $table->foreign('project_id','task_project_fk')->references('id')->on('project');
            $table->foreign('task_relevance_id','task_task_relevance_fk')->references('id')->on('task_relevance');
            $table->foreign('service_journal_step_id','task_service_journal_step_fk')->references('id')->on('service_journal_step');
            $table->foreign('task_status_id','task_task_status_fk')->references('id')->on('task_status');
            $table->foreign('created_by','task_created_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');;
        });

        Schema::create('task_hist', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('task_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->smallInteger('task_relevance_id')->nullable()->unsigned();
            $table->integer('service_journal_step_id')->unsigned();
            $table->smallInteger('task_status_id')->unsigned();
            $table->dateTime('execution_time');
            $table->text('description');
            $table->text('result');
            $table->integer('actual_execution_time');
            $table->integer('modify_by')->unsigned();
            $table->dateTime('modify_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('task_hist', function (Blueprint $table){
            $table->foreign('task_id','task_hist_task_fk')->references('id')->on('task');
            $table->foreign('project_id','task_hist_project_fk')->references('id')->on('project');
            $table->foreign('task_relevance_id','task_hist_task_relevance_fk')->references('id')->on('task_relevance');
            $table->foreign('service_journal_step_id','task_hist_service_journal_step_fk')->references('id')->on('service_journal_step');
            $table->foreign('task_status_id','task_hist_task_status_fk')->references('id')->on('task_status');
            $table->foreign('modify_by','task_hist_created_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');;
        });

        Schema::create('task_executor', function(Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->integer('task_id')->unsigned();
            $table->integer('executor_id')->unsigned();
            $table->dateTime('assign_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('task_executor', function (Blueprint $table) {
            $table->foreign('task_id', 'task_executor_task_fk')->references('id')->on('task');
            $table->foreign('executor_id', 'task_executor_executor_fk')->references('id')->on('profile');
        });

        Schema::create('task_time_hist', function(Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->integer('task_id')->unsigned();
            $table->dateTime('start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('end_date');
            $table->boolean('is_complete')->default(false);
        });

        Schema::table('task_time_hist', function (Blueprint $table) {
            $table->foreign('task_id', 'task_time_hist_task_fk')->references('id')->on('task');
        });

        Schema::create('task_message', function(Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->integer('task_id')->unsigned();
            $table->integer('message_id')->unsigned();
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('created_by')->unsigned();
        });

        Schema::table('task_message', function (Blueprint $table) {
            $table->foreign('task_id', 'task_message_task_fk')->references('id')->on('task');
            $table->foreign('message_id', 'task_message_message_fk')->references('id')->on('messages');
            $table->foreign('created_by','task_message_created_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');;
        });

        Schema::create('task_document', function(Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->integer('task_id')->unsigned();
            $table->integer('document_id')->unsigned();
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('description', 1024);
        });

        Schema::table('task_document', function (Blueprint $table) {
            $table->foreign('task_id', 'task_document_task_fk')->references('id')->on('task');
            $table->foreign('document_id', 'task_document_document_fk')->references('id')->on('document');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('task_document');
        Schema::drop('task_message');
        Schema::drop('task_time_hist');
        Schema::drop('task_executor');
        Schema::drop('task_hist');
        Schema::drop('task');
        Schema::drop('project');
        Schema::drop('task_status');
        Schema::drop('task_relevance');
    }
}
