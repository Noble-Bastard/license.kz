<?php


namespace App\Data\Service\Model;


use App\Data\Core\Model\BaseTableModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceAdditionalRequirements extends BaseTableModel
{
    use SoftDeletes;
    
    public function __construct()
    {
        parent::__construct(
            'service_additional_requirements',
            false
        );
    }

    public function licenseType()
    {
        return $this->belongsTo(LicenseType::class);
    }

    public function serviceAdditionalRequirementsType()
    {
        return $this->belongsTo(ServiceAdditionalRequirementsType::class);
    }

}