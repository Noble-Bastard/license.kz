<?php

namespace App\Data\Payment\Dal;

use App\Data\Core\Dal\CounterDal;
use App\Data\Payment\Dal\PaymentInvoiceDocumentDal;
use App\Data\Core\Dal\SettingDal;
use App\Data\Document\Dal\DocumentDal;
use App\Data\Document\Model\Document;
use App\Data\DocumentTemplate\PaymentInvoiceDocumentManager;
use App\Data\Helper\AgreementTypeList;
use App\Data\Helper\Assistant;
use App\Data\Helper\DocumentTypeList;
use App\Data\Helper\EmailNotifyTypeList;
use App\Data\Helper\ExtensionTypeList;
use App\Data\Helper\InvoiceTypeList;
use App\Data\Helper\PaymentStatusList;
use App\Data\Helper\PaymentTypeList;
use App\Data\Helper\ServiceStatusList;
use App\Data\Notify\Model\EmailJournal;
use App\Data\Payment\Model\PaymentInvoice;
use App\Data\Payment\Model\PaymentJournal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\ServiceJournal\Model\ServiceJournal;
use App\Mail\PaymentInvoiceMessageNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PaymentInvoiceDal extends AccountantDocumentDal
{
    public function __construct($serviceJournalId, $invoiceTypeId)
    {
        parent::__construct(
            new PaymentInvoiceDocumentManager($serviceJournalId, $invoiceTypeId),
            $serviceJournalId,
            $invoiceTypeId
        );
    }

    public static function getServiceJournalListForNewDocumentGen($statusOrder, $invoiceTypeId)
    {
        $serviceJournalListForDocumentGen = ServiceJournal::from('service_journal as sj')
            ->leftJoin('payment_invoice as pi', function ($join) use($invoiceTypeId) {
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

    public static function get($entityId)
    {
        $entity = PaymentInvoice::where('id', $entityId)->first();
        return $entity;
    }

    public static function getByServiceJournal($serviceJournalId, $invoiceTypeId): ?Model
    {
        $entity = PaymentInvoice::where('service_journal_id', $serviceJournalId)
            ->where('invoice_type_id', $invoiceTypeId)
            ->with('paymentJournal')
            ->with('invoiceType')
            ->first();
        return $entity;
    }

    public static function getListByServiceJournal($serviceJournalId)
    {
        $entityList = PaymentInvoice::where('service_journal_id', $serviceJournalId)
            ->with('paymentJournal')
            ->with('invoiceType')
            ->with('paymentInvoiceDocuments')
            ->get();
        return $entityList;
    }

    public static function setPaymentInvoicePaidStatus($serviceJournalId, $invoiceTypeId,
                                                       $paymentDate, $paymentDocumentNo): void
    {

        try {
            DB::beginTransaction();

            $paymentInvoice = self::getByServiceJournal($serviceJournalId, $invoiceTypeId);
            $paymentInvoice->payment_status_id = PaymentStatusList::IsPaid;
            $paymentInvoice->payment_date = date('Y-m-d', strtotime($paymentDate));
            $paymentInvoice->payment_document_no = $paymentDocumentNo;
            $paymentInvoice->save();

            //todo send notification to manager - can start cleint check
            //if($invoiceTypeId == InvoiceTypeList::ClientCheck)

            if($invoiceTypeId == InvoiceTypeList::PrePayment)
                ServiceJournalDal::setServiceJournalStatus($serviceJournalId,ServiceStatusList::DataCollection);

            if($invoiceTypeId == InvoiceTypeList::FullPayment)
                ServiceJournalDal::setServiceJournalStatus($serviceJournalId,ServiceStatusList::Complete);

            DB::commit();
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function generateNewDocumentsTask($serviceStatusId) {
        $invoiceTypeId = self::getInvoiceTypeByServiceStatus($serviceStatusId);
        if($invoiceTypeId == 0)
            return;

        $statusOrder = self::getServiceStatusOrder($serviceStatusId);
        $serviceJournalListForDocumentGen = self::getServiceJournalListForNewDocumentGen($statusOrder, $invoiceTypeId);

        foreach ($serviceJournalListForDocumentGen as $serviceJournal) {
            $paymentInvoiceDal = new PaymentInvoiceDal($serviceJournal->id, $invoiceTypeId);
            $paymentInvoiceDal->generate();
        }
    }

    function getDocumentListByServiceJournal()
    {
        return PaymentInvoiceDocumentDal::getListByServiceJournal(
            $this->serviceJournalId,
            $this->documentSubTypeId
        );
    }

    function newAccountantDocument(): Model
    {
        $agreementTypeId = $this->documentSubTypeId == InvoiceTypeList::ClientCheck ?
            AgreementTypeList::ClientCheck : AgreementTypeList::FullPayment;

        $amount = 0;
        $serviceJournal = ServiceJournalDal::getExt($this->serviceJournalId);
        switch ($this->documentSubTypeId) {
            case InvoiceTypeList::ClientCheck:
                $amount = SettingDal::getClientCheckCost();
                break;
            case InvoiceTypeList::PrePayment:
                $amount = ($serviceJournal->amount + $serviceJournal->tax) * $serviceJournal->prepayment_percent;
                break;
            case InvoiceTypeList::FullPayment:
                $amount = ($serviceJournal->amount + $serviceJournal->tax)
                    - ($serviceJournal->amount + $serviceJournal->tax) * $serviceJournal->prepayment_percent;
                break;
        }


        $agreement = AgreementDal::getByServiceJournal($this->serviceJournalId, $agreementTypeId);
        $paymentInvoice = new PaymentInvoice();
        $paymentInvoice->create_date = Assistant::getCurrentDate();
        $paymentInvoice->payment_date = null;
        $paymentInvoice->payment_invoice_date = Assistant::getCurrentDate();
        $paymentInvoice->payment_invoice_no = CounterDal::getCounterValue(SettingDal::getPaymentInvoiceCounterType(), $serviceJournal->country_id);
        $paymentInvoice->service_journal_id = $this->serviceJournalId;
        $paymentInvoice->invoice_type_id = $this->documentSubTypeId;
        $paymentInvoice->payment_status_id = PaymentStatusList::ToPay;
        $paymentInvoice->amount = $amount;
        $paymentInvoice->currency_id = $serviceJournal->currency_id;
        $paymentInvoice->agreement_id = $agreement->id;
        $paymentInvoice->save();

        $paymentJournal = new PaymentJournal();
        $paymentJournal->payment_invoice_id = $paymentInvoice->id;
        $paymentJournal->create_date = Assistant::getCurrentDate();
        $paymentJournal->payment_date = null;
        $paymentJournal->payment_type_id = PaymentTypeList::BasicPaymentType;
        $paymentJournal->amount = $amount;
        $paymentJournal->currency_id = $serviceJournal->currency_id;
        $paymentJournal->ext_details = null;
        $paymentJournal->ext_status = null;
        $paymentJournal->ext_payment_id = null;
        $paymentJournal->ext_message = null;
        $paymentJournal->ext_error_code = null;
        $paymentJournal->save();

        return self::get($paymentInvoice->id);
    }

    function insertAccountantDocument($model, $documentFileName): void
    {
        $document = new Document();
        $document->document_type_id = DocumentTypeList::PaymentInvoice;
        $document->name = $model->payment_invoice_no;
        $document->path = $documentFileName;
        $originalPaymentInvoiceDocument = DocumentDal::set($document);

        PaymentInvoiceDocumentDal::insert($model->id, $originalPaymentInvoiceDocument->id);
    }


    function sendAccountDocumentNotification($accountDocumentId)
    {
        $serviceJournalExt = ServiceJournalDal::getExt($this->serviceJournalId);


        try {
            DB::beginTransaction();

            $serviceName = $serviceJournalExt->service_no . '(' . (new InvoiceTypeDal())->get($this->documentSubTypeId)->name . ')';

            $emailSubject = sprintf(trans('messages.mail.payment_invoice_message_subject'), $serviceName);


            $emailEntity = new EmailJournal();
            $emailEntity->planed_send_date = Assistant::getCurrentDate();
            $emailEntity->message_content = '';
            $emailEntity->recipients = $serviceJournalExt->client_email;
            $emailEntity->subject = $emailSubject;
            $emailEntity->actual_send_date = null;
            $emailEntity->send_status_message = null;
            $emailEntity->email_notify_type_id = EmailNotifyTypeList::PaymentInvoiceClientNotificationMessage;

            $paymentInvoiceDocumentList = PaymentInvoiceDocumentDal::getByInvoice($accountDocumentId);
            $attachList = array();
            foreach ($paymentInvoiceDocumentList as $paymentInvoiceDocument){
                $attach = new \stdClass();
                if(strpos($paymentInvoiceDocument->document->path, ExtensionTypeList::PDF) !== false) {
                    $attach->file_path = $paymentInvoiceDocument->document->path;
                    $attach->name = $paymentInvoiceDocument->document->name;
                    array_push($attachList, $attach);
                }
            }

            (new PaymentInvoiceMessageNotification($emailEntity, $attachList, $accountDocumentId))->setData();

            DB::commit();
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }
}
