<?php

namespace App\Http\Controllers\Accountant;

use App\Data\DocumentTemplate\Dal\DocumentTemplateDal;
use App\Data\DocumentTemplate\Dal\DocumentTemplateTypeDal;
use App\Data\DocumentTemplate\LibreOfficeToPdfConvertor;
use App\Data\DocumentTemplate\Model\DocumentTemplate;
use App\Data\Helper\FilePathHelper;
use App\Data\Helper\ServiceStatusList;
use App\Data\Payment\Dal\AgreementDal;
use App\Data\Payment\Dal\InvoiceDal;
use App\Data\Payment\Dal\PaymentInvoiceDal;
use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        
        // Use the first available status, or default to a specific status if none available
        $defaultStatusId = $serviceStatuses->isNotEmpty() ? $serviceStatuses->first()->id : 1; // Default to Creation status
        $serviceJournalList = ServiceJournalDal::getAccountantServiceJournalList($defaultStatusId);

        return view('Accountant.services')
            ->with('serviceJournalList', $serviceJournalList)
            ->with('serviceStatuses', $serviceStatuses);
    }

    public function entityList(){
        $serviceStatusId = Input::get('serviceStatusId');
        $entityData = new stdClass();
        $serviceJournalList = ServiceJournalDal::getAccountantServiceJournalList($serviceStatusId);
        
        $entityData->serviceJournalList = $serviceJournalList;

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

    public function documentTemplates(Request $request)
    {
        $countries = CountryDal::getList(false);
        $selectedCountryId = $request->get('country_id');

        if (empty($selectedCountryId) && count($countries) > 0) {
            $selectedCountryId = $countries[0]->id;
        }

        $documentTypes = DocumentTemplateTypeDal::getList();
        $templates = !empty($selectedCountryId)
            ? DocumentTemplateDal::getListByCountry($selectedCountryId)
            : [];

        $selectedCountry = null;
        foreach ($countries as $country) {
            if ((string)$country->id === (string)$selectedCountryId) {
                $selectedCountry = $country;
                break;
            }
        }

        return view('Accountant.document_templates')
            ->with('countries', $countries)
            ->with('selectedCountry', $selectedCountry)
            ->with('documentTypes', $documentTypes)
            ->with('templates', $templates);
    }

    public function documentTemplateList()
    {
        $countryId = Input::get('countryId');
        $documentTemplateList = DocumentTemplateDal::getListByCountry($countryId);
        return response()->json($documentTemplateList);
    }

    public function uploadDocument(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_id' => 'required',
            'document_template_type_id' => 'required',
            'document_name' => 'nullable|string|max:255',
            'file' => 'required|mimes:doc,docx,xls,xlsx'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $countryId = $request->input('country_id');
        $documentTemplateTypeId = $request->input('document_template_type_id');
        $documentName = $request->input('document_name');
        $file = $request->file('file');
        
        // Use provided name or fallback to filename
        $fileName = $documentName ? $documentName : pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        
        // Check if template already exists for this country and type
        $curEntity = DocumentTemplateDal::getByCountryAndTemplateType($countryId, $documentTemplateTypeId);
        if (!is_null($curEntity) && !is_null($curEntity->path)) {
            Storage::delete($curEntity->path);
        }
        
        $path = $file->store(FilePathHelper::getCompanyDocumentTemplatePath());
        $entity = new DocumentTemplate();
        $entity->name = $fileName;
        $entity->path = $path;
        $entity->country_id = $countryId;
        $entity->document_template_type_id = $documentTemplateTypeId;
        $entity = DocumentTemplateDal::set($entity);

        return response()->json([
            'success' => true,
            'message' => 'Документ успешно загружен',
            'data' => $entity
        ]);
    }

    public function downloadDocument()
    {
        $documentTemplateId = Input::get('entityId');
        $documentTemplate = DocumentTemplateDal::get($documentTemplateId);
        return FilePathHelper::downloadFile($documentTemplate->path, $documentTemplate->name);
    }
}
