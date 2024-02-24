<?php


namespace App\Http\Controllers\Admin\Service;

use App\Data\Service\Dal\LicenseTypeDal;
use App\Data\Service\Dal\ServiceAdditionalRequirementsDal;
use App\Data\Service\Dal\ServiceAdditionalRequirementsMapDal;
use App\Data\Service\Dal\ServiceAdditionalRequirementsTypeDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\Service\Model\Service;
use App\Data\Service\Model\ServiceAdditionalRequirements;
use App\Http\Controllers\BaseController;

class ServiceAdditionalRequirementsMapController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            ServiceAdditionalRequirementsMapDal::class,
            ""
        );
    }

    public function getListAndDict($serviceId)
    {
        $serviceExt = ServiceDal::get($serviceId);

        $result = new \stdClass();
        $result->serviceAdditionalRequirementsTypeList = (new ServiceAdditionalRequirementsTypeDal())->getList();
        $result->serviceAdditionalRequirementsMapList = (new ServiceAdditionalRequirementsMapDal())->getListByService([$serviceId]);
        $result->serviceAdditionalRequirementsList = (new ServiceAdditionalRequirementsDal())->getListByLicenseType($serviceExt->license_type_id);

        return response()->json($result);
    }
}