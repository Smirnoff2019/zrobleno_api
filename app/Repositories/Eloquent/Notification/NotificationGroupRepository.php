<?php

namespace App\Repositories\Eloquent\Notification;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\Notification\Interfaces\NotificationGroupRepositoryInterface;
use App\Repositories\Kernel\Repository;
use App\Models\NotificationGroup\NotificationGroup;

class NotificationGroupRepository extends Repository implements NotificationGroupRepositoryInterface
{


    protected $with = [
        'templates',
        'templates.type',
        'templates.group',
        'templates.media.mediable'
    ];

    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(NotificationGroup $model)
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
        return $this->model
            ->with($this->with)
            ->get();
    }

    /**
     * Get all of the models pagination from the database.
     *
     * @param  int $perPage
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function allPagination(int $perPage = null)
    {
        return $this->model
            ->with($this->with)
            ->paginate($perPage ?? $this->perPage);
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(string $slug)
    {
        return $this->model->whereSlug($slug)
            ->with($this->with)
            ->firstOrFail();
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Request $request)
    {
        //
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
