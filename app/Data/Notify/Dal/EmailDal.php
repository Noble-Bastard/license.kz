<?php

namespace App\Data\Notify\Dal;

use App\Data\Helper\Assistant;
use App\Data\Helper\EmailNotifyTypeList;
use App\Data\Notify\Model\EmailAttachment;
use App\Data\Notify\Model\EmailJournal;
use App\Data\Subsciption\Model\EventSubscription;
use App\Mail\MailNotification;
use App\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class EmailDal
{
    /**
     * Get email by id
     *
     * @param $emailJournalId
     * @return mixed
     */
    public static function get($emailJournalId)
    {
        $entity = EmailJournal::where('id', $emailJournalId)->first();
        return $entity;
    }

    /**
     * Register new email for sending
     *
     * @param EmailJournal $srcEntity
     * @return EmailJournal
     */
    public static function insert(EmailJournal $srcEntity)
    {
        $srcEntity->create_date = Assistant::getCurrentDate();
        $srcEntity->created_by = null;
        $srcEntity->save();
        return $srcEntity;
    }


    /**
     * Set email sending date
     *
     * @param $emailJournalId
     * @return mixed
     */
    public static function setSendData($emailJournalId, $messageContent)
    {
        $entity = EmailJournal::where('id', $emailJournalId)->first();
        $entity->actual_send_date = Assistant::getCurrentDate();
        $entity->message_content = $messageContent;
        $entity->save();
        return $entity;
    }



    /**
     * Set send status message
     *
     * @param $emailJournalId
     * @param $statusMessage
     * @return mixed
     */
    public static function setSendStatusMessage($emailJournalId, $statusMessage)
    {
        $entity = EmailJournal::where('id', $emailJournalId)->first();
        $entity->send_status_message = $statusMessage;
        $entity->save();
        return $entity;
    }



    /**
     * Get list of not sent emails
     *
     * @return mixed
     */
    public static function getNotSentList()
    {
        $entityList = EmailJournal::where('planed_send_date', '<=', Assistant::getCurrentDate())
            ->whereNull('actual_send_date')
            ->whereNull('send_status_message')
            ->get();
        return $entityList;
    }

    public static function sendNewEmails()
    {
        $emailList = EmailDal::getNotSentList();

        foreach ($emailList as $emailEntity) {
            try {
                foreach (explode(';', $emailEntity->recipients) as $recipient) {
                    $user = User::where('email', $recipient)->first();

                    if($emailEntity->email_notify_type_id === EmailNotifyTypeList::NewsMessage){
                        $eventSubscription = EventSubscription::where('email', $recipient)->first();
                        $greeting = "Здравствуйте, " . $eventSubscription->name . "!";
                    } else if ($user){
                        $greeting = "Здравствуйте, " . $user->name . "!";
                    } else {
                        $greeting = "Здравствуйте!";
                    }

                    if($user) {
                        Log::info('User exists. email to -' . $recipient);
                        Notification::send($user, new MailNotification($emailEntity->subject, $emailEntity->message_content,  $emailEntity->attachments, $greeting));
                    } else {
                        Log::info('User NON exists. email to -' . $recipient);
                        Notification::route('mail', $recipient)
                            ->notify(new MailNotification($emailEntity->subject, $emailEntity->message_content,  $emailEntity->attachments, $greeting));
                    }
                }

                $emailEntity->actual_send_date = now();
                $emailEntity->send_status_message = 'OK';
            } catch (\Exception $e) {
                Log::error($e);
                $emailEntity->send_status_message = $e->getMessage();
            }
            $emailEntity->save();
        }
    }

    public static function setAttachment(EmailAttachment $emailAttachment)
    {
        return $emailAttachment->save();
    }
}





