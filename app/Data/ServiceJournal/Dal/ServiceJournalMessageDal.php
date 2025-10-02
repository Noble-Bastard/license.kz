<?php

namespace App\Data\ServiceJournal\Dal;



use App\Data\Core\Dal\ProfileDal;
use App\Data\Helper\Assistant;
use App\Data\Helper\EmailNotifyTypeList;
use App\Data\Helper\RoleList;
use App\Data\Notify\Dal\MessagesDal;
use App\Data\Notify\Model\EmailJournal;
use App\Data\Notify\Model\Messages;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\ServiceJournal\Model\ServiceJournalMessage;
use App\Data\ServiceJournal\Model\ServiceJournalMessageExt;
use App\Data\ServiceJournal\Model\ServiceJournalMessageReadHistExt;
use App\Mail\NewMessageNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceJournalMessageDal
{

    public static function getListByServiceJournal($serviceJournalId){
        $entityList = ServiceJournalMessageExt
            ::where('service_journal_id',$serviceJournalId)
            ->orderBy('create_date', 'asc')
            ->get();
        return $entityList;
    }

    public static function insertServiceJournalMessage($serviceJournalId, $subject, $message){

        //get message subject
        $serviceJournalExt = ServiceJournalDal::getExt($serviceJournalId);
        if(Assistant::IsNullOrEmptyString($subject))
        {
            $subject = $serviceJournalExt->service_no . " " . $serviceJournalExt->service_code;
        }

        //get recipients
        $curUserId = Auth::id();
        $curProfileExt = ProfileDal::getByUserId($curUserId);
        $clientProfileExt = ProfileDal::get($serviceJournalExt->client_id);
        $managerProfileExt = ProfileDal::get($serviceJournalExt->manager_id);
        if($curProfileExt->role_id != RoleList::Client)
        {
            $recipients = $clientProfileExt->email;
        } else {
            $recipients = $managerProfileExt->email;
        }

        try {

            DB::beginTransaction();

            //generate new email
            $emailEntity = new EmailJournal();
            $emailEntity->planed_send_date = Assistant::getCurrentDate();
            $emailEntity->message_content = $message;
            $emailEntity->recipients = $recipients;
            $emailEntity->subject = $subject;
            $emailEntity->actual_send_date = null;
            $emailEntity->send_status_message = null;
            $emailEntity->email_notify_type_id = EmailNotifyTypeList::NewMessage;

            $attachList = array();

            $emailEntity = (new NewMessageNotification($emailEntity, $attachList, $serviceJournalId))->setData();


            //save message
            $messageEntity = new Messages();
            $messageEntity->caption = $subject;
            $messageEntity->message = $message;
            $messageEntity->email_journal_id = $emailEntity->id;
            $messageEntity = MessagesDal::set($messageEntity);

            //save data in ServiceJournalMessage
            $serviceJournalMessage = new ServiceJournalMessage();
            $serviceJournalMessage->service_journal_id = $serviceJournalId;
            $serviceJournalMessage->message_id = $messageEntity->id;
            $serviceJournalMessage->create_date = Assistant::getCurrentDate();
            $serviceJournalMessage->created_by = $curUserId;
            $serviceJournalMessage->save();

            //set read
            MessagesDal::setMessagesReadHist($messageEntity->id);

            DB::commit();

            return $messageEntity;

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return $e;
        }
    }

    public static function markAsRead($messageId){
        MessagesDal::setMessagesReadHist($messageId);
    }

    public static function getClientReadHist(){
        $userId = Auth::id();
        $profile = ProfileDal::getByUserId($userId);

        $serviceJournalMessageReadHist = ServiceJournalMessageReadHistExt::
            where('client_id', $profile->id)
                ->where(function ($query) use ($userId) {
                    $query->where('message_client_read_by', $userId)
                        ->orWhereNull('message_client_read_by');
                })
                ->orderBy('message_create_date', 'asc')
                ->get();

        return $serviceJournalMessageReadHist;
    }


    public static function getManagerReadHist(){
        $userId = Auth::id();
        $profile = ProfileDal::getByUserId($userId);

        $serviceJournalMessageReadHist = ServiceJournalMessageReadHistExt::
        where('manager_id', $profile->id)
            ->where(function ($query) use ($userId) {
                $query->where('message_manager_read_by', $userId)
                    ->orWhereNull('message_manager_read_by');
            })->get();

        return $serviceJournalMessageReadHist;
    }
}
