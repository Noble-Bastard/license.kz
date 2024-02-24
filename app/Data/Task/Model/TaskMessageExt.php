<?php

namespace App\Data\Task\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Task\Model\TaskMessageExt
 *
 * @property int $id
 * @property int $task_id
 * @property int $message_id
 * @property string|null $message_caption
 * @property string|null $message_create_date
 * @property \App\Data\Notify\Model\Messages $message
 * @property string $create_date
 * @property int $created_by
 * @property string|null $created_by_full_name
 * @property int|null $created_by_role_id
 * @property string|null $created_by_role_name
 * @property-read \App\User $createdBy
 * @property-read \App\Data\Task\Model\Task $task
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessageExt whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessageExt whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessageExt whereCreatedByFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessageExt whereCreatedByRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessageExt whereCreatedByRoleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessageExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessageExt whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessageExt whereMessageCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessageExt whereMessageCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessageExt whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskMessageExt whereTaskId($value)
 * @mixin \Eloquent
 */
class TaskMessageExt extends Model
{
    protected $table = 'task_message_ext';
    public $timestamps = false;

    protected $fillable = [
        'task_id',
        'message_id',
        'message_caption',
        'message_create_date',
        'message',
        'create_date',
        'created_by',
        'created_by_full_name',
        'created_by_role_id',
        'created_by_role_name'
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
