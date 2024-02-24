<?php

namespace App\Data\Payment\Dal;

use App\Data\Core\Dal\CounterDal;
use App\Data\Core\Dal\SettingDal;
use App\Data\Document\Dal\DocumentDal;
use App\Data\Document\Model\Document;
use App\Data\DocumentTemplate\AgreementDocumentManager;
use App\Data\Helper\AgreementTypeList;
use App\Data\Helper\Assistant;
use App\Data\Helper\DocumentTypeList;
use App\Data\Helper\EmailNotifyTypeList;
use App\Data\Helper\ExtensionTypeList;
use App\Data\Helper\ServiceStatusList;
use App\Data\Notify\Model\EmailJournal;
use App\Data\Payment\Model\Agreement;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\ServiceJournal\Model\ServiceJournal;
use App\Mail\AgreementMessageNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AgreementDal extends AccountantDocumentDal
{
    public function __construct($serviceJournalId, $agreementTypeId)
    {
        parent::__construct(
            new AgreementDocumentManager($serviceJournalId, $agreementTypeId),
            $serviceJournalId,
            $agreementTypeId
        );
    }

    public static function get($entityId)
    {
        $entity = Agreement::where('id', $entityId)->first();
        return $entity;
    }

    public static function getByServiceJournal($serviceJournalId, $agreementTypeId): ?Model
    {
        $entity = Agreement::where('service_journal_id', $serviceJournalId)
            ->Where('agreement_type_Id', $agreementTypeId)
            ->first();
        return $entity;
    }

    public static function getListByServiceJournal($serviceJournalId)
    {
        $entity = Agreement::where('service_journal_id', $serviceJournalId)
            ->with('agreementType')
            ->with('agreementDocuments')
            ->get();
        return $entity;
    }



    function getDocumentListByServiceJournal()
    {
        return AgreementDocumentDal::getListByServiceJournal(
            $this->serviceJournalId,
            $this->documentSubTypeId
        );
    }

    function newAccountantDocument(): Model
    {
        $agreement = new Agreement();
        $agreement->create_date = Assistant::getCurrentDate();
        $agreement->agreement_date = Assistant::getCurrentDate();
        $agreement->agreement_no = CounterDal::getCounterValue(SettingDal::getAgreementCounterType());
        $agreement->service_journal_id = $this->serviceJournalId;
        $agreement->agreement_type_Id = $this->documentSubTypeId;
        $agreement->save();
        return $agreement;
    }

    function insertAccountantDocument($model, $documentFileName): void
    {
        $document = new Document();
        $document->document_type_id = $this->documentSubTypeId == AgreementTypeList::ClientCheck ?
            DocumentTypeList::ClientCheckAgreement : DocumentTypeList::Agreement;
        $document->name = $model->agreement_no;
        $document->path = $documentFileName;
        $originalAgreementDocument = DocumentDal::set($document);
        AgreementDocumentDal::insert($model->id, $originalAgreementDocument->id);
    }

    function sendAccountDocumentNotification($accountDocumentId)
    {
        $serviceJournalExt = ServiceJournalDal::getExt($this->serviceJournalId);

        try {
            DB::beginTransaction();

            //$recipients = ProfileDal::getEmailsByHeadRole();

            $serviceName = $serviceJournalExt->service_no . '(' . (new AgreementTypeDal())->get($this->documentSubTypeId)->name . ')';
            $emailSubject = sprintf(trans('messages.mail.agreement_message_subject'), $serviceName);

            $emailEntity = new EmailJournal();
            $emailEntity->recipients = $serviceJournalExt->client_email;
            $emailEntity->subject = $emailSubject;
            $emailEntity->email_notify_type_id = EmailNotifyTypeList::AgreementHeadNotificationMessage;

            $agreementDocumentList = AgreementDocumentDal::getByAgreement($accountDocumentId);
            $attachList = array();
            foreach ($agreementDocumentList as $agreementDocument){
                $attach = new \stdClass();
                if(strpos($agreementDocument->document->path, ExtensionTypeList::PDF) !== false) {
                    $attach->file_path = $agreementDocument->document->path;
                    $attach->name = $agreementDocument->document->name;
                    array_push($attachList, $attach);
                }
            }

            (new AgreementMessageNotification($emailEntity, $attachList, $accountDocumentId))->setData();

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
        $agreementTypeId = self::getAgreementTypeByServiceStatus($serviceStatusId);
        if($agreementTypeId == 0)
            return;

        $statusOrder = self::getServiceStatusOrder($serviceStatusId);
        $serviceJournalListForDocumentGen = self::getServiceJournalListForNewDocumentGen($statusOrder, $agreementTypeId);

        foreach ($serviceJournalListForDocumentGen as $serviceJournal) {
            $agreementDal = new AgreementDal($serviceJournal->id, $agreementTypeId);
            $agreementDal->generate();
        }
    }

    public static function getServiceJournalListForNewDocumentGen($statusOrder, $agreementTypeId)
    {
        $serviceJournalListForDocumentGen = ServiceJournal::from('service_journal as sj')
            ->leftJoin('agreement as pi', function ($join) use($agreementTypeId) {
                $join->on('pi.service_journal_id', 'sj.id')
                    ->where('pi.agreement_type_id', $agreementTypeId);
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
