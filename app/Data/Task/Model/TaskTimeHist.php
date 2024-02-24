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
 * App\Data\Task\Model\TaskTimeHist
 *
 * @property int $id
 * @property int $task_id
 * @property string $start_date
 * @property string|null $end_date
 * @property int $is_complete
 * @property-read \App\Data\Task\Model\Task $task
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskTimeHist whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskTimeHist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskTimeHist whereIsComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskTimeHist whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskTimeHist whereTaskId($value)
 * @mixin \Eloquent
 */
class TaskTimeHist extends Model
{
    protected $table = 'task_time_hist';
    public $timestamps = false;

    protected $fillable = [
        'task_id',
        'start_date',
        'end_date',
        'is_complete',
    ];
    protected $guarded = ['id'];

    public function task()
    {
        return $this->hasOne('App\Data\Task\Model\Task','id','task_id');
    }
}