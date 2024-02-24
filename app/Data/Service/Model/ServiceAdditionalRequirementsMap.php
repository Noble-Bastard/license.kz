<?php


namespace App\Data\Service\Model;


use App\Data\Core\Model\BaseTableModel;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceAdditionalRequirementsMap extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'service_additional_requirements_map',
            false
        );
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function serviceAdditionalRequirements()
    {
        return $this->belongsTo(ServiceAdditionalRequirements::class);
    }
}