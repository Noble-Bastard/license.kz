<?php

namespace App\Http\Controllers\Admin\Dictionary;
use App\Data\Service\Dal\ServiceRequiredDocumentDal;
use App\Http\Controllers\BaseController;

class ServiceRequiredDocumentController extends BaseController
{

    public function __construct()
    {
        parent::__construct(
            ServiceRequiredDocumentDal::class,
            'admin.dictionary.serviceRequiredDocument.index'
        );
    }

}
