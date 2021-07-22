<?php

namespace App\Http\Controllers\API\File;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\File\CreateFileRequest;
use App\Http\Requests\Api\File\UpdateFileRequest;
use App\Http\Resources\File\FileResource;
use App\Http\Resources\File\FileResourceCollection;
use App\Http\Response\Template\SuccessResponse;
use App\Jobs\File\DeleteFiles;
use App\Jobs\File\UploadFiles;
use App\Models\File\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FileApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = FileResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = FileResourceCollection::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var File
     */
    protected $model;

    /**
     * Instantiate a new controller instance.
     *
     * @param File $file
     */
    public function __construct( File $file )
    {
        $this->middleware('auth:api');
        $this->model = $file;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->collection(
            $this->model
                ->latest()
                ->paginate($this->perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param CreateFileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateFileRequest $request)
    {
        try {
            return $this->resource(
                UploadFiles::dispatchNow(
                    $request->file('file'),
                    $request->only([
                        File::COLUMN_TITLE,
                        File::COLUMN_DESCRIPTION,
                        File::COLUMN_SORT,
                    ]), 
                    $request->user()
                )
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No file with this ID found!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            return $this->resource(
                $this->model->findOrFail($id)
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound("Not found file with this ID!");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \App\Http\Requests\Api\File\UpdateFileRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateFileRequest $request, int $id)
    {
        try {
            $file = $this->model->findOrFail($id);

            return $this->success([
                    'update' => $file->update(
                            $request->only([
                                File::COLUMN_TITLE,
                                File::COLUMN_DESCRIPTION,
                                File::COLUMN_SORT,
                                File::COLUMN_STATUS_ID,
                            ])
                        ),
                    'file' => $this->resource($file->refresh())
                ],
                'File data was successfully updated!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound("Not found file with this ID!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param int $id
     * @return SuccessResponse
     */
    public function destroy(int $id)
    {
        try {
            return DeleteFiles::dispatchNow($this->model->findOrFail($id)) 
                ? $this->successMessage('File was successfully deleted from database!')
                : $this->errorMessage('File did not deleted from database!');
        } catch (ModelNotFoundException $e) {
            return $this->notFound("Not found file with this ID!");
        }
    }

}
