<?php

namespace Services\ElasticEmail;

use Error;
use BadMethodCallException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Services\ElasticEmail\Exception\JsonEncodingException;

abstract class MailTemplate implements Arrayable, Jsonable
{

    /**
     * Name of the email template to be sent
     *
     * @var string
     */
    protected $template = '';

    /**
     * Sender's email address
     *
     * @var string
     */
    protected $from = '';

    /**
     * Sender's name
     *
     * @var string
     */
    protected $fromName = '';

    /**
     * Email subject line
     *
     * @var string
     */
    protected $subject = '';

    /**
     * Array of fillable fields of the letter template
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Prefix for field names in a valid format
     *
     * @const string
     */
    protected const QUERY_FIELD_PREFIX = 'merge_';

    /**
     * Service config file name
     *
     * @const string
     */
    protected const CONFIG_NAME = 'elasticEmail';

    /**
     * Create a new class instance.
     *
     * @param array $fields
     * @param null|string $subject
     * @param null|string $from
     * @param null|string $fromName
     * @return void
     */
    public function __construct(
        array $fields = [], 
        string $subject = null, 
        string $from = null, 
        string $fromName = null
    ) {
        $this->checkIsEmptyTemplateProperty();

        $this->boot();

        if($subject) 
            $this->subject($subject);

        if($from) 
            $this->from($from);

        if($fromName) 
            $this->fromName($fromName);

        $this->fields($fields);
    }

    /**
     * Create a new class instance.
     *
     * @param array $fields
     * @param null|string $subject
     * @param null|string $from
     * @param null|string $fromName
     * @return self
     */
    public static function make(...$args)
    {
        return new static(...$args);
    }

    /**
     * Bootstrap template.
     *
     * @return void
     */
    protected function boot() 
    {
        if(!$this->fromName || !$this->from) 
            $this->bootDefaultSender('fromName');

        if(! $this->subject) 
            $this->setTemplatePropertyFromConfig('subject');

        if(! $this->fields) 
            $this->setTemplatePropertyFromConfig('fields');
    }

    /**
     * Set the default sender data from configuration file
     *
     * @return void
     * 
     * @throws \Exception
     */
    protected function bootDefaultSender() 
    {
        $sender = Arr::get($this->getConfigs(), 'sender');

        if(! Arr::has($this->getConfigs(), ['sender.from', 'sender.fromName'])) {
            throw new \Exception(sprintf(
                'Not found values (%s) in %s.php config file',
                implode(',', ['sender.from', 'sender.fromName']),
                static::CONFIG_NAME
            ));
        }

        $this->from($sender['from']);
        $this->fromName($sender['fromName']);
    }

    /**
     * Set the template property by key from configuration file
     *
     * @return bool|self|mixed
     */
    protected function setTemplatePropertyFromConfig(string $key) 
    {
        $value = Arr::get($this->getTemplateConfigs(), $key, null);
        
        if($value) {
            return $this->$key($value);
        }

        return false;
    }

    /**
     * Get template properties from configuration file
     *
     * @return array
     */
    protected function getTemplateConfigs() 
    {
        return Arr::get($this->getConfigs(), "templates.{$this->template}", []);
    }

    /**
     * Get service configs from configuration file
     *
     * @return array
     */
    protected function getConfigs()
    {
        return config(static::CONFIG_NAME);
    }

    /**
     * Check if the name of the letter template is set
     *
     * @return bool
     * 
     * @throws \Exception
     */
    protected function checkIsEmptyTemplateProperty()
    {
        if(! $this->template) {
            throw new \Exception(sprintf(
                'The $%s property can not be empty in %s',
                "template",
                static::class
            ));

            return false;
        }

        return true;
    }

    /**
     * Set the filled fields of the letter
     *
     * @param  array $fields [name => value]
     * @return self
     */
    public function fields(array $fields)
    {
        $this->fields = Arr::collapse([
            $this->fields,
            $fields
        ]);

        return $this;
    }

    /**
     * Get the filled fields of the letter
     *
     * @param  array $fields [name]
     * @return array
     */
    public function getFields(array $fields = null)
    {
        if($fields) {
            return (array) collect($this->fields)->only($fields);
        }

        return $this->fields;
    }

    /**
     * Set the letter subject
     *
     * @param  string $subject
     * @return self
     */
    public function subject(string $subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get the letter subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the letter subject
     *
     * @param  string $fromName
     * @return self
     */
    public function fromName(string $name)
    {
        $this->fromName = $name;

        return $this;
    }

    /**
     * Get the letter subject
     *
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * Set the letter subject
     *
     * @param  string $email
     * @return self
     */
    public function from(string $email)
    {
        $this->from = $email;

        return $this;
    }

    /**
     * Get the letter subject
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Formatting fields to query format
     *
     * @return array
     */
    public function fieldsToQueryFormat()
    {
        return collect($this->fields)->mapWithKeys(function ($item, $key) {
            return [(string) Str::start($key, static::QUERY_FIELD_PREFIX) => $item];
        });
    }

    /**
     * Get request data for an HTTP request
     *
     * @return array
     */
    public function getQueryData()
    {
        $this->validateTemplateData();

        return Arr::collapse([
            Arr::except($this->toArray(), ['fields']),
            $this->fieldsToQueryFormat()
        ]);
    }

    /**
     * Get request data for an HTTP request
     *
     * @return array
     * 
     * @throws \Exception
     */
    protected function validateTemplateData()
    {
        collect($this->toArray())->map(function($value, $key) {
            if(! $value) {
                throw new \Exception(sprintf(
                    'The `%s` property can not be empty in %s',
                    $key,
                    static::class
                ));
            }
        });
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'template'  => $this->template,
            'from'      => $this->from,
            'fromName'  => $this->fromName,
            'subject'   => $this->subject,
            'fields'    => $this->fields,
        ];
    }

    /**
     * Convert the template instance to JSON.
     *
     * @param  int  $options
     * @return string
     * 
     * @throws \Services\ElasticEmail\Exception\JsonEncodingException
     */
    public function toJson($options = 0) 
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw JsonEncodingException::forTemplate($this, json_last_error_msg());
        }

        return $json;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Set the filled field value
     *
     * @param string $fieldName
     * @param mixed $value
     * @return self
     */
    protected function setFieldValue(string $fieldName, $value)
    {
        return $this->fields([$fieldName => $value]);
    }

    /**
     * Determine if this field is registered in the template.
     *
     * @param string $fieldName
     * @return bool
     */
    protected function existField(string $fieldName)
    {
        return Arr::exists($this->fields, $fieldName);
    }

    /**
     * Checks if this method is a setter of a template field
     *
     * @param string $methodName
     * @return bool
     */
    protected function isFieldSetterMethod(string $methodName)
    {
        return Str::startsWith($methodName, 'set') && Str::endsWith($methodName, 'Field');
    }

    /**
     * Formats the method name to match the template field name
     *
     * @param string $methodName
     * @return string|Str
     */
    protected function toFieldNameFormat(string $methodName)
    {
        return Str::of($methodName)
            ->ltrim('set')
            ->rtrim('Field')
            ->snake();
    }

    /**
     * Formats the method name to match the template field name
     *
     * @param string $methodName
     * @return string|Str
     */
    protected function callFieldSetter(string $methodName, $parameters)
    {
        $fieldName = (string) $this->toFieldNameFormat($methodName);

        if (! $this->existField($fieldName)) static::throwBadMethodCallException($methodName);

        return $this->setFieldValue(
            $fieldName,
            Arr::first($parameters)
        );
    }

    /**
     * Handle dynamic method calls into the class.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     * 
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        try {
            if($this->isFieldSetterMethod($method)) {
                $this->callFieldSetter($method, $parameters);
            }
        } catch (Error | BadMethodCallException $e) {
            $pattern = '~^Call to undefined method (?P<class>[^:]+)::(?P<method>[^\(]+)\(\)$~';
            
            if (!preg_match($pattern, $e->getMessage(), $matches)) {
                throw $e;
            }

            if (
                $matches['class'] != get_class($this) ||
                $matches['method'] != $method
            ) {
                throw $e;
            }

            static::throwBadMethodCallException($method);
        }
    }

    /**
     * Handle dynamic static method calls into the class.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

    /**
     * Throw a bad method call exception for the given method.
     *
     * @param  string  $method
     * @return void
     *
     * @throws \BadMethodCallException
     */
    protected static function throwBadMethodCallException($method)
    {
        throw new BadMethodCallException(sprintf(
            'Call to undefined method %s::%s()',
            static::class,
            $method
        ));
    }

}
