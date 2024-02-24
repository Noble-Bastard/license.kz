<?php

namespace App\Data\Service\Dal;

use App\Data\Core\Dal\BaseDal;
use App\Data\Service\Model\LicenseType;


class LicenseTypeDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(LicenseType::class);
    }

    public function init(LicenseType $licenseType) : LicenseType
    {
        $outLicenseType = $this->getByName($licenseType->name);
        if(is_null($outLicenseType)){
            $outLicenseType =  $this->set($licenseType);
        }
        return $outLicenseType;
    }

}
