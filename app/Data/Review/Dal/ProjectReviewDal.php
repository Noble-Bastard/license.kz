<?php
/**
 * Created by PhpStorm.
 * User: R.Biewald
 * Date: 31.05.2018
 * Time: 17:01
 */

namespace App\Data\Review\Dal;


use App\Data\Helper\Assistant;
use App\Data\Helper\ProjectReviewStatus;
use App\Data\Helper\ProjectStatus;
use App\Data\Helper\TaskStatus;
use App\Data\Project\Dal\ProjectDal;
use App\Data\Project\Model\ProjectExt;
use App\Data\Review\Model\ProjectReview;
use App\Data\Review\Model\TaskReview;
use App\Data\Task\Dal\TaskDal;
use Barryvdh\Reflection\DocBlock\Type\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectReviewDal
{


    /**
     * Get ProjectReview bi Id
     * @param $projectReviewId
     * @return ProjectReview
     */
    public static function get($projectReviewId)
    {
        return ProjectReview::where('id',$projectReviewId)->firstOrFail();
    }

    /**
     * Return project for review by current user
     *
     * @return Collection|ProjectExt
     */
    public static function getProjectReviewListByCurrentUser()
    {
        $projectList = ProjectExt::where('project_review_assigned_to', Auth::id())
            ->where('project_review_status',ProjectReviewStatus::Undefined)
            ->get();
        return $projectList;
    }

    /**
     * Start project review
     *
     * @param int $projectId
     * @param int $assignedTo
     * @return ProjectReview
     * @throws \Exception
     */
    public static function startProjectReview($projectId, $assignedTo)
    {
        try {


            DB::beginTransaction();

            //change project status to InReview
            ProjectDal::setProjectStatus($projectId, ProjectStatus::Review);

            //insert data into ProjectReview
            $projectReview = new ProjectReview();
            $projectReview->created_by = Auth::id();
            $projectReview->create_date = Assistant::getCurrentDate();
            $projectReview->project_id = $projectId;
            $projectReview->assigned_to = $assignedTo;
            $projectReview->project_review_status = ProjectReviewStatus::Undefined;
            $projectReview->save();

            DB::commit();

            return $projectReview;

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }


    /**
     * Set status of project review
     *
     * @param int $projectId
     * @param int $projectReviewStatus
     * @throws \Exception
     */
    public static function setProjectReviewStatus($projectId, $projectReviewStatus)
    {
        try {

            $projectExt = ProjectDal::getExt($projectId);
            $projectReview = self::get($projectExt->project_review_id);

            DB::beginTransaction();

            if($projectReviewStatus == ProjectReviewStatus::Success)
            {
                //Change project status to done
                ProjectDal::setProjectStatus($projectId, ProjectStatus::Done);

                //change ProjectReview status to success
                $projectReview->project_review_status = ProjectReviewStatus::Success;
                $projectReview->save();

            } else if ($projectReviewStatus == ProjectReviewStatus::Fail){

                //Change project status to InWork
                ProjectDal::setProjectStatus($projectId, ProjectStatus::InWork);

                //change ProjectReview status to fail
                $projectReview->project_review_status = ProjectReviewStatus::Fail;
                $projectReview->save();

                //by all commented task set task status to InWork
                /* @var $taskReview TaskReview */
                $taskReviewList = TaskReview::where('project_review_id', $projectReview->id)
                    ->get();
                foreach ($taskReviewList as  $taskReview)
                {
                    TaskDal::setTaskStatus($taskReview->task_id, TaskStatus::InWork);
                }
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
     * Set task review comment
     *
     * @param int $taskId
     * @param string $comment
     * @return TaskReview
     * @throws \Exception
     */
    public static function setTaskReviewComment($taskId, $comment)
    {
        try {

            $task = TaskDal::get($taskId);
            $projectExt = ProjectDal::getExt($task->project_id);

            DB::beginTransaction();

            //insert data into TaskReview table
            $taskReview = new TaskReview();
            if($projectExt->project_review_id != null) {
                $taskReview->create_date = Assistant::getCurrentDate();
                $taskReview->created_by = Auth::id();
                $taskReview->comment = $comment;
                $taskReview->task_id = $taskId;
                $taskReview->project_review_id = $projectExt->project_review_id;
                $taskReview->save();
            }
            DB::commit();

            return $taskReview;

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

}
