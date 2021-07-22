<?php

namespace App\Repositories\Kernel;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{

    /**
     * Get a new instance of the model.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getNew(array $attributes = array());

    /**
     * Get a model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel();

}
