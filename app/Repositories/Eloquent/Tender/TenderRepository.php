<?php

namespace App\Repositories\Eloquent\Tender;

use Illuminate\Http\Request;
use App\Models\Tender\Tender;
use App\Repositories\Kernel\EloquentRepository;
use App\Http\Response\Template\NotFoundResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Eloquent\Tender\Interfaces\TenderRepositoryInterface;

class TenderRepository extends EloquentRepository implements TenderRepositoryInterface
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
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Tender $tender)
    {
        parent::__construct($tender);
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
            // ->latest()
            ->all();
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
            // ->latest()
            ->paginate($perPage ?? $this->perPage);
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  int|array[int] $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id)
    {
        return $this->model
            ->with($this->with)
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
