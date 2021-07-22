<?php

namespace App\Traits\Controller;

use App\Http\Resources\ApiResource;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ApiResourceCollection;

trait ResourceResponsible
{

    /**
     * The repository resource model namespace.
     *
     * @var \App\Http\Resources\ApiResource
     */
    protected $resourceName = ApiResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var \App\Http\Resources\ApiResourceCollection
     */
    protected $resourceCollectionName = ApiResourceCollection::class;

    /**
     * Return repository resource model class instance.
     *
     * @param Model $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function resource(Model $model)
    {
        return new $this->resourceName($model);
    }

    /**
     * Return repository resource collections model class instance.
     *
     * @param \Illuminate\Database\Eloquent\Collection[\Illuminate\Database\Eloquent\Model] $collection
     * @return \Illuminate\Http\JsonResponse
     */
    public function collection($collection)
    {
        return new $this->resourceCollectionName($collection);
    }
    
}
