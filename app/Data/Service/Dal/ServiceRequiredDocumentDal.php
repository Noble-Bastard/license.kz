<?php

namespace App\Data\Service\Dal;

use App\Data\Core\Dal\BaseDal;
use App\Data\Service\Model\ServiceRequiredDocument;


class ServiceRequiredDocumentDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(ServiceRequiredDocument::class);
    }

}
