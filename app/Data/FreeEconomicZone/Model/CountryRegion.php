<?php

namespace App\Data\FreeEconomicZone\Model;

use App\Data\Core\Model\BaseTableModel;

class CountryRegion extends BaseTableModel
{
    public function __construct()
    {
        parent::__construct(
            'country_region',
            false
        );
    }

    public function country()
    {
        return $this->hasOne('App\Data\Service\Model\Country','id','country_id');
    }
}
