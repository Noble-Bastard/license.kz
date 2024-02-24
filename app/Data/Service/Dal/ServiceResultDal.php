<?php

namespace App\Data\Service\Dal;

use App\Data\Core\Dal\BaseDal;
use App\Data\Service\Model\ServiceResult;


class ServiceResultDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(ServiceResult::class);
    }

}
