<?php

namespace Services\ElasticEmail;

use Closure;
use App\Models\User\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Schemes\Tender\TenderSchema;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;

class ApiMailPost
{

    /**
     * Dolor magna eget est lorem..
     *
     * @var string
     */
    protected $apikey;

    /**
     * Dolor magna eget est lorem..
     *
     * @var string
     */
    protected $apiUrl;

    /**
     * Dolor magna eget est lorem..
     *
     * @var string
     */
    protected $profile = "reset_password";

    /**
     * Dolor magna eget est lorem..
     *
     * @var string
     */
    protected $subject;

    /**
     * Dolor magna eget est lorem..
     *
     * @var string
     */
    protected $from;

    /**
     * Dolor magna eget est lorem..
     *
     * @var string
     */
    protected $fromName;

    /**
     * Dolor magna eget est lorem..
     *
     * @var array
     */
    protected $to = [];

    /**
     * Dolor magna eget est lorem..
     *
     * @var string
     */
    protected $template;

    /**
     * Dolor magna eget est lorem..
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Dolor magna eget est lorem..
     *
     * @var array
     */
    protected $response;

    /**
     * Create a new class instance.
     *
     * @param 
     */
    public function __construct()
    {
        $this->apikey = static::config('apiKey');
        $this->apiUrl = static::config('apiUrl');

        $profileData = static::config("profiles.{$this->profile}");

        $this->from = $profileData['from'];
        $this->fromName = $profileData['fromName'];
        $this->template = $profileData['template'];
        $this->subject($profileData['subject'] ?? "");
        $this->to($profileData['to']);
        $this->fields($profileData['fields'] ?? []);
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @param string
     */
    protected static function config(string $key) {
        return config("elastic.$key");
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @param string $subject
     */
    public function subject(string $subject) {

        $this->subject = $subject;

        return $this;
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @param string|array [email]
     */
    public function to($emails) {

        if(!is_array($emails)) $emails = [$emails];

        $this->to = Arr::collapse([
            $this->to,
            $emails
        ]);

        return $this;
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @param array [name => value]
     */
    public function fields(array $fields) {

        $this->fields = Arr::collapse([
            $this->fields,
            $fields
        ]);

        return $this;
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @param string $name
     */
    public function template(string $name) {

        $this->template = $name;

        return $this;
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @param string $name
     */
    public function getApiUrl() {
        return $this->apiUrl;
    }

    /**
     * Dolor magna eget est lorem..
     */
    protected function fieldsSerialize() {
        return collect($this->fields)->mapWithKeys(function($item, $key) {
            return [
                (string) Str::start($key, 'merge_') => $item
            ];
        });        
    }

    /**
     * Dolor magna eget est lorem..
     */
    protected function dataSerialize() {
        return [
            'apikey'            => $this->apikey,
            'subject'           => $this->subject,
            'from'              => $this->from,
            'fromName'          => $this->fromName,
            'to'                => $this->membersSerialize(),
            'template'          => $this->template,
        ];       
    }

    /**
     * Dolor magna eget est lorem..
     */
    protected function membersSerialize() {
        return implode(", ", $this->to);       
    }

    /**
     * Dolor magna eget est lorem..
     */
    protected function arraySerialize() {
        return Arr::collapse([
            $this->dataSerialize(),
            $this->fieldsSerialize()
        ]);
    }

    /**
     * Dolor magna eget est lorem..
     */
    public function body() {
        return $this->arraySerialize();
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @param User $User
     * @param array $fields
     * @param callable $callback
     */
    public static function send(User $user, array $fields, $callback = null) {
        $email = $user->email;

        $mail = (new static())
            ->to($email)
            ->fields($fields);

        $response = Http::asForm()
            ->post(
                (string) $mail->getApiUrl(),
                $mail->body()
            );

        $mail->response = $response;
        $mail->response($callback);
        
        return $mail;
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @param User $User
     * @param array $fields
     * @param callable $callback
     */
    public static function simpleSend(
        User $user, 
        string $subject = null,  
        string $from = null,  
        string $fromName = null,  
        string $template = null,  
        array $fields = []
    ) {
        $email = $user->email;

        $profile = static::config('profiles.default');

        $to = Arr::collapse([
            $profile['to'],
            [$email]
        ]);

        $to = implode(", ", $to);

        $data = Arr::collapse([
            [
                'apikey' => static::config('apiKey'),
                'subject'           => $subject ?? $profile['subject'],
                'from'              => $from ?? $profile['from'],
                'fromName'          => $fromName ?? $profile['fromName'],
                'to'                => $to,
                'template'          => $template ?? $profile['template'],
            ],
            $fields
        ]);

        return Http::asForm()
            ->post(
                (string) static::config('apiUrl'),
                $data
            );
    }

    /**
     * Dolor magna eget est lorem..
     *
     * @param callable $callback
     */
    public function response($callback = null) {
        
        if(is_callable($callback)) {
            call_user_func($callback, $this->response);
        }
        
        return $this;
    }

}
