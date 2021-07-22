<?php

namespace App\Mail\ElasticEmail;

use Illuminate\Support\Str;
use Services\ElasticEmail\MailTemplate;

class ResetPasswordMail extends MailTemplate
{

    /**
     * Name of the email template to be sent
     *
     * @var string
     */
    protected $template = 'ResetPassword';

    /**
     * Email subject line
     *
     * @var string
     */
    protected $subject = 'Відновлення доступу до аккаунту';

    /**
     * Array of fillable fields of the letter template
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Create a new class instance.
     *
     * @param string $link
     * @param array $fields
     * @param null|string $subject
     * @param null|string $from
     * @param null|string $fromName
     * @return void
     */
    public function __construct(string $link, ...$args) 
    {
        parent::__construct(...$args);
        
        $this->fields($this->makeFields($link));
    }

    /**
     * Bootstrap template.
     *
     * @return array
     */
    public function makeFields(string $link)  
    {
        return [
            'reset_password_link' => $link,
            'reset_password_title' => Str::limit($link, 55),
        ];
    }

}
