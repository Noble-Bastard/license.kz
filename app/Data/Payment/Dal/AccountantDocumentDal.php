<?php

namespace App\Data\Payment\Dal;


use App\Data\Core\Dal\ProfileDal;
use App\Data\DocumentTemplate\PdfConvertorManager;
use App\Data\Helper\AgreementTypeList;
use App\Data\Helper\ExtensionTypeList;
use App\Data\Helper\FilePathHelper;
use App\Data\Helper\InvoiceTypeList;
use App\Data\Helper\ServiceStatusList;
use App\Data\Service\Model\ServiceStatus;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

abstract class AccountantDocumentDal
{
    private $documentManager;
    protected $serviceJournalId;
    protected $documentSubTypeId;

    public function __construct($documentManager, $serviceJournalId, $documentSubTypeId)
    {
        $this->documentManager = $documentManager;
        $this->serviceJournalId = $serviceJournalId;
        $this->documentSubTypeId = $documentSubTypeId;
    }

    abstract static function get($entityId);

    abstract static function getByServiceJournal($serviceJournalId, $invoiceTypeId): ?Model;
    abstract static function getListByServiceJournal($serviceJournalId);

    abstract function getDocumentListByServiceJournal();

    abstract function newAccountantDocument(): Model;

    abstract function insertAccountantDocument($model, $documentFileName): void;

    abstract function sendAccountDocumentNotification($accountDocumentId);

    abstract static function generateNewDocumentsTask($serviceStatusId);

    public function getByClientServiceJournal(): ?Model
    {
        $serviceJournal = ServiceJournalDal::getExt($this->serviceJournalId);
        $profile = ProfileDal::getByUserId(Auth::id());
        if($profile->id != $serviceJournal->client_id)
            return null;
        $entity = $this->getByServiceJournal($this->serviceJournalId, $this->documentSubTypeId);
        return $entity;
    }

    public function getWordDocumentPathByServiceJournal(): ?string
    {
        $documentList = $this->getDocumentListByServiceJournal();
        foreach ($documentList as $item) {
            if (strpos($item->path, "." . ExtensionTypeList::DOC) !== false
                || strpos($item->path , "." . ExtensionTypeList::DOCX) !== false)
            {
                return $item->path;
            }
        }
        return null;
    }

    public function getExcelDocumentPathByServiceJournal(): ?string
    {
        $documentList = $this->getDocumentListByServiceJournal();
        foreach ($documentList as $item) {
            if (strpos($item->path, "." . ExtensionTypeList::XLS) !== false
                || strpos($item->path , "." . ExtensionTypeList::XLSX) !== false)
            {
                return $item->path;
            }
        }
        return null;
    }

    public function getPdfDocumentPathByServiceJournal(): ?string
    {
        $documentList = $this->getDocumentListByServiceJournal();
        foreach ($documentList as $item) {
            if (strpos($item->path, ExtensionTypeList::PDF) !== false)
            {
                return $item->path;
            }
        }
        return null;
    }

    public function getPdfDocumentPathByClientServiceJournal(): ?string
    {
        $documentList = $this->getDocumentListByServiceJournal();
        foreach ($documentList as $item) {
            if (strpos($item->path, ExtensionTypeList::PDF) !== false)
            {
                return $item->path;
            }
        }
        return null;
    }

    public function generate(): Model
    {
        $currentActiveAccountantDocument = $this->getByServiceJournal(
            $this->serviceJournalId,
            $this->documentSubTypeId
        );

        try {
            $accountantDocument = is_null($currentActiveAccountantDocument) ? $this->newAccountantDocument() : $currentActiveAccountantDocument;

            $documentFileName = $this->generateDocument();
            $documentPdfFileName = $this->convertDocumentToPdf($documentFileName);

            DB::beginTransaction();
            $this->insertAccountantDocument($accountantDocument, $documentFileName);
            $this->insertAccountantDocument($accountantDocument, $documentPdfFileName);
            DB::commit();
            $this->sendAccountDocumentNotification($accountantDocument->id);
            return $this->get($accountantDocument->id);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    private function generateDocument(): string
    {
        $tempDocumentFileName = $this->documentManager->getDocument();

        $documentFileName = FilePathHelper::getServiceJournalAccountantDocumentPath($this->serviceJournalId) .
            '/' . FilePathHelper::getFileBaseName($tempDocumentFileName);
        Storage::move($tempDocumentFileName, $documentFileName);
        return $documentFileName;
    }

    private function convertDocumentToPdf($documentFileName): String
    {
        $pdfConvertorManager = PdfConvertorManager::getConvertor($documentFileName);
        $agreementDocumentPdfFileName = $pdfConvertorManager->convert();
        return $agreementDocumentPdfFileName;
    }

    public static function getInvoiceTypeByServiceStatus($serviceStatusId): int
    {
        $invoiceTypeId = 0;
        switch ($serviceStatusId) {
            case ServiceStatusList::ClientCheck:
                $invoiceTypeId = InvoiceTypeList::ClientCheck;
                break;
            case ServiceStatusList::Prepayment:
                $invoiceTypeId = InvoiceTypeList::PrePayment;
                break;
            case ServiceStatusList::Payment:
                $invoiceTypeId = InvoiceTypeList::FullPayment;
                break;
        }
        return $invoiceTypeId;
    }

    public static function getAgreementTypeByServiceStatus($serviceStatusId): int
    {
        $agreementTypeId = 0;
        switch ($serviceStatusId) {
            case ServiceStatusList::ClientCheck:
                $agreementTypeId = AgreementTypeList::ClientCheck;
                break;
            case ServiceStatusList::Prepayment:
                $agreementTypeId = AgreementTypeList::FullPayment;
                break;
        }
        return $agreementTypeId;
    }

    public static function getServiceStatusOrder($serviceStatusId)
    {
        return ServiceStatus::where('id', $serviceStatusId)
            ->first()
            ->status_order;
    }

}
