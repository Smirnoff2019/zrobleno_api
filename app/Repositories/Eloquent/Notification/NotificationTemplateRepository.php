<?php

namespace App\Repositories\Eloquent\Notification;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\Notification\Interfaces\NotificationTemplateRepositoryInterface;
use App\Repositories\Kernel\Repository;
use App\Models\NotificationTemplate\NotificationTemplate;

class NotificationTemplateRepository extends Repository implements NotificationTemplateRepositoryInterface
{

    protected $with = [
        'type',
        'group',
        'media.mediable'
    ];

    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(NotificationTemplate $model)
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
        //
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
        return $this->model
            ->findOrFail($id);
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Request $request)
    {
        return $this->model->create($request->only(
            NotificationTemplate::COLUMN_NAME,
            NotificationTemplate::COLUMN_CONTENT,
            NotificationTemplate::COLUMN_SLUG,
            NotificationTemplate::COLUMN_TYPE_SLUG,
            NotificationTemplate::COLUMN_GROUP_SLUG,
            NotificationTemplate::COLUMN_COVER_ID,
            NotificationTemplate::COLUMN_STATUS_SLUG,
        ));
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

        return  $this->model->findOrFail($id)
            ->update($request->only(
                NotificationTemplate::COLUMN_NAME,
                NotificationTemplate::COLUMN_CONTENT,
                NotificationTemplate::COLUMN_SLUG,
                NotificationTemplate::COLUMN_TYPE_SLUG,
                NotificationTemplate::COLUMN_GROUP_SLUG,
                NotificationTemplate::COLUMN_COVER_ID,
                NotificationTemplate::COLUMN_STATUS_SLUG,

            )
            );
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

    public function whereGroup (string $group) {

    }

}
