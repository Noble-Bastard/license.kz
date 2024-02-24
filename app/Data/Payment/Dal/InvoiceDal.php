<?php

namespace App\Data\Payment\Dal;

use App\Data\Core\Dal\CounterDal;
use App\Data\Core\Dal\SettingDal;
use App\Data\Document\Dal\DocumentDal;
use App\Data\Document\Model\Document;
use App\Data\DocumentTemplate\InvoiceDocumentManager;
use App\Data\Helper\Assistant;
use App\Data\Helper\DocumentTypeList;
use App\Data\Helper\ServiceStatusList;
use App\Data\Payment\Model\Invoice;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\ServiceJournal\Model\ServiceJournal;
use Illuminate\Database\Eloquent\Model;


class InvoiceDal extends AccountantDocumentDal
{
    public function __construct($serviceJournalId, $invoiceTypeId)
    {
        parent::__construct(
            new InvoiceDocumentManager($serviceJournalId, $invoiceTypeId),
            $serviceJournalId,
            $invoiceTypeId
        );
    }

    public static function get($entityId)
    {
        $entity = Invoice::where('id', $entityId)->first();
        return $entity;
    }

    public static function getByServiceJournal($serviceJournalId, $invoiceTypeId): ?Model
    {
        $entity = Invoice::where('service_journal_id', $serviceJournalId)
            ->where('invoice_type_id', $invoiceTypeId)
            ->first();
        return $entity;
    }

    public static function getListByServiceJournal($serviceJournalId)
    {
        $entityList = Invoice::where('service_journal_id', $serviceJournalId)
            ->with('invoiceType')
            ->with('invoiceDocuments')
            ->get();
        return $entityList;
    }


    function getDocumentListByServiceJournal()
    {
        return InvoiceDocumentDal::getListByServiceJournal(
            $this->serviceJournalId,
            $this->documentSubTypeId
        );
    }

    function newAccountantDocument(): Model
    {
        $serviceJournal = ServiceJournalDal::getExt($this->serviceJournalId);
        $invoice = new Invoice();
        $invoice->create_date = Assistant::getCurrentDate();
        $invoice->invoice_date = Assistant::getCurrentDate();
        $invoice->turnover_date = Assistant::getCurrentDate();
        $invoice->invoice_no = CounterDal::getCounterValue(SettingDal::getInvoiceCounterType(), $serviceJournal->country_id);
        $invoice->service_journal_id = $this->serviceJournalId;
        $invoice->invoice_type_id = $this->documentSubTypeId;
        $invoice->save();

        return self::get($invoice->id);
    }

    function insertAccountantDocument($model, $documentFileName): void
    {
        $document = new Document();
        $document->document_type_id = DocumentTypeList::Invoice;
        $document->name = $model->invoice_no;
        $document->path = $documentFileName;
        $originalInvoiceDocument = DocumentDal::set($document);
        InvoiceDocumentDal::insert($model->id, $originalInvoiceDocument->id);
    }


    function sendAccountDocumentNotification($accountDocumentId)
    {
        return;
    }

    public static function generateNewDocumentsTask($serviceStatusId)
    {
        $invoiceTypeId = self::getInvoiceTypeByServiceStatus($serviceStatusId);
        if($invoiceTypeId == 0)
            return;

        $statusOrder = self::getServiceStatusOrder($serviceStatusId);
        $serviceJournalListForDocumentGen = self::getServiceJournalListForNewDocumentGen($statusOrder, $invoiceTypeId);
        foreach ($serviceJournalListForDocumentGen as $serviceJournal) {
            $invoiceDal = new InvoiceDal($serviceJournal->id, $invoiceTypeId);
            $invoiceDal->generate();
        }
    }

    public static function getServiceJournalListForNewDocumentGen($statusOrder, $invoiceTypeId)
    {
        $serviceJournalListForDocumentGen = ServiceJournal::from('service_journal as sj')
            ->leftJoin('invoice as pi', function ($join) use($invoiceTypeId) {
                $join->on('pi.service_journal_id', 'sj.id')
                    ->where('pi.invoice_type_id', $invoiceTypeId);
            })
            ->join('service_status as ss', function ($join) {
                $join->on('ss.id', 'sj.service_status_id');
            })
            ->whereNull('pi.id')
            ->where('ss.status_order', '>=', $statusOrder)
            ->where('ss.id', '!=', ServiceStatusList::Rejected)
            ->get('sj.*');
        return $serviceJournalListForDocumentGen;
    }
}
