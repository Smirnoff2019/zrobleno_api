<?php

namespace App\Repositories\Eloquent\Abilities;

use App\Models\PermissionRole\PermissionRole;
use App\Models\User\User;
use App\Schemes\Permission\PermissionSchema;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\Abilities\Interfaces\AbilityRepositoryInterface;
use App\Repositories\Kernel\Repository;

class AbilityRepository extends Repository implements AbilityRepositoryInterface
{

    protected $with = [

    ];
    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all of the models from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function all()
    {
        return request()->user()->role->permissions->pluck(PermissionSchema::COLUMN_SLUG)->toArray();
    }

    /**
     * Get all of the models pagination from the database.
     *
     * @param  int $perPage
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function allPagination(int $perPage = null)
    {
        //
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id)
    {
        //
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Request $request)
    {

    }

    /**
     * Update a record by its primary key in the database or throw an exception.
     *
     * @param  int $id
     * @param  Illuminate\Http\Request $request
     * @return int|bool
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update(int $id, Request $request)
    {
        //
    }

    /**
     * Delete a record by its primary key from the database or throw an exception.
     *
     * @param  int  $id
     * @return bool
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function destroy(int $id)
    {
        //
    }

}
