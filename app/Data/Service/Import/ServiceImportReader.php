<?php

namespace App\Data\Service\Import;

use App\Data\Helper\FilePathHelper;
use App\Data\Service\Dal\LicenseTypeDal;
use App\Data\Service\Import\Data\AdditionalRequirement;
use App\Data\Service\Import\Data\Comment;
use App\Data\Service\Import\Data\Document;
use App\Data\Service\Import\Data\Result;
use App\Data\Service\Import\Data\Service;
use App\Data\Service\Import\Data\Step;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ServiceImportReader
{
    private $services = array();
    private $currentRow = 0;
    private $pointerCellValue = "";

    const COL_RU = "B";
    const COL_EN = "H";
    const COL_POINTER = "A";

    const ROW_START = "1";
    const STEP_MASK = "/^Шаг \d+[.]/";
    const STEP_COST_MASK = "/^Стоимость [(]конс/";
    const STEP_TAX_MASK = "/^Стоимость [(]гос/";
    const STEP_TIME_MASK = "/^Время/";
    const STEP_DOCUMENTS_MASK = "/^Список док/";
    const STEP_RESULTS_MASK = "/^Результат/";


    const SERVICE_NAME_MASK = "/^Услуга/";
    const SERVICE_CURRENCY_MASK = "/^Код валюты/";
    const COMMENT_MASK = "/^Комментарий/";
    const ADDITIONAL_REQUIREMNTS = "/^Доп. требования/";
    const SERVICE_LICENSE_TYPE = "/^Тип лицензии/";
    const SERVICE_TYPE = "/^Тип услуги/";
    const BASE_COST = "/^Базовая стоимость/";
    const ADDITIONAL_COST = "/^Дополнительная стоимость/";
    const EXECUTIVE_AGENCY = "/^Орган выдачи/";
    const ADDITIONAL_APPROVALS = "/^Дополнительное согласование/";


    public function read(string $sampleFileName)
    {
        $document = $this->loadDocument($sampleFileName);

        $sheetCnt = $document->getSheetCount();
        for ($sheetNo = 0; $sheetNo <= $sheetCnt - 1; $sheetNo++)
            $this->readServiceSheet($document->getSheet($sheetNo));

        return $this->services;
    }

    private function loadDocument(string $sampleFileName): \PhpOffice\PhpSpreadsheet\Spreadsheet
    {
        $sampleFullFileName = FilePathHelper::getFileFullName($sampleFileName);
        $document = IOFactory::load($sampleFullFileName);
        return $document;
    }

    private function readServiceSheet(Worksheet $sheet)
    {
        if ($sheet->getSheetState() == 'hidden') {
            return;
        }
        $service = new Service();
        $this->readServiceHeader($sheet, $service);
        $this->readServiceAdditionalRequirements($sheet, $service);
        $this->readServiceComments($sheet, $service);
        $this->readServiceSteps($sheet, $service);
        array_push($this->services, $service);
    }

    private function readServiceHeader(Worksheet $sheet, $service): void
    {
        $service->code = $sheet->getTitle();

        $this->currentRow = self::ROW_START - 1;
        $this->nextRow($sheet);
        while (!($this->isCommentRow() || $this->isAdditionalRequirementRow())) {
            if ($this->isServiceNameRow()) {
                $service->name = $this->getCurrentRowValue($sheet);
                $service->nameEn = $this->getCurrentRowEnValue($sheet);
            }

            if ($this->isLicenseTypeRow()) {
                $service->licenseTypeName = $this->getCurrentRowValue($sheet);
                $service->licenseTypeNameEn = $this->getCurrentRowEnValue($sheet);
            }

            if ($this->isCurrencyRow()) {
                $service->currencyCode = $this->getCurrentRowValue($sheet);
                $service->currencyCodeEn = $this->getCurrentRowEnValue($sheet);
            }

            if ($this->isServiceTypeRow()) {
                $service->serviceTypeName = $this->getCurrentRowValue($sheet);
                $service->serviceTypeNameEn = $this->getCurrentRowEnValue($sheet);
            }

            if ($this->isBaseCostRow()) {
                $service->base_cost = $this->getCurrentRowValue($sheet);
            }

            if ($this->isAdditionalCostRow()) {
                $service->additional_cost = $this->getCurrentRowValue($sheet);
            }

            if ($this->isAdditionalApprovals()) {
                $service->additional_approvals = $this->getCurrentRowValue($sheet);
            }

            if ($this->isExecutiveAgency()) {
                $service->executive_agency = $this->getCurrentRowValue($sheet);
            }

            $this->nextRow($sheet);
        }
    }

    private function readServiceAdditionalRequirements(Worksheet $sheet, Service $service)
    {
        while (!($this->isCommentRow() || $this->isStepRow())) {
            $rowValue = $this->getCurrentRowValue($sheet);
            $rowValueEn = $this->getCurrentRowEnValue($sheet);
            if ($this->isCorrectAdditionalRequirementValues($rowValue, $rowValueEn)) {
                $additionalRequirement = new AdditionalRequirement(
                    $rowValue,
                    $rowValueEn
                );
                array_push($service->serviceAdditionalRequirements, $additionalRequirement);
            }
            $this->nextRow($sheet);
        }
    }

    private function isCorrectAdditionalRequirementValues($rowValue, $rowValueEn): bool
    {
        return !is_null($rowValue)
            && $rowValue != ""
            && strpos($rowValue, ':') !== false
            && strpos($rowValueEn, ':') !== false
            && substr_count($rowValue, ';') === substr_count($rowValueEn, ';');
    }

    private function readServiceComments(Worksheet $sheet, Service $service)
    {
        while (!$this->isStepRow()) {
            $comment = new Comment(
                $this->getCurrentRowValue($sheet),
                $this->getCurrentRowEnValue($sheet)
            );
            array_push($service->serviceComments, $comment);
            $this->nextRow($sheet);
        }
    }

    private function readServiceSteps(Worksheet $sheet, Service $service)
    {
        $currentStepNo = 0;
        $highestSheetRow = $sheet->getHighestRow();

        for ($this->currentRow; $this->currentRow <= $highestSheetRow;) {
            if ($this->isStepRow()) {
                $currentStepNo++;
                $this->addNewStep($sheet, $service, $currentStepNo);
            }

            if ($this->isStepDocumentRow())
                $this->readServiceStepDocuments(
                    $sheet,
                    $service->serviceSteps[$currentStepNo - 1]
                );

            if ($this->isStepCostRow())
                $service->serviceSteps[$currentStepNo - 1]->cost = $this->getCurrentRowValue($sheet) ?? 0;

            if ($this->isStepTaxRow())
                $service->serviceSteps[$currentStepNo - 1]->tax = $this->getCurrentRowValue($sheet) ?? 0;

            if ($this->isStepTimeRow())
                $service->serviceSteps[$currentStepNo - 1]->time = $this->getCurrentRowValue($sheet) ?? 0;

            if ($this->isStepResultRow())
                $this->readServiceStepResults(
                    $sheet,
                    $service->serviceSteps[$currentStepNo - 1]
                );
            else
                $this->nextRow($sheet);
        }
    }

    private function addNewStep(Worksheet $sheet, $service, $currentStepNo): Step
    {
        $step = new Step();
        $step->stepNo = $this->pointerCellValue;
        $step->stepIdx = $currentStepNo;
        $step->name = $this->getCurrentRowValue($sheet);
        $step->nameEn = $this->getCurrentRowEnValue($sheet);
        $step->cost = 0;
        $step->tax = 0;
        $step->time = 0;

        array_push(
            $service->serviceSteps,
            $step
        );

        return $step;
    }

    private function readServiceStepDocuments(Worksheet $sheet, $serviceStep): void
    {
        $sheetRowCnt = $sheet->getHighestRow();
        while (!$this->isStepTimeRow() && $this->currentRow <= $sheetRowCnt) {

            if (!is_null($this->getCurrentRowValue($sheet))) {
                $document = new Document();
                $document->name = $this->getCurrentRowValue($sheet);
                $document->nameEn = $this->getCurrentRowEnValue($sheet);
                array_push(
                    $serviceStep->documents,
                    $document
                );
            }
            $this->nextRow($sheet);
        }
    }

    private function readServiceStepResults(Worksheet $sheet, $serviceStep)
    {
        $sheetRowCnt = $sheet->getHighestRow();
        while (!$this->isStepRow() && $this->currentRow <= $sheetRowCnt) {
            $result = new Result();
            $result->name = $this->getCurrentRowValue($sheet);
            $result->nameEn = $this->getCurrentRowEnValue($sheet);

            if (!is_null($result->name))
                array_push(
                    $serviceStep->results,
                    $result
                );
            $this->nextRow($sheet);
        }
    }

    private function isServiceNameRow()
    {
        return preg_match(self::SERVICE_NAME_MASK, $this->pointerCellValue);
    }

    private function isServiceTypeRow()
    {
        return preg_match(self::SERVICE_TYPE, $this->pointerCellValue);
    }

    private function isExecutiveAgency()
    {
        return preg_match(self::EXECUTIVE_AGENCY, $this->pointerCellValue);
    }

    private function isAdditionalApprovals()
    {
        return preg_match(self::ADDITIONAL_APPROVALS, $this->pointerCellValue);
    }

    private function isBaseCostRow()
    {
        return preg_match(self::BASE_COST, $this->pointerCellValue);
    }

    private function isAdditionalCostRow()
    {
        return preg_match(self::ADDITIONAL_COST, $this->pointerCellValue);
    }

    private function isCurrencyRow()
    {
        return preg_match(self::SERVICE_CURRENCY_MASK, $this->pointerCellValue);
    }

    private function isLicenseTypeRow()
    {
        return preg_match(self::SERVICE_LICENSE_TYPE, $this->pointerCellValue);
    }

    private function isCommentRow()
    {
        return preg_match(self::COMMENT_MASK, $this->pointerCellValue);
    }

    private function isAdditionalRequirementRow()
    {
        return preg_match(self::ADDITIONAL_REQUIREMNTS, $this->pointerCellValue);
    }

    private function isStepRow()
    {
        return preg_match(self::STEP_MASK, $this->pointerCellValue);
    }


    private function isStepCostRow()
    {
        return preg_match(self::STEP_COST_MASK, $this->pointerCellValue);
    }


    private function isStepTaxRow()
    {
        return preg_match(self::STEP_TAX_MASK, $this->pointerCellValue);
    }

    private function isStepTimeRow()
    {
        return preg_match(self::STEP_TIME_MASK, $this->pointerCellValue);
    }

    private function isStepDocumentRow()
    {
        return preg_match(self::STEP_DOCUMENTS_MASK, $this->pointerCellValue);
    }

    private function isStepResultRow()
    {
        return preg_match(self::STEP_RESULTS_MASK, $this->pointerCellValue);
    }


    private function getCurrentRowValue(Worksheet $sheet)
    {
        return $sheet->getCell(self::COL_RU . $this->currentRow)->getValue();
    }

    private function getCurrentRowEnValue(Worksheet $sheet)
    {
        return $sheet->getCell(self::COL_EN . $this->currentRow)->getValue();
    }

    private function nextRow(Worksheet $sheet): void
    {
        $this->currentRow++;
        $this->pointerCellValue = $sheet->getCell(self::COL_POINTER . $this->currentRow)
            ->getValue();
    }


}