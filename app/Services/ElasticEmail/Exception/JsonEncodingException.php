<?php

namespace Services\ElasticEmail\Exception;

use RuntimeException;
use Services\ElasticEmail\MailTemplate;

class JsonEncodingException extends RuntimeException
{
    
    /**
     * Create a new JSON encoding exception for the mail template.
     *
     * @param  mixed  $template
     * @param  string  $message
     * @return static
     */
    public static function forTemplate(MailTemplate $template, $message)
    {
        return new static('Error encoding ElasticEmail mail template [' . get_class($template) . '] to JSON: ' . $message);
    }

}
