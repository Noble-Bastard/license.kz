<?php

namespace App\Data\Review\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * Class ProjectReviewStatus
 *
 * @package App\Data\Review\Model
 * @property int $project_id
 * @property string $name
 * @mixin \Eloquent
 */

class ProjectReviewStatus extends Model
{
    protected $table = 'project_review_status';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = ['id'];

}
