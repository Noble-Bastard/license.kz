<?php

namespace App\Http\Controllers\Curator;

use App\Data\Core\Dal\ProfileDal;
use App\Data\Project\Dal\ProjectDal;
use App\Data\Review\Dal\ProjectReviewDal;
use App\Data\Task\Dal\TaskDal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CuratorController extends Controller
{
    public function reviewList(){
        $projectReviewList = ProjectReviewDal::getProjectReviewListByCurrentUser();

        return view('Curator.Review.index')
            ->with('projectReviewList', $projectReviewList);
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

        return view('Curator.Review.show')
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

        return view('Curator.Review._taskReviewCommentList', ['task' => $task]);
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

        return redirect(route('curator.review.list'));
    }
}
