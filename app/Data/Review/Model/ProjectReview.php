<?php

namespace App\Data\Review\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * Class ProjectReview
 *
 * @package App\Data\Review\Model
 * @property int $project_id
 * @property int $project_review_status
 * @property int $assigned_to
 * @property \DateTime $create_date
 * @property int $created_by
 * @property int project_status_id
 * @mixin \Eloquent
 */

class ProjectReview extends Model
{
    protected $table = 'project_review';
    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'create_date',
        'created_by',
        'project_review_status',
        'assigned_to'
    ];

    protected $guarded = ['id'];

    public function project()
    {
        return $this->hasOne('App\Data\Project\Model\Project','id', 'project_id');
    }

    public function projectReviewStatus()
    {
        return $this->hasOne('App\Data\Review\Model\ProjectReviewStatus','id', 'project_review_status');
    }

    public function createdBy()
    {
        return $this->hasOne('App\User','id', 'created_by');
    }

    public function assignedTo()
    {
        return $this->hasOne('App\User','id', 'assigned_to');
    }
}
