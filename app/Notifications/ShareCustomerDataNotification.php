<?php

namespace App\Notifications;

use App\Models\Tender\Tender;
use Illuminate\Bus\Queueable;
use App\Notifications\Messages\TelegramMessage;
use App\Traits\Notification\NotificationBindingTrait;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShareCustomerDataNotification extends Notification
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
        $this->subject = "Данні замовника {$tender->uid}";
        $this->url     = "https://customer.zrobleno.com.ua/tender/{$tender->id}";
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
            ->line("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.")
            ->line($this->tender->user->full_name)
            ->line("Телофон: {$this->tender->user->phone}")
            ->line("E-mail: {$this->tender->user->email}")
            ->line("Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.")
            ->action('Переглянути замовлення:', $this->url);
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
            'content'   => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\n{$this->tender->user->full_name}\nТелофон: {$this->tender->user->phone}\nE-mail: {$this->tender->user->email}\n\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
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
        $content = "*{$this->subject}*\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\n{$this->tender->user->full_name}\nТелофон: {$this->tender->user->phone}\nE-mail: {$this->tender->user->email}\n\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\n$this->url";

        return (new TelegramMessage())
            ->setUser($notifiable)
            ->setContent($content)
            ->setAction($this->url);
    }

}
