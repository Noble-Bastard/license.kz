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
 * App\Data\Task\Model\TaskStatus
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskStatus whereName($value)
 * @mixin \Eloquent
 */
class TaskStatus extends Model
{
    protected $table = 'task_status';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
    protected $guarded = ['id'];
}