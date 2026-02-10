<?php

namespace App\Http\Controllers\Executor;

use App\Data\Core\Dal\ProfileDal;
use App\Data\Helper\ProjectStatus;
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


}
