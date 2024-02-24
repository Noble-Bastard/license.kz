<?php

namespace Tests\Unit;


use App\Data\Helper\FilePathHelper;
use App\Data\Service\Dal\ServiceAdditionalRequirementsDal;
use App\Data\Service\Dal\ServiceAdditionalRequirementsMapDal;
use App\Data\Service\Dal\ServiceAdditionalRequirementsTypeDal;
use App\Data\Service\Dal\ServiceDal;

use App\Data\Service\Dal\ServiceRequiredDocumentDal;
use App\Data\Service\Dal\ServiceResultDal;
use App\Data\Service\Dal\ServiceStepDal;
use App\Data\Service\Dal\ServiceStepMapDal;
use App\Data\Service\Dal\ServiceStepRequiredDocumentDal;
use App\Data\Service\Dal\ServiceStepResultDal;
use App\Data\Service\Import\ServiceImportReader;
use App\Data\Service\Import\ServiceImportWriter;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ServiceImportWriterTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        DB::beginTransaction();
    }

    public function tearDown() : void
    {
        DB::rollback();
        parent::tearDown();
    }

    public function testServiceImportWriter()
    {
        $sampleFileName = FilePathHelper::getTestSampleFolder() . "/serviceImportSampleData.xlsx";
        $serviceImportReader = new ServiceImportReader();
        $serviceImportList = $serviceImportReader->read($sampleFileName);

        $serviceImportWriter = new ServiceImportWriter();
        $serviceIdList = $serviceImportWriter->write($serviceImportList, 1);

        $this->assertInsertedServices($serviceImportList, $serviceIdList);
    }

    private function assertInsertedServices(array $serviceImportList, $serviceIdList)
    {
        $this->assertCount(count($serviceImportList),$serviceIdList);
        $insertedServices =  (new ServiceDal())::getList(
            false,
            null,
            null,
            null,
            $serviceIdList
        );

        foreach ($serviceImportList as $serviceImport)
        {
            $comment = trim($this->getServiceImportComment($serviceImport));
            $commentEn = trim($this->getServiceImportCommentEn($serviceImport));

            $insertedService = $insertedServices->where("code", $serviceImport->code)
                ->first();
            $this->assertNotNull($insertedService);
            $this->assertEquals($insertedService->name, trim($serviceImport->name));
            $this->assertEquals($insertedService->comment, $comment);
            $this->assertEquals($insertedService->name_en, trim($serviceImport->nameEn));
            $this->assertEquals($insertedService->comment_en, $commentEn);
            $this->assertAdditionalRequirements($insertedService->id,$serviceImport);
            $this->assertInsertedServiceSteps($insertedService->id,$serviceImport);
        }
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

    private function assertInsertedServiceSteps($insertedServiceId, $serviceImport)
    {
        $insertedServiceSteps = (new ServiceStepMapDal())->getExtByService($insertedServiceId);

        foreach ($serviceImport->serviceSteps as $serviceStepImport) {
            $insertedServiceStep = $insertedServiceSteps
                ->where('step_number',$serviceStepImport->stepIdx)
                ->first();

            $this->assertNotNull($insertedServiceStep);
            $this->assertEquals($insertedServiceStep->description, trim($serviceStepImport->name));
            $this->assertEquals($insertedServiceStep->description_en, trim($serviceStepImport->nameEn));
            $this->assertEquals($insertedServiceStep->execution_work_day_cnt, $serviceStepImport->time);
            $this->assertEquals($insertedServiceStep->step_number, $serviceStepImport->stepIdx);
            $this->assertEquals($insertedServiceStep->execution_parallel_no, $serviceStepImport->stepIdx);
            $this->assertEquals($insertedServiceStep->step_tax, $serviceStepImport->tax);
            $this->assertEquals($insertedServiceStep->step_cost, $serviceStepImport->cost);
            $this->assertEquals($insertedServiceStep->step_currency_name, $serviceImport->currencyCode);

            $this->assertInsertedServiceStepRequiredDocuments($insertedServiceStep->id, $insertedServiceId , $serviceStepImport);
            $this->assertInsertedServiceStepResults($insertedServiceStep->id, $insertedServiceId, $serviceStepImport);
        }
    }

    private function assertInsertedServiceStepResults($insertedServiceStepId, $serviceId, $serviceStepImport)
    {
        $serviceResultDal = new ServiceResultDal();
        $insertedServiceStepResults = (new ServiceStepResultDal())->getByServiceStepAndService($insertedServiceStepId, $serviceId, false);
        $insertedServiceStepResultsExt = $insertedServiceStepResults->map(function ($insertedServiceStepResult) use($serviceResultDal) {
            return  $serviceResultDal->get($insertedServiceStepResult->serviceResult->id);
        });

        foreach ($serviceStepImport->results as $serviceStepImportResult) {
            $this->assertNotNull(
                $insertedServiceStepResultsExt
                    ->where('description',trim($serviceStepImportResult->name))
                    ->where('description_en',trim($serviceStepImportResult->nameEn))
                    ->first()
            );
        }
    }

    private function assertInsertedServiceStepRequiredDocuments($insertedServiceStepId, $serviceId, $serviceStepImport)
    {
        $serviceRequiredDocumentDal = new ServiceRequiredDocumentDal();
        $insertedServiceStepDocuments = (new ServiceStepRequiredDocumentDal())->getByServiceStepAndService($insertedServiceStepId, $serviceId,false);
        $insertedServiceStepDocumentsExt = $insertedServiceStepDocuments->map(function ($insertedServiceStepDocument) use($serviceRequiredDocumentDal) {
            return  $serviceRequiredDocumentDal->get($insertedServiceStepDocument->serviceRequiredDocument->id);
        });

        foreach ($serviceStepImport->documents as $serviceStepImportDocument) {
            $this->assertNotNull(
                $insertedServiceStepDocumentsExt
                    ->where('description',trim($serviceStepImportDocument->name))
                    ->where('description_en',trim($serviceStepImportDocument->nameEn))
                    ->first()
            );
        }
    }

    private function assertAdditionalRequirements($serviceId, $serviceImport)
    {
        $serviceAdditionalRequirementTypes = (new ServiceAdditionalRequirementsTypeDal())->getList();
        $serviceAdditionalRequirementsMapList = (new ServiceAdditionalRequirementsMapDal())->getListByService($serviceId);

        $serviceAdditionalRequirementDal = new ServiceAdditionalRequirementsDal();
        $serviceAdditionalRequirementsMapListExt = $serviceAdditionalRequirementsMapList->map(function ($serviceAdditionalRequirementsMap) use($serviceAdditionalRequirementDal) {
            return  $serviceAdditionalRequirementDal->get($serviceAdditionalRequirementsMap->service_additional_requirements_id);
        });

        foreach($serviceImport->serviceAdditionalRequirements as $serviceAdditionalRequirement){

            $arTypeName = $this->getAdditionalRequirementType($serviceAdditionalRequirement->name);
            $arTypeNameEn = $this->getAdditionalRequirementType($serviceAdditionalRequirement->nameEn);

            $this->assertNotNull(
                $serviceAdditionalRequirementTypes
                    ->where('name',trim($arTypeName))
                    ->where('name_en',trim($arTypeNameEn))
                    ->first()
            );

            $arValues = $this->getAdditionalRequirementValues($serviceAdditionalRequirement->name);
            $arEnValues = $this->getAdditionalRequirementValues($serviceAdditionalRequirement->nameEn);
            foreach($arValues as $key=>$arValue) {
                $this->assertNotNull(
                    $serviceAdditionalRequirementsMapListExt
                        ->where('description',trim($arValue))
                        ->where('description_en',trim($arEnValues[$key]))
                        ->first()
                );
            }
        }

    }


    private function getAdditionalRequirementType($arString): string
    {
        return trim(substr($arString, 0, (strpos($arString, ':') === false) ? null : strpos($arString, ':')));
    }

    private function getAdditionalRequirementValues($arString): array
    {
        return explode(",", substr($arString, (strpos($arString, ':') === false) ? null : strpos($arString, ':') + 1));
    }

}