<?php

namespace App\Traits\Resources;


/**
 * Trait        ApiResourceResponceDescription
 * @package     App\Traits\Resources
 */
trait ApiResourceResponceDescription
{

    /**
     * HTTP response status code
     *
     * @var int
     */
    protected $responceStatus = 200;

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responceMessage = 'Data received successfully';

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'status' => $this->responceStatus,
            'message' => $this->responceMessage,
        ];
    }

    /**
     * Set HTTP response status code.
     *
     * @param  int $code
     * @return self
     */
    public function status(int $code): self
    {
        $this->responceStatus = $code;

        return $this;
    }

    /**
     * Set HTTP response status message.
     *
     * @param  string|array $message
     * @return self
     */
    public function message($message): self
    {
        $this->responceMessage = $message;

        return $this;
    }
    
}
