<?php

namespace App\Http\Controllers\Admin\Service;
use App\Data\Service\Dal\CurrencyDal;
use App\Data\Service\Dal\ServiceStepCostHistDal;
use App\Data\Service\Dal\ServiceStepDal;
use App\Data\Service\Dal\ServiceStepMapDal;
use App\Data\Service\Model\ServiceStepCostHist;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ServiceStepMapController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            ServiceStepMapDal::class,
            ""
        );
    }

    public function set(Request $request)
    {
        $currency = (new CurrencyDal())->getByCode('KZT');

        $serviceStepCostHist = new ServiceStepCostHist();
        $serviceStepCostHist->service_step_id = $request->get('service_step_id');
        $serviceStepCostHist->cost = $request->get('cost');
        $serviceStepCostHist->tax = $request->get('tax');
        $serviceStepCostHist->currency_id = $currency->id;
        $serviceStepCostHist->created_by = Auth::id();
        ServiceStepCostHistDal::set($serviceStepCostHist);

        return parent::set($request);
    }

    public function getListByService($serviceId)
    {
        $entityList = (new ServiceStepMapDal())->getByService($serviceId);
        return response()->json($entityList);
    }

    public function getListAndDict($serviceId)
    {
        $result = new \stdClass();
        $result->stepList = (new ServiceStepMapDal())->getByService($serviceId);
        $result->fullServiceStepList = (new ServiceStepDal())->getList();
        return response()->json($result);
    }

}
