<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;

class CommercialOffer extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'commercial_offer',
            true
        );
    }

    public function serviceList()
    {
        return $this->hasMany(CommercialOfferService::class, 'commercial_offer_id', 'id');
    }

    public function type()
    {
        return $this->hasOne(CommercialOfferType::class, 'id', 'commercial_offer_type_id');
    }
}