<?php

namespace App\Data\Service\Dal;

use App\Data\Core\Dal\BaseDal;
use App\Data\Service\Model\ServiceStepResult;

class ServiceStepResultDal extends BaseDal
{
    protected $rules = [
        'service_step_id' => 'required|numeric',
        'service_result_id' => 'required|numeric',
    ];

    public function __construct()
    {
        parent::__construct(ServiceStepResult::class);
    }
    public function getByServiceStep($serviceStepId, bool $translateData = false)
    {
        $entityList = ServiceStepResult::where('service_step_id', $serviceStepId)
            ->with('serviceResult');

        return $entityList->get();
    }

    public function getByServiceStepAndService($serviceStepId, $serviceId, bool $translateData = false)
    {
        $entityList = ServiceStepResult::where('service_step_id', $serviceStepId)
            ->where('service_id', $serviceId)
            ->with('serviceResult');

        return $entityList->get();
    }

    public function getByService($serviceId)
    {
        $entityList = ServiceStepResult::where('service_id', $serviceId)
            ->with('serviceResult');

        return $entityList->get();
    }

    public function deleteByServiceStepAndService($serviceStepId, $serviceId)
    {
        ServiceStepResult::where('service_step_id', $serviceStepId)
            ->where('service_id', $serviceId)
            ->delete();

        return true;
    }


    public function getListByServiceArray($serviceArray, bool $translateData = false)
    {
        $entityList = ServiceStepResult::whereIn('service_id', $serviceArray)
            ->select('service_step_id', 'service_result_id')
            ->groupBy('service_step_id', 'service_result_id')
            ->with('serviceResult');

        return $entityList->get();
    }

    public function deleteByServiceId(int $serviceId)
    {
        ServiceStepResult::where('service_id', $serviceId)
            ->delete();
    }
}
