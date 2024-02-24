<?php

namespace App\Data\Service\Dal;

use App\Data\Service\Model\ServiceStepCostHist;

class ServiceStepCostHistDal
{
    
    public static function getByServiceStep($serviceStepId)
    {
        $entityList = ServiceStepCostHist::where('service_step_id', $serviceStepId)->get();
        return $entityList;
    }

    public static function get($entityId)
    {
        $entity = ServiceStepCostHist::where('id', $entityId)->firstOrFail();
        return $entity;
    }

    public static function set (ServiceStepCostHist $srcEntity)
    {
        $srcEntity->save();
        return $srcEntity;
    }


    public static function delete($entityId)
    {
        ServiceStepCostHist::where('id', $entityId)->delete();
        return true;
    }

    public static function deleteByServiceStep($serviceStepId)
    {
        ServiceStepCostHist::where('service_step_id', $serviceStepId)->delete();
        return true;
    }
}
