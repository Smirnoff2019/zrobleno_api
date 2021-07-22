<?php

namespace Services\ElasticEmail;

use Closure;
use App\Models\User\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;

class ElasticEmailable
{

    /**
     * Elastic Email api key
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Elastic Email api url
     *
     * @var string
     */
    protected $apiUrl;

    /**
     * Email recipient array
     *
     * @var array|[\App\Models\User\User]
     */
    protected $recipients = [];

    /**
     * Elastic Email service Api response instance
     *
     * @var array
     */
    protected $response;

    /**
     * Elastic Email service Api response instance
     *
     * @var \Services\ElasticEmail\MailTemplate
     */
    protected $template;

    /**
     * Create a new class instance.
     *
     * @param App\Models\User\User|Illuminate\Database\Eloquent\Collection[] $user
     * @param \Services\ElasticEmail\MailTemplate $template
     * @return void
     */
    public function __construct($user, MailTemplate $template)
    {
        $this->recipients = collect();
        
        $this->apiKey = $this->config('apiKey');
        $this->apiUrl = $this->config('apiUrl');

        $this->template = $template;
        $this->addRecipient($user);
    }

    /**
     * Add mail recipient
     *
     * @param App\Models\User\User|Illuminate\Database\Eloquent\Collection[] $user
     * @return self
     */
    public function addRecipient($user)
    {   
        if($user instanceof User) {
            $this->recipients = $this->recipients->push($user);
        }

        if($user instanceof Collection) {
            $this->recipients = $this->recipients->concat($user);
        }

        return $this;
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @param \App\Models\User\User|Illuminate\Database\Eloquent\Collection[] $user
     * @param \Services\ElasticEmail\MailTemplate $template
     * @param \Closure $callback
     * @return \Illuminate\Http\Client\Response
     */
    public static function send($user, MailTemplate $template, callable $callback = null)
    {
        return (new static($user, $template))
            ->sendToElasticApi($callback);
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @param callable $callback
     * @return \Illuminate\Http\Client\Response
     */
    protected function sendToElasticApi(callable $callback = null)
    {
        $responce = Http::asForm()
            ->post(
                (string) $this->apiUrl,
                $this->makeData($this->template)
            );

        return $this->response($callback, $responce);
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @param callable $callback
     * @param \Illuminate\Http\Client\Response|null $response
     * @return \Illuminate\Http\Client\Response
     */
    public function response(callable $callback = null, Response $response = null)
    {

        if (is_callable($callback)) {
            call_user_func($callback, $response ?? $this->response);
        }

        return $response ?? $this->response;
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @return array
     */
    protected function makeData()
    {
        return Arr::collapse([
            $this->template->getQueryData(),
            [
                'apiKey'    => $this->apiKey,
                'to'        => implode(', ', (array) $this->getRecipientEmails())
            ]
        ]);
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @return array
     */
    protected function getRecipientEmails()
    {
        return $this->recipients
            ->map(function($user) {
                    return $user->{User::COLUMN_EMAIL};
            })
            ->toArray();
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @param string
     */
    protected function config(string $key)
    {
        return config("elasticEmail.$key");
    }

}
