<?php

namespace App\Http\Controllers\Admin\Dictionary;
use App\Data\Service\Dal\LicenseTypeDal;
use App\Http\Controllers\BaseController;

class LicenseTypeController extends BaseController
{

    public function __construct()
    {
        parent::__construct(
            LicenseTypeDal::class,
            'admin.dictionary.licenseType.index'
        );
    }

}
