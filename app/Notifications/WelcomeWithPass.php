<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class WelcomeWithPass extends Notification
{
    use Queueable;
    protected $pass = "";

    /**
     * WelcomeWithPass constructor.
     * @param string $pass
     */
    public function __construct(string $pass)
    {
        $this->pass = $pass;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Добро пожаловать')
            ->line('<p>Для вашего удобства мы создали для вас личный кабинет. Так вы сможете отслеживать все этапы выполнения заказа и всегда быть в курсе на какой стадии готовности находится ваша услуга. А также в вашем личном кабинете вы можете хранить ваши личные и полученные у нас документы, с уверенностью в надежности и конфиденциальности</p>')
            ->line('<p>Пароль от вашего кабинета: <strong>' . $this->pass .'</strong></p>')
            ->line('<p>Мы не храним ваш пароль! Вы можете поменять пароль используя механизм <a href="/password/reset">"Сбросить пароль"</a></p>')
            ->action('Личный кабинет', route('profile'))
            ->line('');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
