<?php

namespace App\Data\Task\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Task\Model\TaskMessage
 *
 * @property int $id
 * @property int $task_id
 * @property int $message_id
 * @property string $create_date
 * @property int $created_by
 * @property-read \App\User $createdBy
 * @property-read \App\Data\Notify\Model\Messages $message
 * @property-read \App\Data\Task\Model\Task $task
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessage whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessage whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessage whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessage whereTaskId($value)
 * @mixin \Eloquent
 */
class TaskMessage extends Model
{
    protected $table = 'task_message';
    public $timestamps = false;

    protected $fillable = [
        'task_id',
        'message_id',
        'create_date',
        'created_by'
    ];
    protected $guarded = ['id'];

    public function task()
    {
        return $this->hasOne('App\Data\Task\Model\Task','id','task_id');
    }

    public function message()
    {
        return $this->hasOne('App\Data\Notify\Model\Messages','id','message_id');
    }

    public function createdBy()
    {
        return $this->hasOne('App\User','id', 'created_by');
    }
}
