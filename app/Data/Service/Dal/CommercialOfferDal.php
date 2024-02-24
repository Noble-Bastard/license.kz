<?php

namespace App\Data\Service\Dal;

use App\Data\Core\Dal\BaseDal;
use App\Data\Service\Model\CommercialOffer;

class CommercialOfferDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(CommercialOffer::class);
    }
}
