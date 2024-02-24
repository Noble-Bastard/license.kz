<?php
/**
 * Created by PhpStorm.
 * User: D.Telyuk
 * Date: 1/24/2019
 * Time: 9:34 PM
 */

namespace App\Data\DocumentTemplate;


use App\Data\DocumentTemplate\Dal\DocumentTemplateDal;
use App\Data\DocumentTemplate\Helper\InvoiceReplacementKeyList;
use App\Data\Helper\Assistant;
use App\Data\Helper\DocumentTemplateTypeList;
use App\Data\Helper\FilePathHelper;
use App\Data\Helper\InvoiceTypeList;
use App\Data\Payment\Dal\InvoiceDal;
use App\Data\Payment\Dal\PaymentInvoiceDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use Illuminate\Support\Facades\App;


class  InvoiceDocumentManager extends DocumentManager
{

    protected $serviceJournalId;
    protected $invoiceTypeId;

    function __construct($serviceJournalId, $invoiceType)
    {
        $this->serviceJournalId = $serviceJournalId;
        $this->invoiceTypeId = $invoiceType;

        $serviceJournalExt = ServiceJournalDal::getExt($serviceJournalId);
        $documentTemplate = DocumentTemplateDal::getByCountryAndTemplateType(
            $serviceJournalExt->country_id,
            DocumentTemplateTypeList::InvoiceTemplate
        );

        parent::__construct(
            $documentTemplate,
            new ExcelDocumentTemplateGenerator($documentTemplate->path)
        );
    }

    protected function prepareReplacementMap(): void
    {
        $serviceJournal = ServiceJournalDal::getExt($this->serviceJournalId);
        $numberToWords = new \NumberToWords\NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer(App::getLocale());
        $invoice = InvoiceDal::getByServiceJournal($serviceJournal->id, $this->invoiceTypeId);
        $paymentInvoice = PaymentInvoiceDal::getByServiceJournal($serviceJournal->id, $this->invoiceTypeId);
        $invoiceTypeName = $invoice->invoiceType->name;

        $serviceDescription = 'Оказание юридической услуги - ' . $invoiceTypeName;
        $amount = $paymentInvoice->amount;

        if($this->invoiceTypeId== InvoiceTypeList::PrePayment) {
            $serviceDescription .= ' (' . $serviceJournal->prepayment_percent ?? 0 . '% )';
        }

        $this->addReplacementMapItem(
            InvoiceReplacementKeyList::invoiceNo,
            $invoice->invoice_no
        );
        $this->addReplacementMapItem(
            InvoiceReplacementKeyList::invoiceDate,
            Assistant::formatDate($invoice->invoice_date)
        );
        $this->addReplacementMapItem(
            InvoiceReplacementKeyList::turnoverDate,
            Assistant::formatDate($invoice->turnover_date)
        );
        $this->addReplacementMapItem(
            InvoiceReplacementKeyList::amount,
            $amount
        );
        $this->addReplacementMapItem(
            InvoiceReplacementKeyList::amountText,
            $numberTransformer->toWords($amount)
        );
        $this->addReplacementMapItem(
            InvoiceReplacementKeyList::serviceName,
            $serviceDescription
        );
        $this->addReplacementMapItem(
            InvoiceReplacementKeyList::clientBIN,
            '' //TODO
        );
        $this->addReplacementMapItem(
            InvoiceReplacementKeyList::clientAddress,
            '' //TODO
        );
        $this->addReplacementMapItem(
            InvoiceReplacementKeyList::clientName,
            $serviceJournal->client_full_name
        );
    }

    public function downloadInvoiceExcel()
    {
        $this->checkDocumentAccess();
        $invoice = InvoiceDal::getByServiceJournal($this->serviceJournalId, $this->invoiceTypeId);
        $invoiceDal = new InvoiceDal($this->serviceJournalId, $this->invoiceTypeId);
        $documentPath = $invoiceDal->getExcelDocumentPathByServiceJournal();
        $fileName = $invoice->invoice_no . "."  . FilePathHelper::getFileExtension($documentPath);
        return FilePathHelper::downloadFile($documentPath,$fileName);
    }

    public function downloadInvoicePdf()
    {
        $this->checkDocumentAccess();
        $invoice = invoiceDal::getByServiceJournal($this->serviceJournalId, $this->invoiceTypeId);
        $invoiceDal = new InvoiceDal($this->serviceJournalId, $this->invoiceTypeId);
        $documentPath = $invoiceDal->getPdfDocumentPathByServiceJournal();
        $fileName = $invoice->invoice_no . "." . FilePathHelper::getFileExtension($documentPath);
        return FilePathHelper::downloadFile($documentPath, $fileName);
    }

    protected function prepareImageMap(): void
    {
        // TODO: Implement prepareImageMap() method.
    }

}