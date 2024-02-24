<?php

namespace App\Data\FreeEconomicZone\Model;

use App\Data\Core\Model\BaseTableModel;

class FreeEconomicZoneActivity extends BaseTableModel
{
    public function __construct()
    {
        parent::__construct(
            'free_economic_zone_activity',
            false
        );
    }

    public function businessActivityType()
    {
        return $this->hasOne('App\Data\FreeEconomicZone\Model\BusinessActivityType','id','business_activity_type_id');
    }

    public function freeEconomicZone()
    {
        return $this->hasOne('App\Data\FreeEconomicZone\Model\FreeEconomicZone','id','free_economic_zone_id');
    }
}
