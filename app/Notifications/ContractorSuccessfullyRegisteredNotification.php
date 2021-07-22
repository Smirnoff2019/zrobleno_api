<?php

namespace App\Notifications;

use App\Traits\Notification\NotificationBindingTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class ContractorSuccessfullyRegisteredNotification extends Notification
{
    use Queueable, NotificationBindingTrait;

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
        //
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
            ->line('Egestas erat imperdiet sed euismod nisi porta lorem mollis. Sed sed risus pretium quam vulputate dignissim. Semper auctor neque vitae tempus quam pellentesque.')
            ->action('Перейти до кабінету', 'https://contractor.zrobleno.com.ua/')
            ->line('Nibh tortor id aliquet lectus proin nibh. Diam phasellus vestibulum lorem sed risus ultricies. Quis commodo odio aenean sed adipiscing diam.');
    }

}
