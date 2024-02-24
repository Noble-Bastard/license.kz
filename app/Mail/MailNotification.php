<?php


namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class MailNotification extends Notification
{
    use Queueable;

    protected $mailBody;
    protected $attachList;
    protected $mailSubject;
    protected $greeting;

    /**
     * MailNotification constructor.
     * @param $mailSubject
     * @param $mailBody
     * @param $attachList
     * @param $greeting
     */
    public function __construct($mailSubject, $mailBody, $attachList, $greeting)
    {
        $this->mailBody = $mailBody;
        $this->attachList = $attachList;
        $this->mailSubject = $mailSubject;
        $this->greeting = $greeting;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->greeting($this->greeting)
            ->subject($this->mailSubject)
            ->line($this->mailBody)
            ->action('Личный кабинет', route('profile'))
            ->line('');

        foreach ($this->attachList as $attach){
            $file = storage_path() . '/app/' . $attach->file_path;
            $message->attach($file, ['as' => $attach->name . '.' . pathinfo($file, PATHINFO_EXTENSION)]);
        }

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}