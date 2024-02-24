<?php

namespace App\Mail;

use App\Data\Notify\Dal\EmailDal;
use App\Data\Notify\Model\EmailJournal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentInvoiceMessageNotification extends Notification
{
    protected $paymentInvoiceId;

    /**
     * Create a new message instance.
     *
     * @param EmailJournal $emailJournal
     * @param $attachList
     * @param int $paymentInvoiceId
     */
    public function __construct(EmailJournal $emailJournal, $attachList,  $paymentInvoiceId)
    {
        $this->emailJournal = $emailJournal;
        $this->paymentInvoiceId = $paymentInvoiceId;
        $this->attachList = $attachList;
    }

    public function renderMessageContent()
    {
        return view('mail.paymentInvoiceMessage')
            ->with('paymentInvoiceId', $this->paymentInvoiceId)
            ->render();
    }
}
