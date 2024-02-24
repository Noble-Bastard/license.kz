<?php

namespace App\Mail;

use App\Data\Notify\Dal\EmailDal;
use App\Data\Notify\Model\EmailJournal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgreementMessageNotification extends Notification
{
    protected $agreementId;

    /**
     * Create a new message instance.
     *
     * @param EmailJournal $emailJournal
     * @param $attachList
     * @param int $agreementId
     */
    public function __construct(EmailJournal $emailJournal, $attachList, $agreementId)
    {
        $this->emailJournal = $emailJournal;
        $this->agreementId = $agreementId;
        $this->attachList = $attachList;
    }

    public function renderMessageContent()
    {
        return view('mail.agreementMessage')
            ->with('agreementId', $this->agreementId)
            ->render();
    }
}
