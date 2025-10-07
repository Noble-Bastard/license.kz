<?php

namespace App\Http\Controllers\Executor;

use App\Data\Core\Dal\ProfileDal;
use App\Data\Helper\ProjectStatus;
use App\Data\Helper\ServiceStatusList;
use App\Data\Project\Dal\ProjectDal;
use App\Data\Task\Model\ExecutorHourlyRate;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\Task\Dal\TaskDal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function projectList($service_status_id = 1)
    {
        $profile = ProfileDal::getByUserId(Auth::id());
        $executorHourlyRateList = ExecutorHourlyRate::get();
        $executorHourlyRate = $executorHourlyRateList->where('executor_id', $profile->id)->sortByDesc('create_date')->first();
        $hourlyRate = is_null($executorHourlyRate) ? 0 : $executorHourlyRate->hourly_rate;
        $statusList=ProjectDal::getProjectStatusList();
        $projectList = ProjectDal::getProjectListByExecutor($profile->id, true);
        return view('Executor.project.index')
            ->with('projectList', $projectList)
            ->with('statusList',$statusList)
            ->with('service_status_id',$service_status_id)
            ->with('hourlyRate',$hourlyRate);
    }

    public function projectListByStatus($service_status_id)
    {
        return self::projectList($service_status_id);
    }

    public static function projectShow($projectId)
    {
        $profile = ProfileDal::getByUserId(Auth::id());

        $project = ProjectDal::get($projectId);
        $taskList = TaskDal::getListByProjectAndExecutor($projectId, $profile->id);

        foreach ($taskList as $task){
            $task->documentList = $task->taskDocumentList()->get();
        }

        return view('Executor.project.show')
            ->with('project', $project)
            ->with('taskList', $taskList);
    }

    /**
     * Show service modal for executor
     */
    public function serviceModal($serviceJournalId)
    {
        $serviceJournal = ServiceJournalDal::getExt($serviceJournalId);
        $serviceJournal->load('serviceStatus');
        $serviceJournalStepList = ServiceJournalDal::getServiceJournalStepList($serviceJournalId);
        
        // Get documents for the service
        $documents = $serviceJournal->clientDocumentList;
        
        // Get comments and documents for each step
        $comments = collect();
        foreach ($serviceJournalStepList as $step) {
            // Get step comments - пока без привязки к шагу, так как нет колонки service_journal_step_id
            $stepComments = collect(); // Пока пустая коллекция
            $step->comments = $stepComments;
            
            // Get step documents - пока без привязки к шагу, так как нет колонки service_journal_step_id
            $stepDocuments = collect(); // Пока пустая коллекция
            $step->documents = $stepDocuments;
        }
        
        // Get general messages for the service
        $messages = \App\Data\ServiceJournal\Model\ServiceJournalMessageExt::with(['message', 'createdBy.profile'])
            ->where('service_journal_id', $serviceJournalId)
            ->orderBy('create_date', 'asc')
            ->get();
        
        return view('Executor.project.modal')
            ->with('serviceJournal', $serviceJournal)
            ->with('serviceJournalStepList', $serviceJournalStepList)
            ->with('documents', $documents)
            ->with('comments', $comments)
            ->with('messages', $messages);
    }

    /**
     * Send service to check (for Executor)
     */
    public function sendToCheck($serviceJournalId)
    {
        $serviceJournal = ServiceJournalDal::getExt($serviceJournalId);

        if ($serviceJournal->service_status_id == ServiceStatusList::DataCollection) {
            ServiceJournalDal::setServiceJournalStatus($serviceJournalId, ServiceStatusList::Check);

            return response()->json([
                'success' => true,
                'message' => 'Задача отправлена на проверку',
                'new_status' => 'Check'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Задачу можно отправить на проверку только в статусе "Сбор данных"'
        ], 400);
    }
}
