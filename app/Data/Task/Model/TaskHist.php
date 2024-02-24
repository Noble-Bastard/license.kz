<?php
/**
 * Created by PhpStorm.
 * User: r.biewald
 * Date: 14.05.2018
 * Time: 15:49
 */

namespace App\Data\Task\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskHist
 *
 * @package App\Data\Task\Model
 * @property int id
 * @property int task_id
 * @property int project_id
 * @property int task_relevance_id
 * @property int service_journal_step_id
 * @property int task_status_id
 * @property \DateTime execution_time
 * @property string description
 * @property string result
 * @property int actual_execution_time
 * @property int execution_time_plan
 * @property int execution_time_fact
 * @property int modify_by
 * @property \DateTime modify_date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereActualExecutionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereExecutionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereExecutionTimeFact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereExecutionTimePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereModifyBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereModifyDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereServiceJournalStepId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereTaskRelevanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHist whereTaskStatusId($value)
 * @mixin \Eloquent
 */
class TaskHist extends Model
{
    protected $table = 'task_hist';
    public $timestamps = false;

    protected $fillable = [
        'task_id',
        'project_id',
        'task_relevance_id',
        'service_journal_step_id',
        'task_status_id',
        'execution_time',
        'description',
        'result',
        'actual_execution_time',
        'execution_time_plan',
        'execution_time_fact',
        'modify_by',
        'modify_date'
    ];
    protected $guarded = ['id'];
}