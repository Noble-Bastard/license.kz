<?php

namespace App\Data\Task\Dal;



use App\Data\Core\Dal\ProfileDal;
use App\Data\Document\Model\Document;
use App\Data\Helper\Assistant;
use App\Data\Helper\EmailNotifyTypeList;
use App\Data\Helper\RoleList;
use App\Data\Notify\Dal\EmailDal;
use App\Data\Notify\Dal\MessagesDal;
use App\Data\Notify\Model\EmailJournal;
use App\Data\Notify\Model\Messages;
use App\Data\Notify\Model\MessagesReadHist;
use App\Data\ServiceJournal\Model\ServiceJournal;
use App\Data\ServiceJournal\Model\ServiceJournalMessage;
use App\Data\ServiceJournal\Model\ServiceJournalMessageExt;
use App\Data\Task\Model\TaskMessage;
use App\Data\Task\Model\TaskMessageExt;
use App\Data\Task\Dal\TaskDal;
use App\Data\Task\Dal\TaskExecutorDal;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TaskMessageDal
{

    public static function getListByTask($taskId){
//        $entityList = TaskMessageExt
//            ::where('task_id',$taskId)
//            ->orderBy('create_date', 'asc')
//            ->get();

        $profile = ProfileDal::getByUserId(Auth::id());

        $entityList = TaskMessageExt::leftJoin("messages_read_hist as mrh", function($join) use ($profile) {
                $join->on("mrh.message_id","=","task_message_ext.message_id")
                    ->where("mrh.read_by", "=", Auth::id());
            })
            ->selectRaw('task_message_ext.*, !isnull(mrh.id) as is_read')
            ->where('task_message_ext.task_id', $taskId)
            ->get();

        return $entityList;
    }

    public static function insertTaskMessage($taskId, $subject, $message){

        //get message subject
        $taskExt = TaskDal::get($taskId);
        if(Assistant::IsNullOrEmptyString($subject))
        {
            $subject = $taskExt->id;
        }

        //get recipients
        $curUserId = Auth::id();
        $curProfileExt = ProfileDal::getByUserId($curUserId);

        $taskExecutors = TaskExecutorDal::getListByTask($taskId);
        $managerProfileExt = ProfileDal::get($taskExt->manager_id);

        $recipients = "";
        if($curProfileExt->role_id != RoleList::Manager)
        {
            foreach ($taskExecutors as $taskExecutor){
                $recipients .= $taskExecutor->executor_email.";";
            }
            $recipients = substr($recipients, 0, -1);
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
            $emailEntity = EmailDal::insert($emailEntity);

            //save message
            $messageEntity = new Messages();
            $messageEntity->caption = $subject;
            $messageEntity->message = $message;
            $messageEntity->email_journal_id = $emailEntity->id;
            $messageEntity = MessagesDal::set($messageEntity);

            //save data in ServiceJournalMessage
            $taskMessage = new TaskMessage();
            $taskMessage->task_id = $taskId;
            $taskMessage->message_id = $messageEntity->id;
            $taskMessage->create_date = Assistant::getCurrentDate();
            $taskMessage->created_by = $curUserId;
            $taskMessage->save();

            //set read
            MessagesDal::setMessagesReadHist($messageEntity->id);

            //send notify email
            try {
                //TODO !!!!!!!
//                Mail::to(explode(';', $emailEntity->recipients))->send(
//                    new NewMessageNotification(
//                        $emailEntity->id,
//                        $emailEntity->subject,
//                        $taskId
//                    )
//                );
            }
            catch (\Exception $e)
            {
                Log::error($e);
                EmailDal::setSendStatusMessage($emailEntity->id,$e->getMessage());
            }

            DB::commit();

            return $messageEntity;

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return $e;
        }
    }

    public static function markAsRead($taskId){
        //todo change to batch by $taskId and current user
        //MessagesDal::setMessagesReadHist($messageEntity->id);
    }

}
