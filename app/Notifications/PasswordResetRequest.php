<?php

namespace App\Notifications;

use App\Models\PasswordReset\PasswordReset;
use App\Notifications\Messages\TelegramMessage;
use App\Traits\Notification\NotificationBindingTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class PasswordResetRequest extends Notification
{
    use Queueable, NotificationBindingTrait;

    /**
     * User password reset model
     *
     * @var PasswordReset
     */
    public $password_reset;

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
    public function __construct(PasswordReset $password_reset)
    {
        $this->password_reset = $password_reset;
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
        $url = $this->password_reset->makeLink();

        return (new MailMessage)
            ->from('send@zrobleno.com.ua', 'ТОВ \"ЗРОБЛЕНО\"')
            ->subject($this->subject)
            ->line('Ви отримали цей електронний лист, оскільки ми
            отримали запит на скидання пароля для вашого облікового запису.')
            ->action('Скинути пароль', $url)
            ->line("Або скористайтесь посиланням:")
            ->line($url)
            ->line("Якщо ви не намагалися скинути пароль, проігноруйте цей лист.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $url = $this->password_reset->makeLink();

        return [
            'title'     => $this->subject,
            'content'   => "Ми отримали запит на скидання пароля для вашого облікового запису. Щоб скинути пароль скористайтесь посиланням: {$url}\nЯкщо ви не намагалися скинути пароль, проігноруйте це сповіщення.",
            'status'    => 'information',
            'action'    => $url,
            'reason'    => 'password_reset',
            'reason_id' => $this->password_reset->id,
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
        $url = $this->password_reset->makeLink();

        $content = "*{$this->subject}*\n\nМи отримали запит на скидання пароля для вашого облікового запису. Щоб скинути пароль скористайтесь посиланням нижче:\n\n{$url}\n\nЯкщо ви не намагалися скинути пароль, проігноруйте це сповіщення.";

        return (new TelegramMessage())
            ->setUser($notifiable)
            ->setContent($content)
            ->setAction($url);
    }

}
