<?php

namespace App\Data\Task\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Task\Model\ExecutorGroupBodyExt
 *
 * @property int $id
 * @property int $executor_group_id
 * @property string executor_group_name
 * @property int $profile_id
 * @property string profile_full_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\ExecutorGroupBody whereExecutorGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\ExecutorGroupBody whereProfileId($value)
 * @mixin \Eloquent
 */
class ExecutorGroupBodyExt extends Model
{
    protected $table = 'executor_group_body_ext';
    public $timestamps = false;

    protected $fillable = [
        'executor_group_id',
        'profile_id',
        'executor_group_name',
        'profile_full_name'
    ];
    protected $guarded = ['id'];
}
