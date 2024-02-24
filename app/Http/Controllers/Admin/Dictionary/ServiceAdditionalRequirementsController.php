<?php


namespace App\Http\Controllers\Admin\Dictionary;

use App\Data\Service\Dal\LicenseTypeDal;
use App\Data\Service\Dal\ServiceAdditionalRequirementsDal;
use App\Data\Service\Dal\ServiceAdditionalRequirementsTypeDal;
use App\Data\Service\Model\Service;
use App\Data\Service\Model\ServiceAdditionalRequirements;
use App\Http\Controllers\BaseController;

class ServiceAdditionalRequirementsController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            ServiceAdditionalRequirementsDal::class,
            'admin.dictionary.ServiceAdditionalRequirements.index'
        );
    }

    public function index()
    {
        $licenseTypeList = (new LicenseTypeDal())->getList();
        $serviceAdditionalRequirementsTypeList = (new ServiceAdditionalRequirementsTypeDal())->getList();

        return view($this->indexView)
            ->with('licenseTypeList', $licenseTypeList)
            ->with('serviceAdditionalRequirementsTypeList', $serviceAdditionalRequirementsTypeList);
    }

    public function getList(bool $withPagination = false, array $relationList = [])
    {
        return parent::getList($withPagination, ['licenseType', 'serviceAdditionalRequirementsType']);
    }
}