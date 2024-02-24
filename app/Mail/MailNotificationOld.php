<?php


namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotificationOld extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailBody;
    protected $attachList;

    /**
     * MailNotification constructor.
     * @param $mailSubject
     * @param $mailBody
     * @param $attachList
     */
    public function __construct($mailSubject, $mailBody, $attachList)
    {
        $this->mailBody = $mailBody;
        $this->attachList = $attachList;
        $this->subject($mailSubject);
    }

    public function build(){
        $view = $this->view('mail.message')->with('messageContent', $this->mailBody);
        foreach ($this->attachList as $attach){
            $view->attachFromStorageDisk('local', $attach->file_path, $attach->name);
        }
        return $view;
    }
}