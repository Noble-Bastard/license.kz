<?php

namespace App\Data\Service\Dal;

use App\Data\Core\Dal\BaseDal;
use App\Data\Service\Model\LicenseType;
use App\Data\Service\Model\ServiceType;


class ServiceTypeDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(ServiceType::class);
    }

    public function init(ServiceType $serviceType) : ServiceType
    {
        $outServiceType = $this->getByName($serviceType->name);
        if(is_null($outServiceType)){
            $outServiceType =  $this->set($serviceType);
        }
        return $outServiceType;
    }

}
