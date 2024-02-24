<?php

namespace App\Http\Controllers\Accountant;

use App\Data\DocumentTemplate\LibreOfficeToPdfConvertor;
use App\Data\Helper\ServiceStatusList;
use App\Data\Payment\Dal\AgreementDal;
use App\Data\Payment\Dal\InvoiceDal;
use App\Data\Payment\Dal\PaymentInvoiceDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use stdClass;

class AccountantController extends Controller
{
    public function index()
    {
        return view('Accountant.index');
    }

    public function getServiceList()
    {
        $serviceStatuses = ServiceDal::getServiceStatusList();
        $serviceJournalList = ServiceJournalDal::getAccountantServiceJournalList($serviceStatuses[0]->id);

        return view('Accountant.services')
            ->with('serviceJournalList', $serviceJournalList)
            ->with('serviceStatuses', $serviceStatuses);
    }

    public function entityList(){
        $serviceStatusId = Input::get('serviceStatusId');
        $entityData = new stdClass();
        $entityData->serviceJournalList = ServiceJournalDal::getAccountantServiceJournalList($serviceStatusId);

        return response()->json($entityData);
    }

    public function confirmPayment(Request $request)
    {
        $validate = [
            'serviceJournalId' => 'required',
            'invoiceTypeId' => 'required',
            'documentNo' => 'required|string|max:256',
            'documentDate' => 'required'
        ];

        Validator::make($request->all(), $validate)->validate();

        $serviceJournalId = Input::get('serviceJournalId');
        $invoiceTypeId = Input::get('invoiceTypeId');
        $documentDate = Input::get('documentDate');
        $documentNo = Input::get('documentNo');
        PaymentInvoiceDal::setPaymentInvoicePaidStatus($serviceJournalId, $invoiceTypeId, $documentDate, $documentNo);

        $entityData = new stdClass();
        $entityData->serviceJournalId = $serviceJournalId;
        $entityData->invoiceTypeId = $invoiceTypeId;
        return response()->json($entityData);
    }

    public function generateDocuments()
    {
        $this->generateClientCheckDocuments();
        $this->generatePrepaymentDocuments();
        $this->generateFinalPaymentDocuments();
        $entityData = new stdClass();
        $entityData->status = 'OK';
        return response()->json($entityData);
    }

    function generateClientCheckDocuments()
    {
        AgreementDal::generateNewDocumentsTask(ServiceStatusList::ClientCheck);
        PaymentInvoiceDal::generateNewDocumentsTask(ServiceStatusList::ClientCheck);
        InvoiceDal::generateNewDocumentsTask(ServiceStatusList::ClientCheck);
    }

    function generatePrepaymentDocuments()
    {
        AgreementDal::generateNewDocumentsTask(ServiceStatusList::Prepayment);
        PaymentInvoiceDal::generateNewDocumentsTask(ServiceStatusList::Prepayment);
        InvoiceDal::generateNewDocumentsTask(ServiceStatusList::Prepayment);
    }

    function generateFinalPaymentDocuments()
    {
        PaymentInvoiceDal::generateNewDocumentsTask(ServiceStatusList::Payment);
        InvoiceDal::generateNewDocumentsTask(ServiceStatusList::Payment);
    }

    public function convertToPdf(){

        (new LibreOfficeToPdfConvertor('ServiceJournal/22/accountant_docs/dnHOrVmp0R8OThnXxDHtTKljpNkDBFTF33VNzW0Q_5e915fee35b03.docx'))->convert();
        //(new LibreOfficeToPdfConvertor('public/123.docx'))->convert();
    }

}
