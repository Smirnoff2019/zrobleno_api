<?php

namespace App\Repositories\Kernel;

use Illuminate\Database\Eloquent\Model;


abstract class Repository implements RepositoryInterface
{

    /**
     * The model to execute queries on.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    public $perPage = 25;

    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The model to execute queries on
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get a new instance of the model.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getNew(array $attributes = array())
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * Get a model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

}
