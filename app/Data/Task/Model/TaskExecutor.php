<?php
/**
 * Created by PhpStorm.
 * User: r.biewald
 * Date: 14.05.2018
 * Time: 15:43
 */

namespace App\Data\Task\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Task\Model\TaskExecutor
 *
 * @property int $id
 * @property int $task_id
 * @property int $executor_id
 * @property string $assign_date
 * @property-read \App\Data\Core\Model\Profile $executor
 * @property-read \App\Data\Task\Model\Task $task
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExecutor whereAssignDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExecutor whereExecutorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExecutor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskExecutor whereTaskId($value)
 * @mixin \Eloquent
 */
class TaskExecutor extends Model
{
    protected $table = 'task_executor';
    public $timestamps = false;

    protected $fillable = [
        'task_id',
        'executor_id',
        'assign_date'
    ];
    protected $guarded = ['id'];

    public function task()
    {
        return $this->hasOne('App\Data\Task\Model\Task','id','task_id');
    }

    public function executor()
    {
        return $this->hasOne('App\Data\Core\Model\Profile','id','executor_id');
    }
}