<?php
/**
 * Created by PhpStorm.
 * User: r.biewald
 * Date: 14.05.2018
 * Time: 15:31
 */

namespace App\Data\Task\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskExt
 *
 * @package App\Data\Task\Model
 * @property-read int id
 * @property-read int project_id
 * @property-read string project_description
 * @property-read int project_service_journal_id
 * @property-read \Datetime project_create_date
 * @property-read int manager_id
 * @property-read string manager_full_name
 * @property-read string manager_email
 * @property-read int task_relevance_id
 * @property-read string task_relevance_name
 * @property-read int service_journal_step_id
 * @property-read int task_status_id
 * @property-read string task_status_name
 * @property-read \Datetime execution_time
 * @property-read string description
 * @property-read string result
 * @property-read int actual_execution_time
 * @property-read int execution_time_plan
 * @property-read int execution_time_fact
 * @property-read int created_by
 * @property-read string created_by_name
 * @property-read \App\User $createdBy
 * @property-read \App\Data\Core\Model\Profile $manager
 * @property-read \App\Data\Project\Model\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Data\Task\Model\TaskDocumentExt[] $taskDocumentList
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Data\Task\Model\TaskExecutorExt[] $taskExecutorList
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Data\Task\Model\TaskHistExt[] $taskHistList
 * @property-read \App\Data\Task\Model\TaskRelevance $taskRelevance
 * @property-read \App\Data\Task\Model\TaskStatus $taskStatus
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Data\Task\Model\TaskTimeHist[] $taskTimeHistList
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereActualExecutionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereCreatedByName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereExecutionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereExecutionTimeFact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereExecutionTimePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereManagerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereManagerFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereProjectCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereProjectDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereProjectServiceJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereServiceJournalStepId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereTaskRelevanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereTaskRelevanceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereTaskStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExt whereTaskStatusName($value)
 * @mixin \Eloquent
 */


class TaskExt extends Model
{
    protected $table = 'task_ext';
    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'project_description',
        'project_service_journal_id',
        'project_create_date',
        'manager_id',
        'manager_full_name',
        'manager_email',
        'task_relevance_id',
        'task_relevance_name',
        'service_journal_step_id',
        'task_status_id',
        'task_status_name',
        'execution_time',
        'description',
        'result',
        'actual_execution_time',
        'execution_time_plan',
        'execution_time_fact',
        'created_by',
        'created_by_name'
    ];
    protected $guarded = ['id'];

    public function project()
    {
        return $this->hasOne('App\Data\Project\Model\Project','id','project_id');
    }

    public function manager()
    {
        return $this->hasOne('App\Data\Core\Model\Profile','id','manager_id');
    }

    public function taskRelevance(){
        return $this->hasOne('App\Data\Task\Model\TaskRelevance', 'id', 'task_relevance_id');
    }

    public function taskStatus(){
        return $this->hasOne('App\Data\Task\Model\TaskStatus', 'id', 'task_status_id');
    }

    public function createdBy(){
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function taskHistList(){
        return $this->hasMany('App\Data\Task\Model\TaskHistExt', 'task_id', 'id');
    }

    public function taskTimeHistList(){
        return $this->hasMany('App\Data\Task\Model\TaskTimeHist', 'task_id', 'id');
    }

    public function taskExecutorList(){
        return $this->hasMany('App\Data\Task\Model\TaskExecutorExt', 'task_id', 'id');
    }

    public function taskDocumentList(){
        return $this->hasMany('App\Data\Task\Model\TaskDocumentExt', 'task_id', 'id');
    }

    public function taskReviewList(){
        return $this->hasMany('App\Data\Review\Model\TaskReview', 'task_id', 'id');
    }
}