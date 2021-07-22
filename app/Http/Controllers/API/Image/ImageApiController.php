<?php

namespace App\Http\Controllers\API\Image;

use App\Filters\ImageFilter;
use App\Models\File\File;
use App\Models\Image\Image;
use App\Jobs\File\DeleteFiles;
use App\Jobs\File\UploadFiles;
use App\Jobs\Image\ImageCreate;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Image\ImageResource;
use App\Http\Requests\Api\Image\UpdateImageRequest;
use App\Http\Requests\Api\Image\UploadImageRequest;
use App\Http\Resources\Image\ImageResourceCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ImageApiController extends ApiController
{
    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 50;

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
     * The repository resource collections model namespace.
     *
     * @var \App\Models\Image\Image
     */
    protected $model;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\Image\Image $image
     */
    public function __construct(Image $image)
    {
        // $this->middleware('auth:api');
        $this->model = $image;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, ImageFilter $filter)
    {
        return $this->collection(
            $this->model
                ->filter($filter)
                ->paginate( $this->perPageCount($request) )
        );
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

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  Image $image
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Image $image)
    {
        return $this->resource($image);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \App\Http\Requests\Api\Image\UpdateImageRequest $request
     * @param int $file_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateImageRequest $request, int $file_id)
    {
        try {
            $image = $this->model->findOrFail($file_id);
            
            return $this->success(
                [
                    'update' => $image
                        ->update($request->only([
                            Image::COLUMN_PARENT_ID,
                            Image::COLUMN_STATUS_ID,
                        ])) 
                        && 
                        $image->file->update($request->only([
                            File::COLUMN_TITLE,
                            File::COLUMN_DESCRIPTION,
                            File::COLUMN_SORT,
                        ])),
                    'image' => $this->resource($image->refresh())
                ],
                'Image data was successfully updated!'
            );

        } catch (ModelNotFoundException $e) {
            return $this->notFound("No found image with this ID!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $file_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $file_id)
    {
        try {
            $image = $this->model->findOrFail($file_id);
            
            return DeleteFiles::dispatchNow($image->file) && $image->delete()
                ? $this->successMessage('Image was successfully deleted from database!')
                : $this->error();
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No found image with this ID!");
        }
    }

}

