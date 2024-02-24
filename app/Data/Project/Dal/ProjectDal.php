<?php
/**
 * Created by PhpStorm.
 * User: R.Biewald
 * Date: 31.05.2018
 * Time: 17:01
 */

namespace App\Data\Project\Dal;


use App\Data\Document\Dal\DocumentDal;
use App\Data\Helper\Assistant;
use App\Data\Helper\ProjectStatus;
use App\Data\Helper\ServiceStatusList;
use App\Data\Project\Model\Project;
use App\Data\Project\Model\ProjectExt;
use App\Data\Project\Model\ProjectStatusTable;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\Task\Dal\TaskDal;
use App\Data\Task\Model\TaskDocumentExt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectDal
{
    public static function get($projectId)
    {
        return Project::where('id', $projectId)->firstOrFail();
    }

    public static function getByServiceJournal($serviceJournalId)
    {
        return Project::where('service_journal_id', $serviceJournalId)->firstOrFail();
    }


    /**
     * @param $projectId
     * @return ProjectExt
     */
    public static function getExt($projectId)
    {
        return ProjectExt::where('id', $projectId)->firstOrFail();
    }

    public static function getProjectListByExecutor($executorId, $isPaginate)
    {
        $projectList = ProjectExt::leftJoin('task', 'project_ext.id', '=', 'task.project_id')
            ->leftJoin('task_executor', 'task.id', '=', 'task_executor.task_id')
            ->leftJoin('service_journal', 'project_ext.service_journal_id', '=', 'service_journal.id')
            ->where('task_executor.executor_id', $executorId)
            ->where('service_journal.service_status_id', ServiceStatusList::Execution)
            ->select('project_ext.*')
            ->distinct()
            ->orderBy('create_date', 'asc');

        if ($isPaginate) {
            $projectList = $projectList->paginate(15);
        } else {
            $projectList = $projectList->get();
        }
        return $projectList;
    }

    public static function assignProjectManager($serviceJournalId, $managerId)
    {
        $project = Project::where('service_journal_id', $serviceJournalId)->first();
        if (!is_null($project)) {

            $project->manager_id = $managerId;
            $project->id = $project->save();

            //todo remove later
            //assign current datetime
            $taskList = TaskDal::getEntityListByProject($project->id);
            foreach ($taskList as $task) {
                $task->execution_time = Assistant::getCurrentDate();
                $task->save();
            }

        }



        return $project;
    }

    /**
     * Set project status
     *
     * @param int $projectId
     * @param int $projectStatusId
     */
    public static function setProjectStatus($projectId, $projectStatusId)
    {
        try {

            DB::beginTransaction();

            //change project status
            $project = Project::where("id", $projectId)->firstOrFail();
            $project->project_status_id = $projectStatusId;
            $project->save();

            //if project status equal Done - copy all document to SJ
            if($projectStatusId == ProjectStatus::Done) {
                self::copyProjectDocumentToServiceJournal($projectId);
            }

            DB::commit();

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }


    /**
     * Copy project documents to service journal documents
     *
     * @param int $projectId
     * @throws \Exception
     */

    public static function copyProjectDocumentToServiceJournal($projectId)
    {
        $taskDocumentList = TaskDocumentExt::where("project_id", $projectId)->get();
        $project = ProjectDal::get($projectId);

        try {

            DB::beginTransaction();

            foreach ($taskDocumentList as $taskDocument) {
                $document = DocumentDal::get($taskDocument->document_id);
                ServiceJournalDal::addServiceJournalDocument(
                    $project->service_journal_id,
                    $document,
                    $taskDocument->description
                );
            }

            DB::commit();

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function getProjectStatusList()
    {
        $entityList = ProjectStatusTable::orderBy('status_order')->get();
        return $entityList;
    }


}
