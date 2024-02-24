<?php

namespace App\Data\Task\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Task\Model\ExecutorGroup
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\ExecutorGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\ExecutorGroup whereName($value)
 * @mixin \Eloquent
 */
class ExecutorGroup extends Model
{
    protected $table = 'executor_group';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
    protected $guarded = ['id'];
}
