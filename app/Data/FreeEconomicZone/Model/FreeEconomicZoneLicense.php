<?php

namespace App\Data\FreeEconomicZone\Model;

use App\Data\Core\Model\BaseTableModel;

class FreeEconomicZoneLicense extends BaseTableModel
{
    public function __construct()
    {
        parent::__construct(
            'free_economic_zone_license',
            false
        );
    }

    public function businessLicenseType()
    {
        return $this->hasOne('App\Data\FreeEconomicZone\Model\BusinessLicenseType','id','business_license_type_id');
    }

    public function freeEconomicZone()
    {
        return $this->hasOne('App\Data\FreeEconomicZone\Model\FreeEconomicZone','id','free_economic_zone_id');
    }
}
