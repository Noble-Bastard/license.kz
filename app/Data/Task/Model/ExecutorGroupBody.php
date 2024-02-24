<?php

namespace App\Data\Task\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Task\Model\ExecutorGroupBody
 *
 * @property int $id
 * @property int $executor_group_id
 * @property int $profile_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\ExecutorGroupBody whereExecutorGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\ExecutorGroupBody whereProfileId($value)
 * @mixin \Eloquent
 */
class ExecutorGroupBody extends Model
{
    protected $table = 'executor_group_body';
    public $timestamps = false;

    protected $fillable = [
        'executor_group_id',
        'profile_id'
    ];
    protected $guarded = ['id'];
}
