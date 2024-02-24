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
 * App\Data\Task\Model\TaskRelevance
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskRelevance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskRelevance whereName($value)
 * @mixin \Eloquent
 */
class TaskRelevance extends Model
{
    protected $table = 'task_relevance';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
    protected $guarded = ['id'];
}