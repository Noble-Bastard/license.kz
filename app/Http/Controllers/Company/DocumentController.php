<?php

namespace App\Http\Controllers\Company;


use App\Data\DocumentTemplate\AgreementDocumentManager;
use App\Data\DocumentTemplate\InvoiceDocumentManager;
use App\Data\DocumentTemplate\PaymentInvoiceDocumentManager;
use App\Data\Helper\RoleList;
use App\Data\Payment\Dal\AgreementDal;
use App\Data\Payment\Dal\InvoiceDal;
use App\Data\Payment\Dal\PaymentInvoiceDal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use stdClass;

class DocumentController extends Controller
{

    public function documentList(){
        $serviceJournalId = Input::get('serviceJournalId');

        //todo add client check filtering if user in role client

        $paymentInvoices = PaymentInvoiceDal::getListByServiceJournal($serviceJournalId);
        $invoices = InvoiceDal::getListByServiceJournal($serviceJournalId);
        $agreements = AgreementDal::getListByServiceJournal($serviceJournalId);

        $documents = [];
        $this->getPaymentInvoiceDocuments($paymentInvoices, $documents);
        $this->getInvoiceDocuments($invoices, $documents);
        $this->getAgreementDocuments($agreements, $documents);

        $entityData = new stdClass();
        $entityData->serviceJournalDocuments = $documents;

        return response()->json($entityData);
    }


    private function getPaymentInvoiceDocuments($paymentInvoices, &$documents)
    {
        if($paymentInvoices->IsEmpty())
            return;

        foreach ($paymentInvoices as $paymentInvoice) {
            $document = new StdClass;
            $document->document_no = $paymentInvoice->payment_invoice_no;
            $document->document_date = $paymentInvoice->payment_invoice_date;
            $document->document_sub_type_id = $paymentInvoice->invoiceType->id;
            $document->document_sub_type_name = $paymentInvoice->invoiceType->name;
            $document->document_type_id = $paymentInvoice->paymentInvoiceDocuments[0]
                ->document->documentType->id;
            $document->document_type_name = $paymentInvoice->paymentInvoiceDocuments[0]
                ->document->documentType->name;
            array_push($documents, $document);
        }
    }

    private function getInvoiceDocuments($invoices, &$documents)
    {
        if($invoices->IsEmpty())
            return;

        foreach ($invoices as $invoice) {
            $document = new StdClass;
            $document->document_no = $invoice->invoice_no;
            $document->document_date = $invoice->invoice_date;
            $document->document_sub_type_id = $invoice->invoiceType->id;
            $document->document_sub_type_name = $invoice->invoiceType->name;
            $document->document_type_id = $invoice->invoiceDocuments[0]
                ->document->documentType->id;
            $document->document_type_name = $invoice->invoiceDocuments[0]
                ->document->documentType->name;
            array_push($documents, $document);
        }
    }

    private function getAgreementDocuments($agreements, &$documents)
    {
        if($agreements->IsEmpty())
            return;

        foreach ($agreements as $agreement) {
            $document = new StdClass;
            $document->document_no = $agreement->agreement_no;
            $document->document_date = $agreement->agreement_date;
            $document->document_sub_type_id = $agreement->agreementType->id;
            $document->document_sub_type_name = $agreement->agreementType->name;
            $document->document_type_id = $agreement->agreementDocuments[0]
                ->document->documentType->id;
            $document->document_type_name = $agreement->agreementDocuments[0]
                ->document->documentType->name;
            array_push($documents, $document);
        }
    }


    public function download() {
        $serviceJournalId = Input::get('serviceJournalId');
        $documentTypeId = Input::get('documentTypeId');
        $documentSubTypeId = Input::get('documentSubTypeId');
        $isCopy = Auth::user()->isUserInRole(RoleList::Client) ? 1 : Input::get('isCopy');

        $cnstPaymentInvoice = 4;
        $cnstInvoice = 6;
        $cnstAgreement = 5;
        $cnstClientCheckAgreement = 7;

        switch ($documentTypeId) {
            case $cnstPaymentInvoice:
                return $isCopy == 0 ?
                    (new PaymentInvoiceDocumentManager($serviceJournalId, $documentSubTypeId))->downloadPaymentInvoiceExcel()
                    : (new PaymentInvoiceDocumentManager($serviceJournalId, $documentSubTypeId))->downloadPaymentInvoicePdf();
                break;
            case $cnstInvoice:
                return $isCopy == 0 ?
                    (new InvoiceDocumentManager($serviceJournalId, $documentSubTypeId))->downloadInvoiceExcel()
                    : (new InvoiceDocumentManager($serviceJournalId, $documentSubTypeId))->downloadInvoicePdf();
                break;
            case $cnstAgreement:
            case $cnstClientCheckAgreement:
                return $isCopy == 0 ?
                    (new AgreementDocumentManager($serviceJournalId, $documentSubTypeId))->downloadAgreementWord()
                    : (new AgreementDocumentManager($serviceJournalId, $documentSubTypeId))->downloadAgreementPdf();
                break;
        }

    }







}
