<?php

namespace App\Mail;

use App\Data\Notify\Dal\EmailDal;
use App\Data\Notify\Model\EmailJournal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommercialOfferNotification extends Notification
{
    protected $agreementId;

    /**
     * Create a new message instance.
     *
     * @param EmailJournal $emailJournal
     * @param $attachList
     */
    public function __construct(EmailJournal $emailJournal, $attachList)
    {
        $this->emailJournal = $emailJournal;
        $this->attachList = $attachList;
    }

    public function renderMessageContent()
    {
        return view('mail.commercialOffer')
            ->render();
    }
}
