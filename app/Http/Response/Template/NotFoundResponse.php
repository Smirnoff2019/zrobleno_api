<?php

namespace App\Http\Response\Template;

use Illuminate\Support\Str;
use App\Http\Response\ResponseTemplate;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Response\Transporter\NotFoundResponseTransporter;

/**
 * NotFoundResponse
 * 
 * @param string|null $message
 * @param array|null $errors
 * @param int|null $code
 */
class NotFoundResponse extends ResponseTemplate
{

    /**
     * Data, resources or results of processing the request to be sent in the response
     *
     * @var array
     */
    protected $data = [];

    /**
     * Status response code
     *
     * @var int
     */
    protected $statusCode = 404;

    /**
     * Text message sent in response
     *
     * @var string
     */
    protected $message = 'Data not found!';

    /**
     * Array of errors sent in response
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Set response transporter class
     *
     * @return string
     */
    public static function via()
    {
        return NotFoundResponseTransporter::class;
    }

    /**
     * Processes input data
     * 
     * @param string|null $message
     * @param array|null $errors
     * @param int|null $code
     * 
     * @return self
     */
    protected function handle(string $message = null, $errors = [], int $code = null)
    {
        return $this
            ->message($message !== null ? $message : $this->message)
            ->errors($errors ?? [])
            ->status($code ?? $this->statusCode);
    }

    /**
     * Parse an exception instance to create a response text
     *
     * @param \Illuminate\Database\Eloquent\ModelNotFoundException $exception
     * @param array|null $fields
     * @return self
     */
    public static function byException(ModelNotFoundException $exception, array $fields = null)
    {
        $namespace = $exception->getModel();
        $model = (string) Str::of($namespace)->basename();

        $sbt = 'by the request data!';

        if ($fields) {
            $sbt = implode('', [
                "with request data (",
                collect($fields)->map(function ($value, $key) {
                    return "`$key` = $value";
                })
                    ->implode(', '),
                "), data invalid!"
            ]);
        }

        $message = "We can`t find a $model $sbt";

        return (new static)->message($message);
    }

}
