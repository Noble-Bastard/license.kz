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
 * Class TaskHistExt
 *
 * @package App\Data\Task\Model
 * @property-read int id
 * @property-read int task_id
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
 * @property-read int modify_by
 * @property-read string modify_by_name
 * @property-read \Datetime modify_date
 * @property string|null $created_by_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereActualExecutionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereCreatedByName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereExecutionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereManagerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereManagerFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereModifyBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereModifyDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereProjectCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereProjectDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereProjectServiceJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereServiceJournalStepId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereTaskRelevanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereTaskRelevanceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereTaskStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskHistExt whereTaskStatusName($value)
 * @mixin \Eloquent
 */


class TaskHistExt extends Model
{
    protected $table = 'task_hist_ext';
    public $timestamps = false;

    protected $fillable = [
        'task_id',
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
        'modify_by',
        'modify_by_name',
        'modify_date'
    ];
    protected $guarded = ['id'];
}