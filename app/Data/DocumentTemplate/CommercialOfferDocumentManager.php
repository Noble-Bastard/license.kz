<?php


namespace App\Data\DocumentTemplate;


use App\Data\Catalog\Dal\CatalogDal;
use App\Data\Catalog\Dal\ServiceCatalogDal;
use App\Data\Core\Dal\SettingDal;
use App\Data\DocumentTemplate\Dal\DocumentTemplateDal;
use App\Data\DocumentTemplate\Helper\AgreementReplacementKeyList;
use App\Data\DocumentTemplate\Helper\CommercialOfferKeyList;
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
use Illuminate\Support\Str;
use PhpOffice\PhpWord\ComplexType\TblWidth;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Shared\Converter;
//use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;
use Illuminate\Http\File;

class CommercialOfferDocumentManager extends DocumentManager
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
            DocumentTemplateTypeList::CommercialOfferTemplate
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
            CommercialOfferKeyList::createDate,
            now()->format('d.m.Y')
        );
        $this->addReplacementMapItem(
            CommercialOfferKeyList::licenseName,
            $this->license->name
        );
        $this->addReplacementMapItem(
            CommercialOfferKeyList::licenseName2,
            $this->license->name
        );

        $serviceName = '';
        foreach($serviceList->unique('name') as $service){
            $serviceName .= $service->name . (strlen($serviceName) > 0 ? '; ' : '') . "<w:br/>";
        }

        $serviceDescription = '';
        foreach($serviceList->unique('comment') as $service){
            $serviceDescription .= $service->comment . (strlen($serviceDescription) > 0 ? '; ' : '') . "<w:br/>";
        }

        $this->addReplacementMapItem(
            CommercialOfferKeyList::serviceName,
            $serviceName
        );

        $this->addReplacementMapItem(
            CommercialOfferKeyList::serviceExecutiveAgency,
            $serviceList[0]->executive_agency
        );

        $this->addReplacementMapItem(
            CommercialOfferKeyList::serviceLivePeriod,
            $serviceList[0]->live_period
        );

        $this->addReplacementMapItem(
            CommercialOfferKeyList::serviceDescription,
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

        $serviceStepTable->addRow();
        $cell = $serviceStepTable->addCell();
        $cell->getStyle()->setGridSpan(2);
        $cell->addText('Стоимость услуги ' . number_format($serviceTotals->stepCostTotal, 0, ',', ' ') . ' тг', $boldStyle, ['align' => 'right']);

        $serviceStepTable->addRow();
        $cell = $serviceStepTable->addCell();
        $cell->getStyle()->setGridSpan(2);
        $cell->addText('', [], ['borderBottomSize' => 6]);

        //add about us qr
        //generate code


//        dd($filename, Storage::path($filename), asset('images/1.png'));

//        //add to document
//        $serviceStepTable->addRow();
//        $cell = $serviceStepTable->addCell();
////        $cell->addLink('https://github.com/PHPOffice/PHPWord', htmlspecialchars('PHPWord on GitHub', ENT_COMPAT, 'UTF-8'));
//        $cell->addImage(Storage::path($filename), array('width'=>600, 'height'=>200, 'align'=>'left'));

        //remove from disk

        $this->addReplacementMapItem(
            CommercialOfferKeyList::serviceStep,
            $serviceStepTable,
            ReplacmentItemType::ComplexBlock
        );
    }

    protected function prepareImageMap(): void {
        $qrCode = new QrCode(route('new-about'));
        $output = new Output\Png();

        $data = $output->output($qrCode, 100, [255, 255, 255], [0, 0, 0], 0);
        $fileName = Str::random(40);
        $filePath = FilePathHelper::getCommercialOfferDocumentQrPath() . '/' . $fileName . '.png';
        Storage::put($filePath, $data);

        $this->addImageMapItem('aboutUsQR', $filePath);
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
}