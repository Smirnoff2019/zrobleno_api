<?php

namespace App\Filters;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $query;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $query
     */
    public function apply(Builder $query)
    {
        $this->query = $query;

        foreach ($this->fields() as $field => $value) {
            $this->callFilterableMethod($field, $value);
        }
    }

    /**
     * @return void
     */
    public function callFilterableMethod($field, $value)
    {
        $method = Str::camel($field);
        
        if (method_exists($this, $method)) {
            call_user_func_array([$this, $method], (array)$value);
        }
    }

    /**
     * @return array
     */
    protected function fields(): array
    {
        return collect($this->request->all())->filter()
            ->mapWithKeys(function($item, $key) {
                return [trim($key) => is_string($item) ? trim($item) : $item];
            })
            ->filter()
            ->all();
    }
    
    /**
     * @param string $field
     * @param mixed  $value
     */
    public function searchBy(string $field, $value)
    {
        if(!$value) return;

        $this->callFilterableMethod($field, $value);
    }
}
