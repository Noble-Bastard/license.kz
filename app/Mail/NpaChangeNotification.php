<?php

namespace App\Mail;

use App\Data\Notify\Dal\EmailDal;
use App\Data\Notify\Model\EmailJournal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NpaChangeNotification extends Notification
{
    protected $agreementId;
    protected $link;
    protected $unsubscribeHash;

    /**
     * Create a new message instance.
     *
     * @param EmailJournal $emailJournal
     * @param $attachList
     * @param $link
     * @param $unsubscribeHash
     */
    public function __construct(EmailJournal $emailJournal, $attachList, $link, $unsubscribeHash)
    {
        $this->emailJournal = $emailJournal;
        $this->attachList = $attachList;
        $this->link = $link;
        $this->unsubscribeHash = $unsubscribeHash;
    }

    public function renderMessageContent()
    {
        return view('mail.npaChange')
            ->with('link', $this->link)
            ->with('unsubscribeHash', $this->unsubscribeHash)
            ->render();
    }
}
