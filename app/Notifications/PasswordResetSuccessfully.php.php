<?php

namespace App\Notifications;

use App\Notifications\Messages\TelegramMessage;
use App\Traits\Notification\NotificationBindingTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class PasswordResetSuccessfully extends Notification
{
    use Queueable, NotificationBindingTrait;

    /**
     * Notification data
     *
     * @var array
     */
    public $data;

    /**
     * Action
     *
     * @var string
     */
    public $url;

    /**
     * Notification subject
     *
     * @var string
     */
    public $subject = 'Сповіщення системи безпеки';

    /**
     * Create a new notification instance.
     *
     * @param $token
     */
    public function __construct($data = [])
    {
        $this->data = $data;
        $this->url = "https://auth.zrobleno.com.ua/";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed|\App\Models\User\User  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->checkBinding(['database', 'mail', 'telegram']);
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
            ->line('Доступ до вашого облікового запису відновлено!')
            ->action('Перейти до облікового запису', $this->url);
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
            'title'     => $this->subject,
            'content'   => "Доступ до вашого облікового запису відновлено!\nПерейти до облікового запису: $this->url",
            'status'    => 'information',
            'action'    => $this->url,
            'reason'    => 'password_reset_successfully',
            'reason_id' => $notifiable->id,
        ];
    }

    /**
     * Get the telegram notification message instance.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toTelegram($notifiable): TelegramMessage
    {
        $content = "*{$this->subject}*\n\nДоступ до вашого облікового запису відновлено!\nПерейти до облікового запису: $this->url";

        return (new TelegramMessage())
            ->setUser($notifiable)
            ->setContent($content)
            ->setAction($this->url);
    }

}
