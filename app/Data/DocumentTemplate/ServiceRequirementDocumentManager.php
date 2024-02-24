<?php


namespace App\Data\DocumentTemplate;


use App\Data\Catalog\Dal\CatalogDal;
use App\Data\Catalog\Dal\ServiceCatalogDal;
use App\Data\Core\Dal\SettingDal;
use App\Data\DocumentTemplate\Dal\DocumentTemplateDal;
use App\Data\DocumentTemplate\Helper\AgreementReplacementKeyList;
use App\Data\DocumentTemplate\Helper\CommercialOfferKeyList;
use App\Data\DocumentTemplate\Helper\ServiceRequirementKeyList;
use App\Data\DocumentTemplate\Helper\ReplacmentItemType;
use App\Data\Helper\AgreementTypeList;
use App\Data\Helper\CatalogTypeList;
use App\Data\Helper\DocumentTemplateTypeList;
use App\Data\Helper\FilePathHelper;
use App\Data\Payment\Dal\AgreementDal;
use App\Data\Service\Dal\ServiceAdditionalRequirementsDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\Service\Dal\ServiceStepMapDal;
use App\Data\Service\Dal\ServiceStepRequiredDocumentDal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\ComplexType\TblWidth;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Shared\Converter;

class ServiceRequirementDocumentManager extends DocumentManager
{
    protected $serviceIdList;
    protected $license;

    /**
     * CommercialOfferDocumentManager constructor.
     * @param $serviceIdList
     */
    public function __construct($serviceIdList)
    {
        $this->serviceIdList = $serviceIdList;

        $catalogNode = ServiceCatalogDal::getNodeByService(intval($serviceIdList[0]));
        $this->license = CatalogDal::getParentNodeByType($catalogNode->catalog_id, CatalogTypeList::WHITE_BOX_WITH_ICON);

        $service = ServiceDal::get($this->serviceIdList[0]);

        $documentTemplate = DocumentTemplateDal::getByCountryAndTemplateType(
            $service->country_id,
            DocumentTemplateTypeList::ServiceRequirementTemplate
        );

        parent::__construct(
            $documentTemplate,
            new WordDocumentTemplateGenerator($documentTemplate->path)
        );
    }

    protected function prepareReplacementMap(): void
    {
        $serviceList = ServiceDal::getListByIdArray($this->serviceIdList, true);
        $serviceAdditionalRequirementsList = (new ServiceAdditionalRequirementsDal())->getListByServiceArray($this->serviceIdList, true);
        $serviceStepList = (new ServiceStepMapDal())->getListByServiceArray($this->serviceIdList);
        $requiredDocumentList = (new ServiceStepRequiredDocumentDal())->getListByServiceArray($this->serviceIdList, true);
        $serviceTotals = ServiceDal::getServiceTotals($this->serviceIdList, null);
//        $mrp = SettingDal::getMrp();
        $totalCost = 0;
        $totalTime = 0;


        $this->addReplacementMapItem(
            ServiceRequirementKeyList::createDate,
            now()->format('d.m.Y')
        );
        $this->addReplacementMapItem(
            ServiceRequirementKeyList::licenseName,
            $this->license->name
        );
        $this->addReplacementMapItem(
            ServiceRequirementKeyList::licenseName2,
            $this->license->name
        );

        $serviceName = '';
        $serviceDescription = '';
        foreach($serviceList->unique('comment') as $service){
            $serviceName .= $service->name . "<w:br/>";
            $serviceDescription .= $service->comment . "<w:br/>";
        }

        $this->addReplacementMapItem(
            ServiceRequirementKeyList::serviceName,
            $serviceName
        );

        $this->addReplacementMapItem(
            ServiceRequirementKeyList::serviceExecutiveAgency,
            $serviceList[0]->executive_agency
        );

        $this->addReplacementMapItem(
            ServiceRequirementKeyList::serviceLivePeriod,
            $serviceList[0]->live_period
        );

        $this->addReplacementMapItem(
            ServiceRequirementKeyList::serviceDescription,
            $serviceDescription
        );

        $boldStyle = array('name'=>'Lato', 'size'=> 10, 'bold' => true, 'color' => '007033');
        $normalStyle = array('name'=>'Lato', 'size'=> 10, 'bold' => false);
        $evenRowStyle = array('bgColor' => 'ffffff');
        $oddRowStyle = array('bgColor' => 'ffffff');

        $serviceStepTable = new Table(array(
            'borderColor' => 'ffffff',
            'width' => 80*50,
            'cellMargin' => 40,
            'unit' => \PhpOffice\PhpWord\SimpleType\TblWidth::PERCENT,
            'align' => 'center'
        ));

        $i = 0;
        foreach($serviceList->unique('name') as $service){
            $serviceStepTable->addRow();
            if($i == 0) {
                $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('Выбранные подвиды', $boldStyle);
            } else {
                $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('', $boldStyle);
            }
            $serviceStepTable->addCell(60 * 50, $evenRowStyle)->addText($service->name, $normalStyle);
            $i++;
        }
        $serviceStepTable->addRow();
        $cell = $serviceStepTable->addCell();
        $cell->getStyle()->setGridSpan(2);
        $cell->addText('', [], ['borderBottomSize' => 6]);

        $serviceStepTable->addRow();
        $serviceStepTable->addCell(40 * 50, $oddRowStyle)->addText('Уполномоченный орган', $boldStyle);
        $serviceStepTable->addCell(60 * 50, $oddRowStyle)->addText($serviceList[0]->executive_agency, $normalStyle);
        $serviceStepTable->addRow();
        $serviceStepTable->addCell(40 * 50, $oddRowStyle)->addText('Стоимость государственной пошлины', $boldStyle);
        $serviceStepTable->addCell(60 * 50, $oddRowStyle)->addText($serviceTotals->stepTaxMRPTotal . ' МРП', $normalStyle);
        $serviceStepTable->addRow();
        $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('Срок оказания услуги', $boldStyle);
        $serviceStepTable->addCell(60 * 50, $evenRowStyle)->addText($serviceTotals->executionWorkDayTotal . ' ' . \App\Data\Helper\Assistant::num2word($serviceTotals->executionWorkDayTotal,  trans('messages.services.one_work_day'),  trans('messages.services.two_work_days'),  trans('messages.services.work_days')), $normalStyle);

        $serviceStepTable->addRow();
        $cell = $serviceStepTable->addCell();
        $cell->getStyle()->setGridSpan(2);
        $cell->addText('', [], ['borderBottomSize' => 6]);

        $i = 0;
        foreach($serviceAdditionalRequirementsList->groupBy('name') as $type => $valueList){
            $serviceAdditionalRequirements = '';
            $serviceAdditionalRequirements .= $type . ": ";
            $numItems = count($valueList);
            $j = 0;
            foreach ($valueList->sortBy('description') as $value) {
                $serviceAdditionalRequirements .= $value->description . (++$j === $numItems ? '' : ', ');
            }

            $serviceStepTable->addRow();
            if($i == 0) {
                $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('Дополнительные требования', $boldStyle);
            } else {
                $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('', $boldStyle);
            }
            $serviceStepTable->addCell(60 * 50, $evenRowStyle)->addText($serviceAdditionalRequirements, $normalStyle);
            $i++;
        }

        $serviceStepTable->addRow();
        $cell = $serviceStepTable->addCell();
        $cell->getStyle()->setGridSpan(2);
        $cell->addText('', [], ['borderBottomSize' => 6]);

        $i = 0;
        $serviceStep = $serviceStepList[0];
        foreach ($requiredDocumentList->where('service_step_id', $serviceStep->service_step_id)->all() as $curStepRequiredDocument) {
            $serviceStepTable->addRow();
            if($i == 0) {
                $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('Необходимые документы для получения лицензии', $boldStyle);
            } else {
                $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('', $boldStyle);
            }
            $serviceStepTable->addCell(60 * 50, $evenRowStyle)->addText($curStepRequiredDocument->serviceRequiredDocumentWithTranslate->description, $normalStyle);
            $i++;
        }

        $serviceStepTable->addRow();
        $cell = $serviceStepTable->addCell();
        $cell->getStyle()->setGridSpan(2);
        $cell->addText('', [], ['borderBottomSize' => 6]);

        $this->addReplacementMapItem(
            CommercialOfferKeyList::serviceStep,
            $serviceStepTable,
            ReplacmentItemType::ComplexBlock
        );
    }

    public function getPdfFileName()
    {
        //$this->checkDocumentAccess();

        $documentPath = $this->getDocument();
        $documentFileName = FilePathHelper::getCommercialOfferDocumentPath() .
            '/' . FilePathHelper::getFileBaseName($documentPath);
        Storage::move($documentPath, $documentFileName);

        $pdfConvertorManager = PdfConvertorManager::getConvertor($documentFileName);
        $documentPdfFileName = $pdfConvertorManager->convert();

        return $documentPdfFileName;
    }
    protected function prepareImageMap(): void
    {
        // TODO: Implement prepareImageMap() method.
    }

}