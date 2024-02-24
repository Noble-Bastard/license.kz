<?php

namespace App\Http\Controllers\Admin\Service;

use App\Data\Core\Dal\CounterTypeDal;
use App\Data\Service\Dal\CurrencyDal;
use App\Data\Service\Dal\LicenseTypeDal;
use App\Data\Service\Dal\ServiceStepDal;
use App\Data\Service\Dal\ServiceStepMapDal;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ServiceStepController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            ServiceStepDal::class,
            "admin.service.serviceStep.list.index"
        );
    }

    public function index(){
        $licenseTypes = (new LicenseTypeDal())->getList();
        return view('admin.service.serviceStep.list.index')
            ->with('licenseTypes', $licenseTypes);
    }

    public function set(Request $request)
    {
        $this->validateData($request);
        $entity = $this->getEntity();
        $entity['cost'] = Input::get('cost');
        $entity['tax'] = Input::get('tax') ?? 0;
        $entity['currency_id'] = Input::get('currency_id');
        $this->dalObject->set($entity);
        return response()->json('1');
    }

    public function getListByServiceId($serviceId)
    {
        $entityList = (new ServiceStepMapDal())->getExtByService($serviceId);
        return response()->json($entityList);
    }

    public function getListAndDict($licenseTypeId)
    {
        $result = new \stdClass();
        $result->stepList = (new ServiceStepDal())->getByLicenseType($licenseTypeId);
        $result->counterTypeList = CounterTypeDal::getList(false);
        $result->licenseTypeList = (new LicenseTypeDal())->getList(false);
        $result->currencyTypeList = (new CurrencyDal())->getList(false);
        return response()->json($result);
    }

}
