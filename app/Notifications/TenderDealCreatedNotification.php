<?php

namespace App\Notifications;

use App\Models\Tender\Tender;
use Illuminate\Bus\Queueable;
use App\Notifications\Messages\TelegramMessage;
use App\Traits\Notification\NotificationBindingTrait;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TenderDealCreatedNotification extends Notification
{
    use Queueable, NotificationBindingTrait;

    /**
     * Notification tender
     *
     * @var Tender
     */
    public $tender;

    /**
     * Notification subject
     *
     * @var string
     */
    public $subject;

    /**
     * Tender url
     *
     * @var string
     */
    public $url;

    /**
     * Create a new notification instance.
     *
     * @param Tender  $tender
     * @return void
     */
    public function __construct(Tender $tender)
    {
        $this->tender  = $tender;
        $this->subject = "Дякуємо за Ваш вибір. Очікуйте підтвердження угоди підрядником.";
        $this->url     = route('servises.customer.tenders.show', $tender->id);;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed|\App\Models\User\User  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->checkBinding([
            'database', 
            'mail', 
            'telegram' 
        ]);
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
            ->line("Vel risus commodo viverra maecenas accumsan lacus vel facilisis. Neque gravida in fermentum et sollicitudin ac orci. Eget nulla facilisi etiam dignissim diam quis enim lobortis scelerisque.\nQuam lacus suspendisse faucibus interdum. Quis risus sed vulputate odio ut.")
            ->action('Переглянути:', $this->url);
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
            'content'   => "Vel risus commodo viverra maecenas accumsan lacus vel facilisis. Neque gravida in fermentum et sollicitudin ac orci. Eget nulla facilisi etiam dignissim diam quis enim lobortis scelerisque.\nQuam lacus suspendisse faucibus interdum. Quis risus sed vulputate odio ut.",
            'status'    => 'information',
            'action'    => $this->url,
            'reason'    => 'tender',
            'reason_id' => $this->tender->id,
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
        $content = "*{$this->subject}*\n\nVel risus commodo viverra maecenas accumsan lacus vel facilisis. Neque gravida in fermentum et sollicitudin ac orci. Eget nulla facilisi etiam dignissim diam quis enim lobortis scelerisque.\nQuam lacus suspendisse faucibus interdum. Quis risus sed vulputate odio ut.\n\n$this->url";

        return (new TelegramMessage())
            ->setUser($notifiable)
            ->setContent($content)
            ->setAction($this->url);
    }

}
