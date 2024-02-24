<?php


namespace App\Http\Controllers\Admin\Dictionary;

use App\Data\Service\Dal\ServiceAdditionalRequirementsTypeDal;
use App\Http\Controllers\BaseController;

class ServiceAdditionalRequirementsTypeController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            ServiceAdditionalRequirementsTypeDal::class,
            'admin.dictionary.ServiceAdditionalRequirementsType.index'
        );
    }
}