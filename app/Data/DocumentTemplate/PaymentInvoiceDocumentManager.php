<?php
/**
 * Created by PhpStorm.
 * User: D.Telyuk
 * Date: 1/24/2019
 * Time: 9:34 PM
 */

namespace App\Data\DocumentTemplate;


use App\Data\DocumentTemplate\Dal\DocumentTemplateDal;
use App\Data\DocumentTemplate\Helper\PaymentInvoiceReplacementKeyList;
use App\Data\Helper\Assistant;
use App\Data\Helper\DocumentTemplateTypeList;
use App\Data\Helper\FilePathHelper;
use App\Data\Helper\InvoiceTypeList;
use App\Data\Payment\Dal\PaymentInvoiceDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use Illuminate\Support\Facades\App;


class  PaymentInvoiceDocumentManager extends DocumentManager
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
            DocumentTemplateTypeList::PaymentInvoiceTemplate
        );

        parent::__construct(
            $documentTemplate,
            new ExcelDocumentTemplateGenerator($documentTemplate->path)
        );
    }

    protected function prepareReplacementMap(): void
    {
        $serviceJournal = ServiceJournalDal::getExt($this->serviceJournalId );
        $numberToWords = new \NumberToWords\NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer(App::getLocale());
        $paymentInvoice = PaymentInvoiceDal::getByServiceJournal($serviceJournal->id, $this->invoiceTypeId);
        $invoiceTypeName = $paymentInvoice->invoiceType->name;

        $serviceDescription = 'Оказание юридической услуги - ' . $invoiceTypeName;
        $amount = $paymentInvoice->amount;

        if($this->invoiceTypeId == InvoiceTypeList::PrePayment) {
            $serviceDescription .= ' (' . $serviceJournal->prepayment_percent ?? 0 . '% )';
        }

        $this->addReplacementMapItem(
            PaymentInvoiceReplacementKeyList::invoiceNo,
            $serviceJournal->service_no
        );
        $this->addReplacementMapItem(
            PaymentInvoiceReplacementKeyList::invoiceDate,
            Assistant::formatDate($serviceJournal->create_date)
        );
        $this->addReplacementMapItem(
            PaymentInvoiceReplacementKeyList::amount,
            $amount
        );
        $this->addReplacementMapItem(
            PaymentInvoiceReplacementKeyList::amountText,
            $numberTransformer->toWords($amount)
        );
        $this->addReplacementMapItem(
            PaymentInvoiceReplacementKeyList::clientName,
            $serviceJournal->client_full_name
        );
        $this->addReplacementMapItem(
            PaymentInvoiceReplacementKeyList::serviceDescription,
            $serviceDescription
        );
        $this->addReplacementMapItem(
            PaymentInvoiceReplacementKeyList::agreementDescription,
            $serviceJournal->agreement_no . ' от ' . Assistant::formatDate($serviceJournal->agreement_date)
        );
    }


    public function downloadPaymentInvoiceExcel()
    {
        $this->checkDocumentAccess();
        $paymentInvoice = PaymentInvoiceDal::getByServiceJournal($this->serviceJournalId, $this->invoiceTypeId);
        $paymentInvoiceDal = new PaymentInvoiceDal($this->serviceJournalId, $this->invoiceTypeId);
        $documentPath = $paymentInvoiceDal->getExcelDocumentPathByServiceJournal();
        $fileName = $paymentInvoice->payment_invoice_no . "."  . FilePathHelper::getFileExtension($documentPath);
        return FilePathHelper::downloadFile($documentPath,$fileName);
    }

    public function downloadPaymentInvoicePdf()
    {
        $this->checkDocumentAccess();
        $paymentInvoice = PaymentInvoiceDal::getByServiceJournal($this->serviceJournalId, $this->invoiceTypeId);
        $paymentInvoiceDal = new PaymentInvoiceDal($this->serviceJournalId, $this->invoiceTypeId);
        $documentPath = $paymentInvoiceDal->getPdfDocumentPathByServiceJournal();
        $fileName = $paymentInvoice->payment_invoice_no . "." . FilePathHelper::getFileExtension($documentPath);
        return FilePathHelper::downloadFile($documentPath, $fileName);
    }

    protected function prepareImageMap(): void
    {
        // TODO: Implement prepareImageMap() method.
    }

}