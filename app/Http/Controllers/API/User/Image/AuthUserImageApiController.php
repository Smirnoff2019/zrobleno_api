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
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AuthUserImageApiController extends ApiController
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
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->textUserNotFound = "This user not authorize!";
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            return $this->collection(
                $request->user()
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
     * @param \App\Http\Requests\Api\Image\UploadImageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UploadImageRequest $request)
    {
        return $this->resource(
            ImageCreate::dispatchNow(
                $request->only([
                    Image::COLUMN_PARENT_ID,
                    Image::COLUMN_STATUS_ID,
                ]),
                UploadFiles::dispatchNow(
                    $request->file('image'),
                    $request->only([
                        File::COLUMN_TITLE,
                        File::COLUMN_DESCRIPTION,
                        File::COLUMN_SORT,
                    ]),
                    $request->user()
                )
            )
        );
    }

}
