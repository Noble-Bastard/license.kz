<?php

namespace App\Http\Controllers\Admin\Service;

use App\Data\Service\Dal\ServiceRequiredDocumentDal;
use App\Data\Service\Dal\ServiceStepRequiredDocumentDal;
use App\Http\Controllers\BaseController;

class ServiceStepRequiredDocumentController  extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            ServiceStepRequiredDocumentDal::class,
            ""
        );
    }

    public function getListByServiceStepAndService($serviceStepId, $serviceId)
    {
        $entityList = (new ServiceStepRequiredDocumentDal())->getByServiceStepAndService($serviceStepId, $serviceId);
        $data = new \stdClass();
        $data->entityList = $entityList;
        $data->serviceRequiredDocumentList = (new ServiceRequiredDocumentDal())->getList(
            false,
            "document"
        );
        return response()->json($data);
    }
}
