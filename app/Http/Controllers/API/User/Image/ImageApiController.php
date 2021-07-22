<?php

namespace App\Http\Controllers\API\User\Image;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Image\UploadImageRequest;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Image\ImageResourceCollection;
use App\Jobs\File\UploadFiles;
use App\Jobs\Image\ImageCreate;
use App\Models\File\File;
use App\Models\Image\Image;
use App\Models\User\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ImageApiController extends ApiController
{
    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = ImageResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = ImageResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\User\User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('auth:api');
        $this->model = $user;
        $this->textUserNotFound = "No user with this `id` was found!";
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param  int  $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $user_id)
    {
        try {
            return $this->collection(
                $this->model
                    ->findOrFail($user_id)
                    ->images()
                    ->latest()
                    ->paginate($this->perPage)
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->textUserNotFound);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \App\Http\Requests\Api\Image\UploadImageRequest $request
     * @param  int  $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UploadImageRequest $request, int $user_id)
    {
        try {
            return $this->resource(
                ImageCreate::dispatchNow(
                    $request->only([
                        Image::COLUMN_PARENT_ID,
                        Image::COLUMN_STATUS_ID,]),
                    UploadFiles::dispatchNow(
                        $request->file('image'),
                        $request->only([
                            File::COLUMN_TITLE,
                            File::COLUMN_DESCRIPTION,
                            File::COLUMN_SORT
                        ]),
                        $this->model->findOrFail($user_id)
                    )
                )

            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->textUserNotFound);
        }
    }
}
