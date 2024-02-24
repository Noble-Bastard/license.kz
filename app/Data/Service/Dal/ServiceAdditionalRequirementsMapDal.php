<?php


namespace App\Data\Service\Dal;


use App\Data\Core\Dal\BaseDal;
use App\Data\Service\Model\LicenseType;
use App\Data\Service\Model\ServiceAdditionalRequirements;
use App\Data\Service\Model\ServiceAdditionalRequirementsMap;
use App\Data\Service\Model\ServiceStepResult;
use Illuminate\Support\Facades\DB;

class ServiceAdditionalRequirementsMapDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(ServiceAdditionalRequirementsMap::class);
    }

    public function getListByService($serviceId)
    {
        return $this->model::where('service_id', $serviceId)->with('serviceAdditionalRequirements.serviceAdditionalRequirementsType')->get();
    }

    public function deleteByServiceId(int $serviceId)
    {
        $this->model::where('service_id', $serviceId)
            ->delete();
    }
}