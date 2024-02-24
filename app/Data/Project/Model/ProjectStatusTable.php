<?php

namespace App\Data\Project\Model;

use Illuminate\Database\Eloquent\Model;

class ProjectStatusTable extends Model
{
    protected $table = 'project_status';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
    protected $guarded = ['id'];
}
