<?php


namespace App\Mail;


use App\Data\Helper\Assistant;
use App\Data\Helper\EmailNotifyTypeList;
use App\Data\Notify\Dal\EmailDal;
use App\Data\Notify\Model\EmailAttachment;

abstract class Notification
{
    protected $emailJournal;
    protected $attachList;

    public abstract function renderMessageContent();

    public function setData(){
        $this->emailJournal->planed_send_date = Assistant::getCurrentDate();
        if(is_null($this->emailJournal->email_notify_type_id)) {
            $this->emailJournal->email_notify_type_id = EmailNotifyTypeList::NewMessage;
        }
        $this->emailJournal->message_content = $this->renderMessageContent();
        $emailJournal = EmailDal::insert($this->emailJournal);

        foreach ($this->attachList as $attach){
            $emailAttachment = new EmailAttachment();
            $emailAttachment->email_journal_id = $emailJournal->id;
            $emailAttachment->file_path = $attach->file_path;
            $emailAttachment->name = $attach->name;
            EmailDal::setAttachment($emailAttachment);
        }

        return $emailJournal;
    }
}