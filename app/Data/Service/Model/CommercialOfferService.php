<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;

class CommercialOfferService extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'commercial_offer_service',
            false
        );
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
