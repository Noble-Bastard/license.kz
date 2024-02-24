<?php
/**
 * Created by PhpStorm.
 * User: r.biewald
 * Date: 14.05.2018
 * Time: 16:27
 */

namespace App\Data\Task\Dal;

use App\Data\Document\Dal\DocumentDal;
use App\Data\Document\Model\Document;
use App\Data\Helper\Assistant;
use App\Data\Helper\ProjectStatus;
use App\Data\Helper\TaskRelevance;
use App\Data\Helper\TaskStatus;
use App\Data\Project\Dal\ProjectDal;
use App\Data\Project\Model\Project;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\Task\Model\TaskDocument;
use App\Data\Task\Model\Task;
use App\Data\Task\Model\TaskDocumentExt;
use App\Data\Task\Model\TaskExecutor;
use App\Data\Task\Model\TaskExt;
use App\Data\Task\Model\TaskHist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskDal
{
    /**
     * @param int $taskId
     * @return TaskExt
     */
    public static function get($taskId)
    {
        $task = TaskExt::where('id', $taskId)->firstOrFail();
        return $task;
    }

    /**
     * @param Task $task
     * @return Task
     * @throws \Exception
     */
    public static function set(Task $task)
    {
        try {
            DB::beginTransaction();
            $newTask = null;

            $newTask = is_null($task->id) ? new Task() : Task::where('id', $task->id)->firstOrFail();

            $newTask->project_id = $task->project_id;
            $newTask->task_relevance_id = $task->task_relevance_id;
            $newTask->service_journal_step_id = $task->service_journal_step_id;
            $newTask->task_status_id = $task->task_status_id;
            $newTask->execution_time = $task->execution_time;
            $newTask->description = $task->description;
            $newTask->result = $task->result;
            $newTask->actual_execution_time = $task->actual_execution_time;


            if (is_null($task->id)) {
                $newTask->created_by = Auth::id();
            }
            $newTask->save();

            self::addTaskHist($task);

            DB::commit();

            return $newTask;
        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }


    /**
     * @param int $projectId
     * @return \Illuminate\Support\Collection
     */
    public static function getListByProject(int $projectId)
    {
        $taskList = TaskExt::where('project_id', $projectId)->get();
        return $taskList;
    }

    /**
     * @param int $projectId
     * @return \Illuminate\Support\Collection
     */
    public static function getEntityListByProject(int $projectId)
    {
        $taskList = Task::where('project_id', $projectId)->get();
        return $taskList;
    }


    /**
     * @param int $projectId
     * @param int $executorId
     * @return \Illuminate\Support\Collection
     */
    public static function getListByProjectAndExecutor(int $projectId, int $executorId)
    {
        $taskList = TaskExt::
            leftJoin('task_executor', 'task_executor.task_id', '=', 'task_ext.id')
            ->select('task_ext.*')
            ->where('project_id', $projectId)
            ->where('executor_id', $executorId)
            ->orderBy('execution_time')
            ->get();
        return $taskList;
    }

    /**
     * @param int $taskId
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public static function getTaskExecutorsList(int $taskId)
    {
        $task = self::get($taskId);
        return $task->taskExecutorList();
    }

    /**
     * @param int $taskId
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public static function getTaskTimeHistList(int $taskId)
    {
        $task = self::get($taskId);
        return $task->taskTimeHistList();
    }

    /**
     * @param int $taskId
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public static function getTaskHistList(int $taskId)
    {
        $task = self::get($taskId);
        return $task->taskHistList();
    }

    /**
     * @param int $taskId
     * @param int $executorId
     * @return TaskExecutor
     */
    public static function assignExecutor(int $taskId, int $executorId)
    {
        if(TaskExecutor::where('task_id', $taskId)->where('executor_id', $executorId)->doesntExist()) {
            $taskExecutor = new TaskExecutor();
            $taskExecutor->task_id = $taskId;
            $taskExecutor->executor_id = $executorId;
            $taskExecutor->save();

            return $taskExecutor;
        }
    }

    /**
     * @param int $taskId
     * @param int $executorGroupId
     * @return array|TaskExecutor[]
     */
    public static function assignExecutorGroup(int $taskId, int $executorGroupId)
    {
        $executorGroupBodyList = ExecutorGroupBodyDal::getListByExecutorGroupId($executorGroupId);
        $taskExecutorList = array();
        foreach ($executorGroupBodyList as $executorGroupBody) {
            if(TaskExecutor::where('task_id', $taskId)->where('executor_id', $executorGroupBody->profile_id)->doesntExist()) {
                $taskExecutor = new TaskExecutor();
                $taskExecutor->task_id = $taskId;
                $taskExecutor->executor_id = $executorGroupBody->profile_id;
                $taskExecutor->save();
                array_push($taskExecutorList, $taskExecutor);
            }
        }

        return $taskExecutorList;
    }

    public static function unassignExecutor ($executortaskId)
    {
        TaskExecutor::where('id', $executortaskId)->delete();
        return true;
    }
    /**
     * @param int $taskId
     * @return \Illuminate\Support\Collection
     */
    public static function getTaskDocumentListBy(int $taskId)
    {
        $taskDoc = TaskDocumentExt::where('task_id', $taskId)->get();
        return $taskDoc;
    }

    /**
     * @param int $documentId
     * @return bool
     *
     * @throws \Exception
     */
    public static function deleteTaskDocument(int $documentId)
    {
        TaskDocument::where('document_id', $documentId)->delete();
        return true;
    }

    /**
     * @param int $serviceJournalId
     * @return Project
     * @throws \Exception
     */
    public static function generateTaskByServiceJournal(int $serviceJournalId)
    {
        $serviceJournal = ServiceJournalDal::getExt($serviceJournalId);
        $serviceJournalStepList = ServiceJournalDal::getServiceJournalStepList($serviceJournal->id);

        try {
            DB::beginTransaction();

            $project = new Project();
            $project->service_journal_id = $serviceJournal->id;
            $project->manager_id = $serviceJournal->manager_id;
            $project->description = $serviceJournal->service_no;
            $project->create_date = $serviceJournal->create_date;
            $project->created_by = Auth::id();
            $project->project_status_id = ProjectStatus::Waiting;
            $project->save();

            foreach ($serviceJournalStepList as $serviceJournalStep){
                $task = new Task();
                $task->project_id = $project->id;
                $task->task_relevance_id = TaskRelevance::Usual;
                $task->service_journal_step_id = $serviceJournalStep->id;
                $task->task_status_id = TaskStatus::Waiting;
                $task->execution_time = $serviceJournalStep->execution_start_date;
                $task->description = $serviceJournalStep->service_step_description;
                $task->result = '';
                $task->actual_execution_time = 0;
                $task->execution_time_plan = $serviceJournalStep->execution_time_plan;
                $task->execution_time_fact = 0;
                $task->created_by = Auth::id();
                $task->save();

                self::addTaskHist($task);
            }

            DB::commit();

            return $project;
        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * Add task document (required documents)
     *
     * @param int $taskId
     * @param Document $document
     * @param string $description
     * @return TaskDocument
     *
     * @throws \Exception
     */
    public static function addTaskDocument(int $taskId, Document $document, string $description)
    {

        try {
            DB::beginTransaction();

            $savedDocument = DocumentDal::set($document);

            $taskDocument = new TaskDocument();
            $taskDocument->task_id = $taskId;
            $taskDocument->document_id = $savedDocument->id;
            $taskDocument->create_date = Assistant::getCurrentDate();
            $taskDocument->description = $description;
            $taskDocument->save();

            DB::commit();

            return $taskDocument;
        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * @param $taskId
     * @return Task|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public static function startTask($taskId)
    {
        try {
            DB::beginTransaction();

            $task = Task::where('id', $taskId)->firstOrFail();
            if ($task->task_status_id == TaskStatus::Waiting) {
                $task->task_status_id = TaskStatus::InWork;
                $task->save();
            }

            $project = ProjectDal::get($task->project_id);
            if($project->project_status_id == ProjectStatus::Waiting) {
                ProjectDal::setProjectStatus($task->project_id, ProjectStatus::InWork);
            }

            self::addTaskHist($task);

            DB::commit();

            return $task;
        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }


    /**
     * Check: are all project's tasks closed
     *
     * @param int $projectId
     * @return bool
     */
    private static function isAllProjectTasksClosed($projectId)
    {
        $task = Task::where("project_id",$projectId)
            ->where("task_status_id","!=",TaskStatus::Closed)
            ->first();
        return $task == null;
    }

    /**
     * @param int $taskId
     * @param int $executionTimeFact
     * @param string $result
     * @return Task|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public static function closeTask(int $taskId, int $executionTimeFact, string $result)
    {
        try {
            DB::beginTransaction();

            $task = Task::where('id', $taskId)->firstOrFail();

            $task->task_status_id = TaskStatus::Closed;
            $task->execution_time_fact = $executionTimeFact;
            $task->result = $result;
            $task->save();

            self::addTaskHist($task);

            ServiceJournalDal::completeServiceJournalStep($task->service_journal_step_id);

            //check is all tasks complete, close project if true
            if(self::isAllProjectTasksClosed($task->project_id))
            {
                ProjectDal::setProjectStatus($task->project_id, ProjectStatus::Closed);
            }

            DB::commit();

            return $task;
        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    /**
     * @param int $taskId
     * @param int $taskRelevance
     * @return Task|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public static function changeRelevance(int $taskId, int $taskRelevance)
    {
        try {
            DB::beginTransaction();

            $task = Task::where('id', $taskId)->firstOrFail();

            $task->task_status_id = TaskStatus::Closed;
            $task->task_relevance_id = $taskRelevance;
            $task->save();

            self::addTaskHist($task);

            DB::commit();

            return $task;
        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    private static function addTaskHist(Task $task)
    {
        $taskHist = new TaskHist();
        $taskHist->task_id = $task->id;
        $taskHist->project_id = $task->project_id;
        $taskHist->task_relevance_id = $task->task_relevance_id;
        $taskHist->service_journal_step_id = $task->service_journal_step_id;
        $taskHist->task_status_id = $task->task_status_id;
        $taskHist->execution_time = $task->execution_time;
        $taskHist->description = $task->description;
        $taskHist->result = $task->result;
        $taskHist->actual_execution_time = $task->actual_execution_time;
        $taskHist->execution_time_plan = $task->execution_time_plan;
        $taskHist->execution_time_fact = $task->execution_time_fact;
        $taskHist->modify_by = Auth::id();
        $taskHist->save();
    }


    /**
     * @param int $taskId
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public static function getTaskExecutorsListByProject(int $projectId)
    {
        $taskExecutorList = Task::
            leftJoin('task_executor_ext', 'task.id', '=', 'task_executor_ext.task_id')
            ->where('task.project_id', $projectId)
            ->select('task_executor_ext.*')
            ->get();

      return $taskExecutorList;
    }


    /**
     * @param int $taskId
     * @param $taskStatus
     * @return Task
     * @throws \Exception
     */
    public static function setTaskStatus(int $taskId, $taskStatus)
    {
        try {
            DB::beginTransaction();

            $task = Task::where('id', $taskId)->firstOrFail();
            $task->task_status_id = $taskStatus;
            $task->save();

            self::addTaskHist($task);

            DB::commit();

            return $task;
        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function getTaskExecutionTimeByManager($managerId)
    {
        $taskExecutionTime = TaskExt::where('manager_id', $managerId)
            ->sum('execution_time_plan');

        return $taskExecutionTime;
    }

    public static function getTaskCntByManager($managerId)
    {
        $taskCnt = TaskExt::where('manager_id', $managerId)
            ->count('id');

        return $taskCnt;
    }
    public static function getTaskOnExecutorsCntByManager($managerId)
    {
        $taskOnExecutorsCnt = TaskExt::
            leftJoin('task_executor_ext', 'task_ext.id', '=', 'task_executor_ext.task_id')
            ->where('task_ext.manager_id', $managerId)
            ->distinct('task_executor_ext.task_id')
            ->count('task_executor_ext.task_id');

        return $taskOnExecutorsCnt;
    }

}
