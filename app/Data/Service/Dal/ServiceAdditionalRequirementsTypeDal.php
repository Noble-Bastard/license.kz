<?php


namespace App\Data\Service\Dal;


use App\Data\Core\Dal\BaseDal;
use App\Data\Service\Model\LicenseType;
use App\Data\Service\Model\ServiceAdditionalRequirementsType;

class ServiceAdditionalRequirementsTypeDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(ServiceAdditionalRequirementsType::class);
    }

}