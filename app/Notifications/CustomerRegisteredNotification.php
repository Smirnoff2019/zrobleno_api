<?php

namespace App\Notifications;

use App\Traits\Notification\NotificationBindingTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class CustomerRegisteredNotification extends Notification
{
    use Queueable, NotificationBindingTrait;

    /**
     * User password
     *
     * @var string
     */
    public $password;

    /**
     * Notification subject
     *
     * @var string
     */
    public $subject = 'Вітаємо! Ви успішно зареєструвались';

    /**
     * Create a new notification instance.
     *
     * @param $token
     */
    public function __construct($data)
    {
        $this->password = $data['password'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed|\App\Models\User\User  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->checkBinding(['database', 'mail']);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('send@zrobleno.com.ua', 'ТОВ \"ЗРОБЛЕНО\"')
            ->subject($this->subject)
            ->line('Ви отримали це повідомлення, оскільки цей e-mail адресу був використаний при реєстрації на сайті. Якщо Ви не реєструвалися на цьому сайті, просто ігноруйте цей лист і видаліть його. Ви більше не отримаєте такого листа.')
            ->line("Ваш логин и пароль на сайте:")
            ->line("Логин: $notifiable->email")
            ->line("Пароль: $this->password")
            ->action('Перейти до кабінету', 'https://customer.zrobleno.com.ua/');
    }

}
