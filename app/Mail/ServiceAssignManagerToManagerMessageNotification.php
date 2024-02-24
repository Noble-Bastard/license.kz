<?php

namespace App\Mail;

use App\Data\Notify\Model\EmailJournal;
use App\Data\ServiceJournal\Model\ServiceJournal;

class ServiceAssignManagerToManagerMessageNotification extends Notification
{
    protected $serviceJournal;

    /**
     * Create a new message instance.
     *
     * @param EmailJournal $emailJournal
     * @param $attachList
     * @param ServiceJournal $serviceJournal
     */
    public function __construct(EmailJournal $emailJournal, $attachList,  $serviceJournal)
    {
        $this->emailJournal = $emailJournal;
        $this->serviceJournal = $serviceJournal;
        $this->attachList = $attachList;
    }

    public function renderMessageContent()
    {
        return view('mail.ServiceAssignManagerToManagerMessageNotification')
            ->with('serviceJournal', $this->serviceJournal)
            ->render();
    }
}
