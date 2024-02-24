<?php

namespace App\Mail;

use App\Data\Notify\Dal\EmailDal;
use App\Data\Notify\Model\EmailJournal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMessageNotification extends Notification
{
    protected $serviceJournalId;

    /**
     * Create a new message instance.
     *
     * @param EmailJournal $emailJournal
     * @param $attachList
     * @param int $serviceJournalId
     */
    public function __construct(EmailJournal $emailJournal, $attachList, $serviceJournalId)
    {
        $this->emailJournal = $emailJournal;
        $this->serviceJournalId = $serviceJournalId;
        $this->attachList = $attachList;
    }

    public function renderMessageContent()
    {
        return view('mail.newMessage')
            ->with('serviceJournalId', $this->serviceJournalId)
            ->render();
    }
}
