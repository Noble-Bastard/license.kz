<?php

namespace App\Data\Service\Model;

use Illuminate\Database\Eloquent\Model;

class AdditionalApprovalsMap extends Model
{
    protected $table = 'additional_approvals_map';
    public $timestamps = false;

    protected $fillable = [
        'additional_approvals_id',
        'service_id',
    ];
    protected $guarded = ['id'];

    public function additionalApprovals()
    {
        return $this->hasOne(AdditionalApprovals::class, 'id', 'additional_approvals_id');
    }
}