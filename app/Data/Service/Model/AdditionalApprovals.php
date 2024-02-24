<?php

namespace App\Data\Service\Model;

use Illuminate\Database\Eloquent\Model;

class AdditionalApprovals extends Model
{
    protected $table = 'additional_approvals';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
    protected $guarded = ['id'];
}