<?php

namespace App\Data\FreeEconomicZone\Model;

use App\Data\Core\Model\BaseTableModel;

class FreeEconomicZone extends BaseTableModel
{
    public function __construct()
    {
        parent::__construct(
            'free_economic_zone',
            false
        );
    }

    public function countryRegion()
    {
        return $this->hasOne('App\Data\FreeEconomicZone\Model\CountryRegion','id','country_region_id');
    }

    public function businessActivityTypes(){
        return $this->hasMany('App\Data\FreeEconomicZone\Model\BusinessActivityType', 'free_economic_zone_id', 'id');
    }

    public function businessLicenseTypes(){
        return $this->hasMany('App\Data\FreeEconomicZone\Model\BusinessLicenseType', 'free_economic_zone_id', 'id');
    }

    public function serviceCategory()    {
        return $this->hasOne('App\Data\Service\Model\ServiceCategory','id','service_category_id');
    }
}
