<?php

namespace App\Repositories\Eloquent\Room;

use App\Models\Room\Room;
use Illuminate\Http\Request;
use App\Repositories\Kernel\Repository;
use App\Repositories\Eloquent\Room\Interfaces\RoomRepositoryInterface;

class RoomRepository extends Repository implements RoomRepositoryInterface
{

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
    ];

    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\Room\Room $room
     */
    public function __construct(Room $room)
    {
        parent::__construct($room);
    }

    /**
     * Get all of the models from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Room\Room[]
     */
    public function all()
    {
        return $this->model
            ->with($this->with)
            ->all();
    }

    /**
     * Get all of the models pagination from the database.
     *
     * @param  int $perPage
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Room\Room[]
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
     * @return \App\Models\Room\Room|\Illuminate\Database\Eloquent\Collection|static|static[]
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
     * @return \App\Models\Room\Room
     */
    public function create(Request $request)
    {
        return $this->model
            ->create($request->only([
                Room::COLUMN_NAME,
                Room::COLUMN_SLUG,
                Room::COLUMN_STATUS_ID,
            ]));
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
        return $this->model
            ->findOrFail($id)
            ->update($request->only([
                Room::COLUMN_NAME,
                Room::COLUMN_SLUG,
                Room::COLUMN_STATUS_ID,
            ]));
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
        return $this->model->destroy($id);
        return $this->model
            ->findOrFail($id)
            ->delete();
    }

}
