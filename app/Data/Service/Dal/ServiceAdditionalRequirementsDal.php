<?php


namespace App\Data\Service\Dal;


use App\Data\Core\Dal\BaseDal;
use App\Data\Service\Model\LicenseType;
use App\Data\Service\Model\ServiceAdditionalRequirements;
use App\Data\Service\Model\ServiceAdditionalRequirementsMap;
use App\Data\Service\Model\ServiceAdditionalRequirementsType;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Support\Facades\DB;

class ServiceAdditionalRequirementsDal extends BaseDal
{
    public function __construct()
    {
        parent::__construct(ServiceAdditionalRequirements::class);
    }

    public function getByUnique($additionalRequirementTypeId, $licenseTypeId, $description){
        $entityList = $this->model::where('service_additional_requirements_type_id',$additionalRequirementTypeId)
            ->where('license_type_id', $licenseTypeId)
            ->where('description', $description);

        TranslationDal::generateQuery($this->tableName, $entityList, $this->getColumnListWithTableName(), false);

        return $entityList->first();
    }

    public function getListByServiceArray($serviceArray, bool $translateData = false)
    {
        $entityList = ServiceAdditionalRequirementsMap::whereIn('service_id', $serviceArray)
            ->join('service_additional_requirements', 'service_additional_requirements_map.service_additional_requirements_id', '=', 'service_additional_requirements.id')
            ->join('service_additional_requirements_type', 'service_additional_requirements.service_additional_requirements_type_id', '=', 'service_additional_requirements_type.id')
            ->select(
                'service_additional_requirements.id',
                'service_additional_requirements_type.id as additional_requirements_type_id',
                DB::raw('max(service_additional_requirements_type.name) as type_name'),
                DB::raw('max(service_additional_requirements.description) as description')
            )
            ->groupBy('service_additional_requirements.id', 'service_additional_requirements_type.id')
        ;

        $serviceAdditionalRequirements = new ServiceAdditionalRequirements;
        TranslationDal::generateQuery($serviceAdditionalRequirements->getTableName(), $entityList, $serviceAdditionalRequirements->getEntityColumnList(true), $translateData);

        $serviceAdditionalRequirementsType = new ServiceAdditionalRequirementsType();
        TranslationDal::generateQuery($serviceAdditionalRequirementsType->getTableName(), $entityList, $serviceAdditionalRequirementsType->getEntityColumnList(true), $translateData);

        return $entityList->get();
    }

    public function getListByLicenseType($licenseTypeId)
    {
        return $this->model::where('license_type_id', $licenseTypeId)->get();
    }
}