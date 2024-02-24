<?php

namespace App\Data\Project\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectExt
 *
 * @package App\Data\Project\Model
 * @property int $id
 * @property int $service_journal_id
 * @property int $manager_id
 * @property string $description
 * @property \DateTime $create_date
 * @property int $created_by
 * @property int $project_status_id
 * @property int project_review_id
 * @property int project_review_status
 * @property string project_review_status_name
 * @property int task_review_comment_cnt
 * @property int project_review_assigned_to
 * @mixin \Eloquent
 */

class ProjectExt extends Model
{
    protected $table = 'project_ext';
    public $timestamps = false;

    protected $fillable = [
        'service_journal_id',
        'manager_id',
        'manager_full_name',
        'description',
        'create_date',
        'created_by',
        'project_status_id',
        'project_status_name',
        'project_review_id',
        'project_review_status',
        'project_review_status_name',
        'task_review_comment_cnt',
        'project_review_assigned_to'
    ];

    protected $guarded = ['id'];
}
