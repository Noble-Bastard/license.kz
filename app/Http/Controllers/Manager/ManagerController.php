<?php

namespace App\Http\Controllers\Manager;

use App\Data\Core\Dal\ProfileDal;
use App\Data\Helper\ClientCheckResultTypeList;
use App\Data\Helper\ProjectReviewStatus;
use App\Data\Helper\ProjectStatus;
use App\Data\Helper\RoleList;
use App\Data\Helper\ServiceStatusList;
use App\Data\Project\Dal\ProjectDal;
use App\Data\Review\Dal\ProjectReviewDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\Task\Dal\ExecutorGroupBodyDal;
use App\Data\Task\Dal\ExecutorGroupDal;
use App\Data\Task\Dal\TaskDal;
use App\Data\Task\Dal\TaskExecutorDal;
use App\Data\Task\Model\ExecutorGroup;
use App\Data\Task\Model\ExecutorHourlyRate;
use App\Data\ServiceJournal\Dal\ServiceJournalMessageDal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use stdClass;

class ManagerController extends Controller
{
    public function executorsList(){
        $manager = ProfileDal::getByUserId(Auth::id());
        $executorList = ProfileDal::getListByRolesAndManager([RoleList::Executor], $manager->id, true);
        $taskCnt=TaskDal::getTaskCntByManager($manager->id);
        $taskOnExecutors=TaskDal::getTaskOnExecutorsCntByManager($manager->id);
        $taskExecutionTime=TaskDal::getTaskExecutionTimeByManager($manager->id);

        $executorHourlyRateList = ExecutorHourlyRate::get();
        foreach ($executorList as $executor){
            $executorHourlyRate = $executorHourlyRateList->where('executor_id', $executor->id)->sortByDesc('create_date')->first();
            $executor->hourlyRate = is_null($executorHourlyRate) ? 0 : $executorHourlyRate->hourly_rate;
        }

        return view('Manager.Executor.index')
            ->with('executorList', $executorList)
            ->with('taskCnt',$taskCnt)
            ->with('taskOnExecutors',$taskOnExecutors)
            ->with('taskExecutionTime',$taskExecutionTime);
    }

    public function groupsList(){

        $groupList = ExecutorGroupDal::getList(true);

        return view('Manager.Groups.index')
            ->with('groupList', $groupList);
    }

    public function servicesList(Request $request){
        $manager = ProfileDal::getByUserId(Auth::id());
        $statusList = ProjectDal::getProjectStatusList();
        
        $statusId = $request->input('status_id', null);
        
        $serviceJournalList = ServiceJournalDal::getServiceJournalListByManager(
            $manager->id,
            true, //
            $statusId
        );
        
        $curatorList = ProfileDal::getListByRoles([RoleList::Curator], false);

        return view('Manager.Services.index')
            ->with('serviceJournalList', $serviceJournalList)
            ->with('statusList', $statusList)
            ->with('curatorList', $curatorList);
    }


    public function servicesListByStatus($projectStatusId){
        $manager = ProfileDal::getByUserId(Auth::id());
        $entityData = new stdClass();
        $entityData->serviceJournalList = ServiceJournalDal::getServiceJournalListByManager(
            $manager->id,
            false,
            $projectStatusId
        );
        return response()->json($entityData);
    }

    public function servicesJournalShow($serviceJournalId){
        $manager = ProfileDal::getByUserId(Auth::id());

        $serviceJournalList = ServiceJournalDal::getServiceJournalListByManager($manager->id, true);
        $serviceJournal = ServiceJournalDal::getExt($serviceJournalId);
        
        // Ensure we have a single model, not a collection
        if ($serviceJournal instanceof \Illuminate\Database\Eloquent\Collection) {
            $serviceJournal = $serviceJournal->first();
        }
        
        if (!$serviceJournal) {
            abort(404, 'Service Journal not found');
        }
        
        $serviceJournal->load('serviceStatus');
        $serviceJournalStepList = ServiceJournalDal::getServiceJournalStepList($serviceJournalId);
        $taskExecutorList = TaskDal::getTaskExecutorsListByProject($serviceJournal->project_id);
        $executorList = ProfileDal::getListByRolesAndManager([RoleList::Executor], $manager->id, true);
        $groupList = ExecutorGroupDal::getList(true);
        
        // Add documents, comments, and messages data
        $documents = collect(); // TODO: Add documents logic
        $comments = collect(); // TODO: Add comments logic  
        // Get messages using the basic table instead of the view
        $messages = \App\Data\ServiceJournal\Model\ServiceJournalMessage::with(['message', 'createdBy'])
            ->where('service_journal_id', $serviceJournalId)
            ->orderBy('create_date', 'asc')
            ->get();
        
        return view('Manager.Services.show')
            ->with('serviceJournalList', $serviceJournalList)
            ->with('serviceJournal',$serviceJournal)
            ->with('serviceJournalStepList',$serviceJournalStepList)
            ->with('taskExecutorList',$taskExecutorList)
            ->with('executorList',$executorList->pluck('full_name', 'id'))
            ->with('groupList',$groupList->pluck('name', 'id'))
            ->with('documents', $documents)
            ->with('comments', $comments)
            ->with('messages', $messages);

    }
    public function getTaskExecutorList()
    {
        $taskId = Input::get('taskId');
        $taskExecutorList=TaskExecutorDal::getListByTask($taskId);
        return view('Manager.Services._taskExecutorList')
            ->with('taskExecutorList', $taskExecutorList);
    }

    public function taskExecutorAdd(Request $request){
        $taskId = Input::get('task_id');
        $pickEdit=Input::get('pickEdit');
        if($pickEdit==1){
            $profileId = Input::get('profile_id');

            TaskDal::assignExecutor($taskId,$profileId);
        }
        else{
            $groupId = Input::get('group_id');
            TaskDal::assignExecutorGroup($taskId,$groupId);
        }

        return 1;
    }

    public function executorListPart(){
        $serviceJournalId=Input::get('serviceJournalId');
        $manager = ProfileDal::getByUserId(Auth::id());

        $serviceJournalList = ServiceJournalDal::getServiceJournalListByManager($manager->id, true);
        $serviceJournal = ServiceJournalDal::getExt($serviceJournalId);
        $serviceJournalStepList = ServiceJournalDal::getServiceJournalStepList($serviceJournalId);
        $taskExecutorList=TaskDal::getTaskExecutorsListByProject($serviceJournal->project_id);
        $manager = ProfileDal::getByUserId(Auth::id());
        $executorList = ProfileDal::getListByRolesAndManager([RoleList::Executor], $manager->id, true);
        $groupList = ExecutorGroupDal::getList(true);
        return view('Manager.Services._ExecutorList')
            ->with('serviceJournalList', $serviceJournalList)
            ->with('serviceJournal',$serviceJournal)
            ->with('serviceJournalStepList',$serviceJournalStepList)
            ->with('taskExecutorList',$taskExecutorList)
            ->with('executorList',$executorList->pluck('full_name', 'id'))
            ->with('groupList',$groupList->pluck('name', 'id'));
    }
    /**
     * @param $executorId
     */
    public function setHourlyRate()
    {
        $executorId = Input::get('executorId');
        $hourlyRate = Input::get('hourlyRate');
        TaskExecutorDal::setHourlyRate($executorId, $hourlyRate);

        return 1;
    }


    public function createGroup(){
        return view('Manager.Groups.create');
    }

    public function storeGroup(Request $request){
        Validator::make($request->all(), [
            'name' => 'required'
        ])->validate();

        $new = new ExecutorGroup();
        $new->name = Input::get('name');

        ExecutorGroupDal::set($new);

        $groupList = ExecutorGroupDal::getList(true);
        return view('Manager.Groups.index')
            ->with('groupList', $groupList);
    }

    public function editGroup($id){
        $executorGroup = ExecutorGroupDal::get($id);

        return view('Manager.Groups.edit')
            ->with('executorGroup', $executorGroup);
    }

    public function bodyEditGroup($id){
        $executorGroup = ExecutorGroupDal::get($id);
        $executorGroupBodyList=ExecutorGroupBodyDal::getListByExecutorGroupId($id);
        $manager = ProfileDal::getByUserId(Auth::id());
        $executorList = ProfileDal::getListByRolesAndManager([RoleList::Executor], $manager->id, true);
        return view('Manager.Groups.bodyEdit')
            ->with('executorGroup', $executorGroup)
            ->with('executorGroupBodyList', $executorGroupBodyList)
            ->with('executorList', $executorList->pluck('full_name', 'id'));
    }

    public function updateGroup(Request $request){
        Validator::make($request->all(), [
            'name' => 'required'
        ])->validate();

        $new = new ExecutorGroup();
        $new->id = Input::get('id');
        $new->name = Input::get('name');


        ExecutorGroupDal::set($new);
        $groupList = ExecutorGroupDal::getList(true);
        return view('Manager.Groups.index')
            ->with('groupList', $groupList);
    }

    public function bodyUpdateGroup(Request $request){
        Validator::make($request->all(), [
            'profile_id' => 'required'
        ])->validate();

        $new = new ExecutorGroup();
        $new->executor_group_id = Input::get('executor_group_id');
        $new->profile_id = Input::get('profile_id');

        ExecutorGroupBodyDal::assignProfileToExecutorGroup( $new->profile_id, $new->executor_group_id);

        $executorGroup = ExecutorGroupDal::get($new->executor_group_id);
        $executorGroupBodyList=ExecutorGroupBodyDal::getListByExecutorGroupId($new->executor_group_id);
        $manager = ProfileDal::getByUserId(Auth::id());
        $executorList = ProfileDal::getListByRolesAndManager([RoleList::Executor], $manager->id, true);
        return view('Manager.Groups.bodyEdit')
            ->with('executorGroup', $executorGroup)
            ->with('executorGroupBodyList', $executorGroupBodyList)
            ->with('executorList', $executorList->pluck('full_name', 'id'));
    }

    public function destroyGroup($id)
    {   ExecutorGroupBodyDal::deleteByExecutorGroup($id);
        ExecutorGroupDal::delete($id);
        $groupList = ExecutorGroupDal::getList(true);
        return view('Manager.Groups.index')
            ->with('groupList', $groupList);
    }

    public function bodyDestroyGroup($id)
    {
        $executorGroupBody=ExecutorGroupBodyDal::get($id);
        ExecutorGroupBodyDal::unassignProfileToExecutorGroup ($executorGroupBody->profile_id, $executorGroupBody->executor_group_id);

        $executorGroup = ExecutorGroupDal::get($executorGroupBody->executor_group_id);
        $executorGroupBodyList=ExecutorGroupBodyDal::getListByExecutorGroupId($executorGroupBody->executor_group_id);
        $manager = ProfileDal::getByUserId(Auth::id());
        $executorList = ProfileDal::getListByRolesAndManager([RoleList::Executor], $manager->id, true);
        return view('Manager.Groups.bodyEdit')
            ->with('executorGroup', $executorGroup)
            ->with('executorGroupBodyList', $executorGroupBodyList)
            ->with('executorList', $executorList->pluck('full_name', 'id'));
    }

    public function addExecutorToService($id){
        $serviceJournal = ServiceJournalDal::getExt($id);
        $executorServiceList=ServiceJournalDal::get;
        $manager = ProfileDal::getByUserId(Auth::id());
        $executorList = ProfileDal::getListByRolesAndManager([RoleList::Executor], $manager->id, true);
        return view('Manager.Groups.bodyEdit')
            ->with('serviceJournal', $serviceJournal)
            ->with('executorServiceList', $executorServiceList)
            ->with('executorList', $executorList->pluck('full_name', 'id'));
    }

    public function taskExecutorDestroy(){

        $taskId = Input::get('taskId');
        $id = Input::get('id');
        TaskDal::unassignExecutor($id);
        $taskExecutorList=TaskExecutorDal::getListByTask($taskId);
        return view('Manager.Services._taskExecutorList')
            ->with('taskExecutorList', $taskExecutorList);
    }

    public function startExecution($servicesJournalId)
    {
        ServiceJournalDal::startExecution($servicesJournalId);
        return back();
    }

    public function startReview()
    {
        $serviceJournalId = Input::get('serviceJournalId');
        $curatorId = Auth::user()->id;

        $project = ProjectDal::getByServiceJournal($serviceJournalId);

        ProjectReviewDal::startProjectReview($project->id, $curatorId);

        $entityData = new stdClass();
        $entityData->project = $project;
        return response()->json($entityData);
    }

    public function finishClientCheck()
    {
        $serviceJournalId = Input::get('serviceJournalId');
        $clientCheckResultTypeId = Input::get('clientCheckResultTypeId');

        $serviceJournalForReturn = null;

        if($clientCheckResultTypeId == ClientCheckResultTypeList::Success) {
            $prepaymentPercent = round(Input::get('prepaymentPercent') / 100, 2);
            ServiceJournalDal::setPrepaymentPercent(
                $serviceJournalId,
                $prepaymentPercent
            );
            $serviceJournalForReturn = ServiceJournalDal::setServiceJournalStatus($serviceJournalId, ServiceStatusList::Prepayment);
        } elseif ($clientCheckResultTypeId == ClientCheckResultTypeList::Reject) {
            $rejectReason = Input::get('rejectReason');
            $serviceJournalForReturn = ServiceJournalDal::setServiceJournalStatus(
                $serviceJournalId,
                ServiceStatusList::Rejected,
                $rejectReason
            );
        }

        return response()->json($serviceJournalForReturn);
    }

    public function sendBackToClient()
    {
        $serviceJournalId = Input::get('serviceJournalId');
        $serviceJournalForReturn = null;

        $rejectReason = Input::get('rejectReason');
        $serviceJournalForReturn = ServiceJournalDal::setServiceJournalStatus(
            $serviceJournalId,
            ServiceStatusList::DataCollection,
            $rejectReason
        );

        return response()->json($serviceJournalForReturn);
    }


    public function close($servicesJournalId)
    {
        $this->closeServiceJournal($servicesJournalId);

        return redirect(URL::previous());
    }


    public function reviewShow($projectId)
    {
        $project = ProjectDal::get($projectId);
        $taskList = TaskDal::getListByProject($projectId);

        foreach ($taskList as $task){
            $task->documentList = $task->taskDocumentList()->get();
            $projectExt = ProjectDal::getExt($task->project_id);
            $task->reviewCommentList = $task->taskReviewList()
                ->where('project_review_id', $projectExt->project_review_id)
                ->orderBy('create_date', 'desc')->get();
        }

        return view('Manager.Review.show')
            ->with('project', $project)
            ->with('taskList', $taskList);
    }

    public function reviewComments()
    {
        $taskId = Input::get('taskId');

        $task = TaskDal::get($taskId);
        $projectExt = ProjectDal::getExt($task->project_id);
        $task->reviewCommentList = $task->taskReviewList()
            ->where('project_review_id', $projectExt->project_review_id)
            ->orderBy('create_date', 'desc')->get();

        return view('Manager.Review._taskReviewCommentList', ['task' => $task]);
    }


    public function addComment()
    {
        $taskId = Input::get('taskId');
        $comment = Input::get('comment');

        ProjectReviewDal::setTaskReviewComment($taskId, $comment);

        return back();
    }

    public function setStatus(int $projectId, int $statusId)
    {
        ProjectReviewDal::setProjectReviewStatus($projectId, $statusId);

        if($statusId == ProjectReviewStatus::Success) {
            $projectExt = ProjectDal::getExt($projectId);
            $this->closeServiceJournal($projectExt->service_journal_id);
        }

        return redirect(route('manager.services.list'));
    }

    public function closeServiceJournal($servicesJournalId): void
    {
        $project = ProjectDal::getByServiceJournal($servicesJournalId);
        ProjectDal::setProjectStatus($project->id, ProjectStatus::Done);
        ServiceJournalDal::setServiceJournalStatus($servicesJournalId, ServiceStatusList::Payment);
    }




}
