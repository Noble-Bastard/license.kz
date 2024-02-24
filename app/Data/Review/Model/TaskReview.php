<?php

namespace App\Data\Review\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskReview
 *
 * @package App\Data\Review\Model
 * @property int $project_review_id
 * @property int $task_id
 * @property \DateTime $create_date
 * @property int $created_by
 * @property string $comment
 * @mixin \Eloquent
 */

class TaskReview extends Model
{
    protected $table = 'task_review';
    public $timestamps = false;

    protected $fillable = [
        'project_review_id',
        'create_date',
        'created_by',
        'task_id',
        'comment'
    ];

    protected $guarded = ['id'];

    public function projectReview()
    {
        return $this->hasOne('App\Data\Review\Model\ProjectReview','id', 'project_review_id');
    }

    public function task()
    {
        return $this->hasOne('App\Data\Task\Model\TaskExt','id', 'task_id');
    }

    public function createdBy()
    {
        return $this->hasOne('App\User','id', 'created_by');
    }

}
