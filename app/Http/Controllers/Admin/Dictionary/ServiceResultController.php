<?php

namespace App\Http\Controllers\Admin\Dictionary;

use App\Data\Service\Dal\ServiceResultDal;
use App\Http\Controllers\BaseController;

class ServiceResultController extends BaseController
{

    public function __construct()
    {
        parent::__construct(
            ServiceResultDal::class,
            'admin.dictionary.serviceResult.index'
        );
    }

}
