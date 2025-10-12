<?php

namespace App\Http\Controllers;


use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Dal\SettingDal;
use App\Data\Document\Dal\ProfileDocumentDal;
use App\Data\Helper\FilePathHelper;
use App\Data\Helper\ServiceStatusTypeList;
use App\Data\Notify\Dal\MessagesDal;
use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Dal\ServiceStepRequiredDocumentDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\ServiceJournal\Dal\ServiceJournalMessageDal;
use App\Data\ServiceJournal\Model\ServiceJournal;
use App\Data\Payment\Model\Agreement;
use App\Data\Payment\Model\Invoice;
use App\Data\Payment\Model\PaymentInvoice;
use App\Data\Document\Model\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use stdClass;

class ClientController extends Controller
{

    public function getAccounting()
    {
        $serviceStatuses = ServiceDal::getServiceStatusList();
        $serviceJournalList = ServiceJournalDal::getClientServiceJournalList($serviceStatuses[0]->id);
        return view('Client.accounting')
            ->with('serviceJournalList', $serviceJournalList)
            ->with('serviceStatuses', $serviceStatuses);
    }

    public function downloadInvoicePdf()
    {
        $documentId = Input::get('document_id');

        // Получаем услуги текущего пользователя
        $userServices = ServiceJournalDal::getServiceJournalListByCurrentUser(null, false);

        if ($userServices->isEmpty()) {
            return response()->json(['error' => 'Услуги не найдены'], 404);
        }

        $serviceIds = $userServices->pluck('id')->toArray();

        // Ищем счет-фактуру по номеру только для услуг текущего пользователя
        $invoice = Invoice::where('invoice_no', $documentId)
            ->whereIn('service_journal_id', $serviceIds)
            ->first();

        if ($invoice && $invoice->actualDocuments) {
            foreach ($invoice->actualDocuments as $actualDocument) {
                if ($actualDocument->documentPDF) {
                    $filePath = $actualDocument->documentPDF->path;
                    $fileName = $invoice->invoice_no . '.pdf';

                    if (Storage::exists($filePath)) {
                        return response()->download(storage_path('app/' . $filePath), $fileName);
                    }
                }
            }
        }

        return response()->json(['error' => 'Документ не найден'], 404);
    }

    public function downloadPaymentInvoicePdf()
    {
        $documentId = Input::get('document_id');

        // Получаем услуги текущего пользователя
        $userServices = ServiceJournalDal::getServiceJournalListByCurrentUser(null, false);

        if ($userServices->isEmpty()) {
            return response()->json(['error' => 'Услуги не найдены'], 404);
        }

        $serviceIds = $userServices->pluck('id')->toArray();

        // Ищем счет на оплату по номеру только для услуг текущего пользователя
        $paymentInvoice = PaymentInvoice::where('payment_invoice_no', $documentId)
            ->whereIn('service_journal_id', $serviceIds)
            ->first();

        if ($paymentInvoice && $paymentInvoice->actualDocuments) {
            foreach ($paymentInvoice->actualDocuments as $actualDocument) {
                if ($actualDocument->documentPDF) {
                    $filePath = $actualDocument->documentPDF->path;
                    $fileName = $paymentInvoice->payment_invoice_no . '.pdf';

                    if (Storage::exists($filePath)) {
                        return response()->download(storage_path('app/' . $filePath), $fileName);
                    }
                }
            }
        }

        return response()->json(['error' => 'Документ не найден'], 404);
    }

    public function downloadAgreementPdf()
    {
        $documentId = Input::get('document_id');

        // Получаем услуги текущего пользователя
        $userServices = ServiceJournalDal::getServiceJournalListByCurrentUser(null, false);

        if ($userServices->isEmpty()) {
            return response()->json(['error' => 'Услуги не найдены'], 404);
        }

        $serviceIds = $userServices->pluck('id')->toArray();

        // Ищем договор по номеру только для услуг текущего пользователя
        $agreement = Agreement::where('agreement_no', $documentId)
            ->whereIn('service_journal_id', $serviceIds)
            ->first();

        if ($agreement && $agreement->actualDocuments) {
            foreach ($agreement->actualDocuments as $actualDocument) {
                if ($actualDocument->documentPDF) {
                    $filePath = $actualDocument->documentPDF->path;
                    $fileName = $agreement->agreement_no . '.pdf';

                    if (Storage::exists($filePath)) {
                        return response()->download(storage_path('app/' . $filePath), $fileName);
                    }
                }
            }
        }

        return response()->json(['error' => 'Документ не найден'], 404);
    }


}
