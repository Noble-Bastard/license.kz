<?php
/**
 * Created by PhpStorm.
 * User: D.Telyuk
 * Date: 1/24/2019
 * Time: 9:34 PM
 */

namespace App\Data\DocumentTemplate;


use App\Data\Core\Dal\SettingDal;
use App\Data\DocumentTemplate\Dal\DocumentTemplateDal;
use App\Data\DocumentTemplate\Helper\AgreementReplacementKeyList;
use App\Data\Helper\AgreementTypeList;
use App\Data\Helper\Assistant;
use App\Data\Helper\DocumentTemplateTypeList;
use App\Data\Helper\FilePathHelper;
use App\Data\Payment\Dal\AgreementDal;
use App\Data\Service\Dal\ServiceStepRequiredDocumentDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\ServiceJournal\Dal\ServiceJournalProfileLegalDal;
use App\Data\ServiceJournal\Dal\ServiceJournalServiceMapDal;
use Illuminate\Support\Facades\App;

class  AgreementDocumentManager extends DocumentManager
{
    protected $agreementTypeId;

    function __construct($serviceJournalId, $agreementTypeId)
    {
        $this->serviceJournalId = $serviceJournalId;
        $this->agreementTypeId = $agreementTypeId;
        $serviceJournalExt = ServiceJournalDal::getExt($serviceJournalId);
        $documentTemplate = DocumentTemplateDal::getByCountryAndTemplateType(
            $serviceJournalExt->country_id,
            $agreementTypeId == AgreementTypeList::ClientCheck ?
                DocumentTemplateTypeList::ClientCheckAgreementTemplate : DocumentTemplateTypeList::AgreementTemplate
        );

        parent::__construct(
            $documentTemplate,
            new WordDocumentTemplateGenerator($documentTemplate->path)
        );
    }

    protected function prepareReplacementMap(): void
    {
        $agreement = AgreementDal::getByServiceJournal(
            $this->serviceJournalId,
            $this->agreementTypeId
        );

        $serviceJournal = ServiceJournalDal::get($this->serviceJournalId);
        $serviceJournalProfileLegal = (new ServiceJournalProfileLegalDal())->getByServiceJournalId($this->serviceJournalId);
        $serviceJournalStepExtList =  ServiceJournalDal::getServiceJournalStepList($this->serviceJournalId);

        $this->addReplacementMapItem(
            AgreementReplacementKeyList::agreementNo,
            $agreement->agreement_no
        );
        $this->addReplacementMapItem(
            AgreementReplacementKeyList::agreementDate,
            Assistant::formatDate($agreement->agreement_date)
        );

        $this->addReplacementMapItem(
            AgreementReplacementKeyList::licenseTypeName,
            $serviceJournal->licenseType->name
        );

        if($serviceJournalProfileLegal) {

            $this->addReplacementMapItem(
                AgreementReplacementKeyList::clientCompanyName,
                $serviceJournalProfileLegal->company_name
            );

            $this->addReplacementMapItem(
                AgreementReplacementKeyList::clientDirectorName,
                $serviceJournalProfileLegal->director_name
            );

            $this->addReplacementMapItem(
                AgreementReplacementKeyList::clientBIN,
                $serviceJournalProfileLegal->business_identification_number
            );

            $this->addReplacementMapItem(
                AgreementReplacementKeyList::clientBankCodeType,
                $serviceJournalProfileLegal->bankCodeType->name
            );

            $this->addReplacementMapItem(
                AgreementReplacementKeyList::clientBankCode,
                $serviceJournalProfileLegal->bank_code
            );

            $this->addReplacementMapItem(
                AgreementReplacementKeyList::clientLegalAddress,
                $serviceJournalProfileLegal->legal_address
            );
        }

        $services = (new ServiceJournalServiceMapDal())->getListByServiceJournalId($this->serviceJournalId);
        $this->addReplacementMapItem(
            AgreementReplacementKeyList::serviceDescription,
            $this->prepareStringValue($services->implode("service.name", "<w:br/>"))
        );

        $numberToWords = new \NumberToWords\NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer(App::getLocale());

        if($this->agreementTypeId == AgreementTypeList::FullPayment) {
            $cost = $serviceJournal->serviceJournalPayment->amount
                + $serviceJournal->serviceJournalPayment->tax;
            $cost -= $cost * $serviceJournal->prepayment_percent;
        } else {
            $cost = SettingDal::getClientCheckCost();
        }

        $this->addReplacementMapItem(
            AgreementReplacementKeyList::serviceCost,
            $cost);

        $this->addReplacementMapItem(
            AgreementReplacementKeyList::serviceCostWords,
            $numberTransformer->toWords($cost)
        );

        $workDaysCnt = 0;
        if($this->agreementTypeId == AgreementTypeList::FullPayment) {
            $workDaysCnt = $serviceJournalStepExtList->sum('execution_work_day_cnt');
        } else {
            //todo add logic for client check days count
            $workDaysCnt = 1;
        }

        $this->addReplacementMapItem(
            AgreementReplacementKeyList::serviceExecutionWorkDaysCnt,
            $workDaysCnt
        );

        if($this->agreementTypeId == AgreementTypeList::FullPayment) {
            $requiredDocuments = (new ServiceStepRequiredDocumentDal())->getByServiceJournal($this->serviceJournalId);
            $requirementDocumentsString = "";
            foreach ($requiredDocuments as $key => $requiredDocument)
                $requirementDocumentsString .= ++$key . ". " . $this->prepareStringValue(trim($requiredDocument->description)) . "<w:br/>";

            $this->addReplacementMapItem(
                AgreementReplacementKeyList::serviceRequiredDocuments,
                $requirementDocumentsString
            );
        }

    }

    public function downloadAgreementWord()
    {
        $this->checkDocumentAccess();
        $agreement = AgreementDal::getByServiceJournal($this->serviceJournalId, $this->agreementTypeId);
        $agreementDal = new AgreementDal($this->serviceJournalId, $this->agreementTypeId);
        $agreementDocumentPath = $agreementDal->getWordDocumentPathByServiceJournal();
        $agreementFileName = $agreement->agreement_no . "."  . FilePathHelper::getFileExtension($agreementDocumentPath);
        return FilePathHelper::downloadFile($agreementDocumentPath,$agreementFileName);
    }

    public function downloadAgreementPdf()
    {
        $this->checkDocumentAccess();
        $agreement = AgreementDal::getByServiceJournal($this->serviceJournalId,$this->agreementTypeId);
        $agreementDal = new AgreementDal($this->serviceJournalId, $this->agreementTypeId);
        $agreementDocumentPath = $agreementDal->getPdfDocumentPathByServiceJournal();
        $agreementFileName = $agreement->agreement_no . "." . FilePathHelper::getFileExtension($agreementDocumentPath);
        return FilePathHelper::downloadFile($agreementDocumentPath, $agreementFileName);
    }

    protected function prepareStringValue($serviceDescription)
    {
        $serviceDescription = strip_tags($serviceDescription); //"<p><strong>"
        $serviceDescription = str_replace("\n", "<w:br/>", $serviceDescription);
        $serviceDescription = str_replace("&nbsp;", "<w:br/>", $serviceDescription);
        $serviceDescription = str_replace("\r", "", $serviceDescription);
        $serviceDescription = str_replace("\t", "", $serviceDescription);
        $serviceDescription = trim($serviceDescription);
        return $serviceDescription;
    }

    protected function prepareImageMap(): void
    {
        // TODO: Implement prepareImageMap() method.
    }


}