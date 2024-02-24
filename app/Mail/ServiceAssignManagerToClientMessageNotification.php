<?php

namespace App\Mail;

use App\Data\Notify\Dal\EmailDal;
use App\Data\Notify\Model\EmailJournal;
use App\Data\ServiceJournal\Model\ServiceJournal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ServiceAssignManagerToClientMessageNotification extends Notification
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
        return view('mail.serviceAssignManagerToClientMessageNotification')
            ->with('serviceJournal', $this->serviceJournal)
            ->render();
    }
}
