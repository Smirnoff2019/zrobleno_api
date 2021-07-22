<?php

namespace App\Http\Controllers\API\Room;

use App\Models\Room\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Room\RoomResource;
use App\Http\Requests\Api\Room\RoomRequest;
use App\Http\Requests\Api\Room\RoomUpdateRequest;
use App\Http\Resources\Room\RoomResourceCollection;
use App\Repositories\Eloquent\Room\Interfaces\RoomRepositoryInterface;

class RoomController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = RoomResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = RoomResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Repositories\Eloquent\Room\Interfaces\RoomRepositoryInterface $room
     * @return void
     */
    public function __construct(RoomRepositoryInterface $room)
    {
        $this->repository = $room;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->collection(
            $this->repository->allPagination()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \App\Http\Requests\Api\Room\RoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        return $this->resource(
            $this->repository->create($request)
        );
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return $this->resource($room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoomUpdateRequest $request, Room $room)
    {
        return $this->success(
            [
                'update'    => $room->update($request->only([
                                        'name',
                                        'slug',
                                        'sort',
                                        'max_count',
                                        'default_count',
                                        'image_id',
                                        'status_id',
                                    ])),
                'room'      => $this->resource($room->refresh())
            ],
            'Room data was successfully updated!'
        );
    }

    /**
     * Remove the specified resource from databese.
     *
     * @method DELETE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        return $room->delete()
            ? $this->success(
                [
                    "id" => $room->id,
                    "destroyed" => $room
                ],
                'The room has been successfully deleted from the database!'
            )
            : $this->error();
    }

}
