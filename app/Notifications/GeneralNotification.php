<?php

namespace App\Notifications;

use App\Notifications\Messages\TelegramMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Traits\Notification\NotificationBindingTrait;

class GeneralNotification extends Notification
{
    use Queueable, NotificationBindingTrait;

    public $data = [];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($serializyData = [])
    {
        $this->data = $serializyData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->from('send@zrobleno.com.ua', 'ТОВ \"ЗРОБЛЕНО\"')
                ->subject($this->data['title'])
                ->line($this->data['show_content'])
                ->action('Подивитись', url($this->data['action']))
                ->line('Дякуємо, що скористались нашим додатком');
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
            'title'     => $this->data['title'],
            'content'   => $this->data['show_content'],
            'status'    => $this->data['status_slug'],
            'action'    => $this->data['action'],
            'reason'    => $this->data['reason'],
            'reason_id' => $this->data['reason_id']
        ];
    }

    public function toTelegram ($notifiable) : TelegramMessage
    {
        $content = "*{$this->data['title']}* " . "\n\n" . $this->data['show_content'];

        return  (new TelegramMessage())
            ->setUser($notifiable)
            ->setContent($content)
            ->setAction($this->data['action']);
    }
}
