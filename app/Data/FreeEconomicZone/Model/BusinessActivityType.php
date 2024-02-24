<?php

namespace App\Data\FreeEconomicZone\Model;

use App\Data\Core\Model\BaseTableModel;

class BusinessActivityType extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'business_activity_type',
            false
        );
    }

}
