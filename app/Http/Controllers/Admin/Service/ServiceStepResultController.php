<?php

namespace App\Http\Controllers\Admin\Service;

use App\Data\Core\Dal\CounterDal;
use App\Data\Core\Dal\CounterTypeDal;
use App\Data\Core\Model\CounterType;
use App\Data\Helper\Assistant;
use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Dal\CurrencyDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\Service\Dal\ServiceRequiredDocumentDal;
use App\Data\Service\Dal\ServiceResultDal;
use App\Data\Service\Dal\ServiceStepCostHistDal;
use App\Data\Service\Dal\ServiceStepDal;
use App\Data\Service\Dal\ServiceStepRequiredDocumentDal;
use App\Data\Service\Dal\ServiceStepResultDal;
use App\Data\Service\Dal\ServiceThematicGroupDal;
use App\Data\Service\Model\Service;
use App\Data\Service\Model\ServiceStep;
use App\Data\Service\Model\ServiceStepCostHist;
use App\Data\Service\Model\ServiceStepResult;
use App\Data\Translation\Dal\TranslationDal;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ServiceStepResultController  extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            ServiceStepResultDal::class,
            ""
        );
    }

    public function getListByServiceStepAndService($serviceStepId, $serviceId)
    {
        $entityList = (new ServiceStepResultDal())->getByServiceStepAndService($serviceStepId, $serviceId);
        $data = new \stdClass();
        $data->entityList = $entityList;
        $data->serviceResultList = (new ServiceResultDal())->getList();
        return response()->json($data);
    }
}
