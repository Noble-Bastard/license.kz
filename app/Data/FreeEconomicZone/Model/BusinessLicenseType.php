<?php

namespace App\Data\FreeEconomicZone\Model;

use App\Data\Core\Model\BaseTableModel;

class BusinessLicenseType extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'business_license_type',
            false
        );
    }

}
