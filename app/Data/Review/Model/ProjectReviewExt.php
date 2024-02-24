<?php

namespace App\Data\Review\Model;

use Illuminate\Database\Eloquent\Model;

class ProjectReviewExt extends Model
{
    protected $table = 'project_review_ext';
    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'project_description',
        'create_date',
        'created_by',
        'created_by_name',
        'project_review_status',
        'project_review_status_name',
        'assigned_to',
        'assigned_to_name'
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
