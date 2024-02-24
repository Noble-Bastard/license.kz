<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;

class CommercialOfferType extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'commercial_offer_type',
            true
        );
    }
}
