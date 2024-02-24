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
 * Class Task
 *
 * @package App\Data\Task\Model
 * @property int id
 * @property int project_id
 * @property int task_relevance_id
 * @property int service_journal_step_id
 * @property int task_status_id
 * @property \DateTime execution_time
 * @property string description
 * @property string result
 * @property int actual_execution_time
 * @property int created_by
 * @property int execution_time_plan
 * @property int execution_time_fact
 * @property-read \App\User $createdBy
 * @property-read \App\Data\Core\Model\Profile $manager
 * @property-read \App\Data\Project\Model\Project $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Data\Task\Model\TaskDocumentExt[] $taskDocumentList
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Data\Task\Model\TaskExecutorExt[] $taskExecutorList
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Data\Task\Model\TaskHistExt[] $taskHistList
 * @property-read \App\Data\Task\Model\TaskRelevance $taskRelevance
 * @property-read \App\Data\Task\Model\TaskStatus $taskStatus
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Data\Task\Model\TaskTimeHist[] $taskTimeHistList
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\Task whereActualExecutionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\Task whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\Task whereExecutionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\Task whereExecutionTimeFact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\Task whereExecutionTimePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\Task whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\Task whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\Task whereServiceJournalStepId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\Task whereTaskRelevanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\Task whereTaskStatusId($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    protected $table = 'task';
    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'task_relevance_id',
        'service_journal_step_id',
        'task_status_id',
        'execution_time',
        'description',
        'result',
        'actual_execution_time',
        'created_by',
        'execution_time_plan',
        'execution_time_fact'
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
}