<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedDemoProjectsForExecutorTesting extends Migration
{
    public function up()
    {
        // Insert minimal demo data only if tables are empty enough to avoid duplication
        $managerId = DB::table('profile')->orderBy('id')->value('id');
        $clientId = DB::table('profile')->orderBy('id')->skip(1)->value('id') ?: $managerId;
        $serviceId = DB::table('service')->orderBy('id')->value('id');
        $executorProfileId = DB::table('profile')->orderBy('id')->skip(2)->value('id') ?: $managerId;

        if (!$managerId || !$serviceId) {
            return; // Can't seed without base refs
        }

        // Ensure at least one open service journal
        $sjInsert = [
            'service_status_id' => 5, // Execution
            'client_id' => $clientId,
            'manager_id' => $managerId,
            'service_no' => 'SJ-DEMO-' . uniqid(),
            'create_date' => DB::raw('CURRENT_TIMESTAMP'),
            'modify_date' => null,
        ];
        if (Schema::hasColumn('service_journal', 'service_id')) {
            $sjInsert['service_id'] = $serviceId;
        }
        $sjId = DB::table('service_journal')->insertGetId($sjInsert);

        // If service_journal.service_id does not exist, link via map if present
        if (!Schema::hasColumn('service_journal', 'service_id') && Schema::hasTable('service_journal_service_map')) {
            DB::table('service_journal_service_map')->insert([
                'service_journal_id' => $sjId,
                'service_id' => $serviceId,
            ]);
        }

        // Add minimal step so tasks can be generated
        $stepId = DB::table('service_step')->orderBy('id')->value('id');
        if (!$stepId) {
            // Create a minimal dummy step compatible with current schema
            $counterTypeId = DB::table('counter_type')->orderBy('id')->value('id') ?: 1;
            $stepId = DB::table('service_step')->insertGetId([
                'description' => 'Demo execution step',
                'execution_work_day_cnt' => 1,
                'counter_type_id' => $counterTypeId,
            ]);
        }

        $sjStepId = DB::table('service_journal_step')->insertGetId([
            'service_journal_id' => $sjId,
            'service_step_id' => $stepId,
            'service_step_no' => '1',
            'is_completed' => 0,
            'execution_start_date' => DB::raw('CURRENT_TIMESTAMP'),
            'completion_date' => null,
        ]);

        // Create project
        $projectId = DB::table('project')->insertGetId([
            'service_journal_id' => $sjId,
            'manager_id' => $managerId,
            'description' => 'Демо проект для теста исполнителя',
            'create_date' => DB::raw('CURRENT_TIMESTAMP'),
            'created_by' => DB::table('users')->orderBy('id')->value('id') ?: 1,
            'project_status_id' => 1,
        ]);

        // Create tasks
        $taskId = DB::table('task')->insertGetId([
            'project_id' => $projectId,
            'task_relevance_id' => 3,
            'service_journal_step_id' => $sjStepId,
            'task_status_id' => 1,
            'execution_time' => DB::raw('CURRENT_TIMESTAMP'),
            'description' => 'Выполнить шаг 1',
            'result' => '',
            'actual_execution_time' => 0,
            'created_by' => DB::table('users')->orderBy('id')->value('id') ?: 1,
            'execution_time_plan' => 1,
            'execution_time_fact' => 0,
        ]);

        // Assign executor
        DB::table('task_executor')->insert([
            'task_id' => $taskId,
            'executor_id' => $executorProfileId,
            'assign_date' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }

    public function down()
    {
        // Best-effort cleanup of demo records
        $projects = DB::table('project')->where('description', 'Демо проект для теста исполнителя')->pluck('id');
        if ($projects->isNotEmpty()) {
            DB::table('task_executor')->whereIn('task_id', function($q) use ($projects){
                $q->select('id')->from('task')->whereIn('project_id', $projects);
            })->delete();
            DB::table('task')->whereIn('project_id', $projects)->delete();
            DB::table('project')->whereIn('id', $projects)->delete();
        }
        DB::table('service_journal')->where('service_no', 'like', 'SJ-DEMO-%')->delete();
    }
}






