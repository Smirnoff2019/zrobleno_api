<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Simple extends Mailable
{
    
    use Queueable, SerializesModels;

    protected $fields = [
        'link' => '',
        'link_title' => '',
    ];

    /**
     * The subject of the message.
     *
     * @var string
     */
    public $subject = "Restore account access";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $link, string $link_title)
    {
        //
        $this->fields = [
            'link' => $link,
            'link_title' => $link_title,
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('send@zrobleno.com.ua')
            ->view('mails.simple.simple')
            ->with([
                'link'          => $this->fields['link'],
                'link_title'    => $this->fields['link_title'],
            ]);
    }
}
