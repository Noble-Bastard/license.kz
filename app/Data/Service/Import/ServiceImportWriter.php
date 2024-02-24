<?php

namespace App\Data\Service\Import;

use App\Data\Helper\Assistant;
use App\Data\Helper\CounterTypeList;
use App\Data\Service\Dal\CurrencyDal;
use App\Data\Service\Dal\LicenseTypeDal;
use App\Data\Service\Dal\ServiceAdditionalRequirementsDal;
use App\Data\Service\Dal\ServiceAdditionalRequirementsMapDal;
use App\Data\Service\Dal\ServiceAdditionalRequirementsTypeDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\Service\Dal\ServiceRequiredDocumentDal;
use App\Data\Service\Dal\ServiceResultDal;
use App\Data\Service\Dal\ServiceStepCostHistDal;
use App\Data\Service\Dal\ServiceStepDal;
use App\Data\Service\Dal\ServiceStepMapDal;
use App\Data\Service\Dal\ServiceStepRequiredDocumentDal;
use App\Data\Service\Dal\ServiceStepResultDal;
use App\Data\Service\Dal\ServiceTypeDal;
use App\Data\Service\Model\LicenseType;
use App\Data\Service\Model\Service;
use App\Data\Service\Model\ServiceAdditionalRequirements;
use App\Data\Service\Model\ServiceAdditionalRequirementsMap;
use App\Data\Service\Model\ServiceAdditionalRequirementsType;
use App\Data\Service\Model\ServiceRequiredDocument;
use App\Data\Service\Model\ServiceStep;
use App\Data\Service\Model\ServiceStepCostHist;
use App\Data\Service\Model\ServiceStepMap;
use App\Data\Service\Model\ServiceStepRequiredDocument;
use App\Data\Service\Model\ServiceStepResult;
use App\Data\Service\Model\ServiceType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ServiceImportWriter
{
    private $serviceIdList = array();
    private $serviceThematicGroupId;

    public function write(array $serviceImportList, $serviceThematicGroupId)
    {
        $this->serviceThematicGroupId = $serviceThematicGroupId;
        foreach ($serviceImportList as $serviceImport){
            $service = $this->addService($serviceImport);
            array_push($this->serviceIdList, $service->id);
        }

        return $this->serviceIdList;
    }

    private function addService($serviceImport)
    {
        $comment = $this->getServiceImportComment($serviceImport);
        $commentEn = $this->getServiceImportCommentEn($serviceImport);
        $licenseType = $this->InitLicense($serviceImport);
        $serviceType = $this->InitServiceType($serviceImport);

        $service = (new ServiceDal())->getByCode(
            trim($serviceImport->code)
        );

        if(is_null($service)) {
            $service = new Service();
            $service->is_active = true;
            $service->service_start_date = Assistant::getCurrentDate();
        }

        $service->name = trim($serviceImport->name);
        $service->name_en = trim($serviceImport->nameEn);
        $service->code = trim($serviceImport->code);
        $service->code_en = trim($serviceImport->code);
        $service->description = trim($serviceImport->name);
        $service->description_en = trim($serviceImport->nameEn);
        $service->comment = trim($comment);
        $service->comment_en = trim($commentEn);
        $service->execution_days_from = 0;
        $service->execution_days_to = 0;
        $service->service_thematic_group_id = $this->serviceThematicGroupId;
        $service->service_end_date = null;
        $service->counter_type_id = CounterTypeList::DEFAULT_SERVICE_COUNTER;
        $service->registration_form_template_id = null;
        $service->license_type_id = $licenseType->id;
        $service->service_type_id = $serviceType->id;


        $service->base_cost = $serviceImport->base_cost;
        $service->additional_cost = $serviceImport->additional_cost;
        $service->executive_agency = $serviceImport->executive_agency;
        $service->additional_approvals = $serviceImport->additional_approvals;


        $service = ServiceDal::set($service);
        $this->removeServiceDependencies($service->id);
        $this->addServiceAdditionalRequirements($service->id, $licenseType->id, $serviceImport->serviceAdditionalRequirements);

        $serviceStepDal = new ServiceStepDal();
        $serviceStepMapDal = new ServiceStepMapDal();
        foreach ($serviceImport->serviceSteps as $serviceStepImport)
        {
            $serviceStep = $serviceStepDal->getByLicenseTypeAndDescription($licenseType->id, trim($serviceStepImport->name));
            if(is_null($serviceStep))
                $serviceStep = $this->addServiceStep($serviceStepImport, $licenseType->id);
            else {
                $serviceStep = $this->updateServiceStep($serviceStep->id, $serviceStepImport, $licenseType->id);
            }

            $serviceStepMap = new ServiceStepMap();
            $serviceStepMap->service_id = $service->id;
            $serviceStepMap->service_step_id = $serviceStep->id;
            $serviceStepMap->execution_parallel_no = null;
            $serviceStepMap->is_required = true;
            $serviceStepMap->is_active = true;
            $serviceStepMap->step_number = $serviceStepImport->stepIdx;
            $serviceStepMapDal->set($serviceStepMap);

            $this->addServiceStepCostHist(
                $serviceStep->id,
                $serviceStepImport,
                $serviceImport->currencyCode
            );

            $this->addServiceStepDocuments(
                $service->id,
                $serviceStep->id,
                $serviceStepImport->documents
            );
            $this->addServiceStepResults(
                $service->id,
                $serviceStep->id,
                $serviceStepImport->results
            );
        }

        return $service;
    }

    private function addServiceStep($serviceStepImport, $licenseTypeId)
    {
        $serviceStep = new ServiceStep();
        $serviceStep->description = trim($serviceStepImport->name);
        $serviceStep->description_en = trim($serviceStepImport->nameEn);
        $serviceStep->execution_work_day_cnt = $serviceStepImport->time;
        $serviceStep->counter_type_id = CounterTypeList::DEFAULT_SERVICE_STEP_COUNTER;
        $serviceStep->execution_time_plan = 0;
        $serviceStep->execution_parallel_no = $serviceStepImport->stepIdx;
        $serviceStep->license_type_id = $licenseTypeId;
        $newServiceStep = (new ServiceStepDal())->set($serviceStep);
        return $newServiceStep;
    }

    private function updateServiceStep($serviceStepId, $serviceStepImport, $licenseTypeId){
        $serviceStep = new ServiceStep();
        $serviceStep->id = $serviceStepId;
        $serviceStep->description = trim($serviceStepImport->name);
        $serviceStep->description_en = trim($serviceStepImport->nameEn);
        $serviceStep->execution_work_day_cnt = $serviceStepImport->time;
        $serviceStep->counter_type_id = CounterTypeList::DEFAULT_SERVICE_STEP_COUNTER;
        $serviceStep->execution_time_plan = 0;
        $serviceStep->execution_parallel_no = $serviceStepImport->stepIdx;
        $serviceStep->license_type_id = $licenseTypeId;
        $newServiceStep = (new ServiceStepDal())->set($serviceStep);
        return $newServiceStep;
    }

    private function getServiceImportComment($serviceImport): string
    {
        $comments = array_map(
            function ($serviceImportComments) {
                return $serviceImportComments->name;
            },
            $serviceImport->serviceComments
        );
        $comment = implode(PHP_EOL, $comments);
        return $comment;
    }

    private function getServiceImportCommentEn($serviceImport): string
    {
        $commentsEn = array_map(
            function ($serviceImportComments) {
                return $serviceImportComments->nameEn;
            },
            $serviceImport->serviceComments
        );
        $commentEn = implode(PHP_EOL, $commentsEn);
        return $commentEn;
    }

    private function addServiceStepCostHist(int $serviceStepId, $serviceStepImport, $currencyCode)
    {
        $currency = (new CurrencyDal)->init($currencyCode);
        $entityCostHist = new ServiceStepCostHist();
        $entityCostHist->service_step_id = $serviceStepId;
        $entityCostHist->cost = $serviceStepImport->cost;
        $entityCostHist->tax = $serviceStepImport->tax;
        $entityCostHist->currency_id = $currency->id;
        $entityCostHist->created_by = Auth::id();
        $entityCostHist->create_date = Assistant::getCurrentDate();
        ServiceStepCostHistDal::set($entityCostHist);
    }

    private function addServiceStepDocuments(int $serviceId, int $serviceStepId, $serviceStepImportDocuments)
    {
        $serviceRequiredDocumentDal = new ServiceRequiredDocumentDal();
        foreach ($serviceStepImportDocuments as $key=>$serviceStepImportDocument) {
            $serviceRequiredDocument = $serviceRequiredDocumentDal->getByDescription(trim($serviceStepImportDocument->name));
            if(is_null($serviceRequiredDocument)){
                $serviceRequiredDocument = new ServiceRequiredDocument();
                $serviceRequiredDocument->description = trim($serviceStepImportDocument->name);
                $serviceRequiredDocument->description_en = trim($serviceStepImportDocument->nameEn);
                $serviceRequiredDocument->document_template_id = null;
                $serviceRequiredDocument = $serviceRequiredDocumentDal->set($serviceRequiredDocument);
            }
            $entity = new ServiceStepRequiredDocument();
            $entity->service_step_id = $serviceStepId;
            $entity->service_id = $serviceId;
            $entity->service_required_document_id = $serviceRequiredDocument->id;
            $entity->document_number = $key;
            (new ServiceStepRequiredDocumentDal())->set($entity);
        }
    }

    private function addServiceStepResults(int $serviceId, int $serviceStepId, $serviceStepImportResults)
    {
        $serviceResultDal = new ServiceResultDal();
        foreach ($serviceStepImportResults as $serviceStepImportResult) {
            $serviceResult = $serviceResultDal->getByDescription(trim($serviceStepImportResult->name));
            if(is_null($serviceResult)){
                $serviceResult = new ServiceRequiredDocument();
                $serviceResult->description = trim($serviceStepImportResult->name);
                $serviceResult->description_en = trim($serviceStepImportResult->nameEn);
                $serviceResult = $serviceResultDal->set($serviceResult);
            }
            $entity = new ServiceStepResult();
            $entity->service_step_id = $serviceStepId;
            $entity->service_id = $serviceId;
            $entity->service_result_id = $serviceResult->id;
            (new ServiceStepResultDal())->set($entity);
        }
    }

    private function InitLicense($serviceImport): LicenseType
    {
        $impLicenseType = new LicenseType();
        $impLicenseType->name = trim($serviceImport->licenseTypeName);
        $impLicenseType->name_en = trim($serviceImport->licenseTypeNameEn);
        $licenseType = (new LicenseTypeDal())->init($impLicenseType);
        return $licenseType;
    }

    private function InitServiceType($serviceImport): ServiceType
    {
        $impServiceType = new ServiceType();
        $impServiceType->name = trim($serviceImport->serviceTypeName);
        $impServiceType->name_en = trim($serviceImport->serviceTypeNameEn);
        $serviceType = (new ServiceTypeDal())->init($impServiceType);
        return $serviceType;
    }


    private function removeServiceDependencies(int $serviceId): void
    {
        (new ServiceStepMapDal())->deleteByServiceId($serviceId);
        (new ServiceStepRequiredDocumentDal())->deleteByServiceId($serviceId);
        (new ServiceStepResultDal())->deleteByServiceId($serviceId);
        (new ServiceAdditionalRequirementsMapDal())->deleteByServiceId($serviceId);
    }

    private function addServiceAdditionalRequirements(int $serviceId, int $licenseTypeId, $serviceAdditionalRequirements)
    {
        $arTypeDal = new ServiceAdditionalRequirementsTypeDal();
        $arDal = new ServiceAdditionalRequirementsDal();
        $arMapDal = new ServiceAdditionalRequirementsMapDal();
        foreach ($serviceAdditionalRequirements as $serviceAdditionalRequirement)
        {
            $arTypeName = $this->getAdditionalRequirementType($serviceAdditionalRequirement->name);
            $arTypeNameEn = $this->getAdditionalRequirementType($serviceAdditionalRequirement->nameEn);

            $stepNo = $this->getAdditionalRequirementStep($serviceAdditionalRequirement->name);

            $arType = $arTypeDal->getByName(trim($arTypeName));
            if(is_null($arType)){
                $arType = new ServiceAdditionalRequirementsType();
                $arType->name = trim($arTypeName);
                $arType->name_en = trim($arTypeNameEn);
                $arType = $arTypeDal->set($arType);
            }

            $arValues = $this->getAdditionalRequirementValues($serviceAdditionalRequirement->name);
            $arEnValues = $this->getAdditionalRequirementValues($serviceAdditionalRequirement->nameEn);
            foreach($arValues as $key=>$arValue)
            {
                $serviceAdditionalRequirement = $arDal->getByUnique($arType->id, $licenseTypeId, trim($arValue));
                if(is_null($serviceAdditionalRequirement)){
                    $serviceAdditionalRequirement = new ServiceAdditionalRequirements();
                    $serviceAdditionalRequirement->service_additional_requirements_type_id = $arType->id;
                    $serviceAdditionalRequirement->step_no = $stepNo;
                    $serviceAdditionalRequirement->license_type_id = $licenseTypeId;
                    $serviceAdditionalRequirement->description = trim($arValue);
                    $serviceAdditionalRequirement->description_en = trim($arEnValues[$key]);
                    $serviceAdditionalRequirement = $arDal->set($serviceAdditionalRequirement);
                } else {
                    $serviceAdditionalRequirement->step_no = $stepNo;
                    $serviceAdditionalRequirement = $arDal->set($serviceAdditionalRequirement);
                }

                $serviceAdditionalRequirementMap = new ServiceAdditionalRequirementsMap();
                $serviceAdditionalRequirementMap->service_id = $serviceId;
                $serviceAdditionalRequirementMap->service_additional_requirements_id = $serviceAdditionalRequirement->id;
                $arMapDal->set($serviceAdditionalRequirementMap);
            }
        }
    }

    private function getAdditionalRequirementStep($arString): ?string
    {
        $result = str_replace('|', '', trim(substr($arString, 0, (strpos($arString, '| ') === false) ? null : strpos($arString, '| '))));
        return empty($result) ? null : $result;
    }

    private function getAdditionalRequirementType($arString): string
    {
        $stepNoPos = (strpos($arString, '| ') === false) ? 0 : strpos($arString, '| ') + 2;
        return trim(substr($arString, $stepNoPos, (strpos($arString, ':') === false) ? null : strpos($arString, ':') - $stepNoPos));
    }

    private function getAdditionalRequirementValues($arString): array
    {
        return explode(";", substr($arString, (strpos($arString, ':') === false) ? null : strpos($arString, ':') + 1));
    }

}