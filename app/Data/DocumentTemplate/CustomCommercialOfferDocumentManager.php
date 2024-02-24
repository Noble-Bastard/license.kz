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
use App\Data\Helper\CountryList;
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
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

class CustomCommercialOfferDocumentManager extends DocumentManager
{
    protected $customService;

    /**
     * CommercialOfferDocumentManager constructor.
     * @param $customService
     */
    public function __construct($customService)
    {
        $this->customService = $customService;

        $documentTemplate = DocumentTemplateDal::getByCountryAndTemplateType(
            CountryList::KAZ,
            DocumentTemplateTypeList::CommercialOfferTemplate
        );

        parent::__construct(
            $documentTemplate,
            new WordDocumentTemplateGenerator($documentTemplate->path)
        );
    }

    protected function prepareReplacementMap(): void
    {
        $this->addReplacementMapItem(
            CommercialOfferKeyList::createDate,
            now()->format('d.m.Y')
        );
        $this->addReplacementMapItem(
            CommercialOfferKeyList::licenseName,
            $this->customService->licenseName
        );
        $this->addReplacementMapItem(
            CommercialOfferKeyList::licenseName2,
            $this->customService->licenseName
        );

        $boldStyle = array('name' => 'Lato', 'size' => 10, 'bold' => true, 'color' => '007033');
        $normalStyle = array('name' => 'Lato', 'size' => 10, 'bold' => false);
        $evenRowStyle = array('bgColor' => 'ffffff');
        $oddRowStyle = array('bgColor' => 'ffffff');

        $serviceStepTable = new Table(array(
            'borderColor' => 'ffffff',
            'width' => 80 * 50,
            'cellMargin' => 40,
            'unit' => \PhpOffice\PhpWord\SimpleType\TblWidth::PERCENT,
            'align' => 'center'
        ));

        if($this->customService->serviceList) {
            $i = 0;
            foreach ($this->customService->serviceList as $service) {
                $serviceStepTable->addRow();
                if ($i == 0) {
                    $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('Выбранные подвиды', $boldStyle);
                } else {
                    $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('', $boldStyle);
                }
                $serviceStepTable->addCell(60 * 50, $evenRowStyle)->addText(trim($service), $normalStyle);
                $i++;
            }
            $serviceStepTable->addRow();
            $cell = $serviceStepTable->addCell();
            $cell->getStyle()->setGridSpan(2);
            $cell->addText('', [], ['borderBottomSize' => 6]);
        }

        if ($this->customService->executive_agency) {
            $serviceStepTable->addRow();
            $serviceStepTable->addCell(40 * 50, $oddRowStyle)->addText('Уполномоченный орган', $boldStyle);
            $serviceStepTable->addCell(60 * 50, $oddRowStyle)->addText($this->customService->executive_agency, $normalStyle);
        }
        if ($this->customService->tax) {
            $serviceStepTable->addRow();
            $serviceStepTable->addCell(40 * 50, $oddRowStyle)->addText('Стоимость государственной пошлины', $boldStyle);
            $serviceStepTable->addCell(60 * 50, $oddRowStyle)->addText($this->customService->tax . ' МРП', $normalStyle);
        }
        if ($this->customService->executionWorkDay) {
            $serviceStepTable->addRow();
            $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('Срок оказания услуги', $boldStyle);
            $serviceStepTable->addCell(60 * 50, $evenRowStyle)->addText($this->customService->executionWorkDay . ' ' . \App\Data\Helper\Assistant::num2word($this->customService->executionWorkDay, trans('messages.services.one_work_day'), trans('messages.services.two_work_days'), trans('messages.services.work_days')), $normalStyle);
        }
        if ($this->customService->executive_agency || $this->customService->tax || $this->customService->executionWorkDay) {
            $serviceStepTable->addRow();
            $cell = $serviceStepTable->addCell();
            $cell->getStyle()->setGridSpan(2);
            $cell->addText('', [], ['borderBottomSize' => 6]);
        }

        if($this->customService->serviceAdditionalRequirements) {
            $i = 0;
            foreach ($this->customService->serviceAdditionalRequirements as $valueList) {
//                $serviceAdditionalRequirements = '';
//                $serviceAdditionalRequirements .= $type . ": ";
//                $numItems = count($valueList);
//                $j = 0;
//                foreach ($valueList->sortBy('description') as $value) {
//                    $serviceAdditionalRequirements .= $value->description . (++$j === $numItems ? '' : ', ');
//                }

                $serviceStepTable->addRow();
                if ($i == 0) {
                    $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('Дополнительные требования', $boldStyle);
                } else {
                    $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('', $boldStyle);
                }
                $serviceStepTable->addCell(60 * 50, $evenRowStyle)->addText(trim($valueList), $normalStyle);
                $i++;
            }

            $serviceStepTable->addRow();
            $cell = $serviceStepTable->addCell();
            $cell->getStyle()->setGridSpan(2);
            $cell->addText('', [], ['borderBottomSize' => 6]);
        }

        if($this->customService->serviceRequiredDocument) {
            $i = 0;
            foreach ($this->customService->serviceRequiredDocument as $curStepRequiredDocument) {
                if (trim($curStepRequiredDocument)) {
                    $serviceStepTable->addRow();
                    if ($i == 0) {
                        $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('Необходимые документы для получения лицензии', $boldStyle);
                    } else {
                        $serviceStepTable->addCell(40 * 50, $evenRowStyle)->addText('', $boldStyle);
                    }
                    $serviceStepTable->addCell(60 * 50, $evenRowStyle)->addText(trim($curStepRequiredDocument), $normalStyle);
                    $i++;
                }
            }

            $serviceStepTable->addRow();
            $cell = $serviceStepTable->addCell();
            $cell->getStyle()->setGridSpan(2);
            $cell->addText('', [], ['borderBottomSize' => 6]);
        }

        $serviceStepTable->addRow();
        $cell = $serviceStepTable->addCell();
        $cell->getStyle()->setGridSpan(2);
        $cell->addText('Стоимость услуги ' . number_format($this->customService->cost, 0, ',', ' ') . ' тг', $boldStyle, ['align' => 'right']);

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

    protected function prepareImageMap(): void {
        $qrCode = new QrCode(route('new-about'));
        $output = new Output\Png();

        $data = $output->output($qrCode, 100, [255, 255, 255], [0, 0, 0], 0);
        $fileName = Str::random(40);
        $filePath = FilePathHelper::getCommercialOfferDocumentQrPath() . '/' . $fileName . '.png';
        Storage::put($filePath, $data);

        $this->addImageMapItem('aboutUsQR', $filePath);
    }
}