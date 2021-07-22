<?php

namespace App\Http\Controllers\API\Meta;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Meta\MetaResource;
use App\Http\Resources\Meta\MetaResourceCollection;
use App\Jobs\Meta\MetaCreate;
use App\Models\Meta\Meta;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MetaApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = MetaResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = MetaResourceCollection::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var Meta
     */
    protected $model;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\Meta\Meta $meta
     */
    public function __construct( Meta $meta )
    {
        //$this->middleware('auth:api');
        $this->model = $meta;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store( Request $request )
    {

        return $this->resource(
            MetaCreate::dispatchNow(
                $request->all()
            )
        );

    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( int $id )
    {
        try {
            return $this->resource(
                $this->model->findOrFail($id)
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found meta with this ID!");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \App\Http\Response\Template\SuccessResponse
     */
    public function update( Request $request, int $id )
    {
        try {
            $meta = $this->model->findOrFail($id);

            return $this->success([
                'update' => $meta->update(
                    $request->only([
                        Meta::COLUMN_SLUG,
                        Meta::COLUMN_NAME,
                        Meta::COLUMN_DESCRIPTION,
                        Meta::COLUMN_PARENT_ID,
                        Meta::COLUMN_META_FIELD_ID,
                    ])
                ),
                'meta' => $this->resource($meta->refresh())
            ],
                'Meta data was successfully updated!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found meta with this ID!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param int $id
     * @return \App\Http\Response\Template\SuccessResponse
     */
    public function destroy( int $id )
    {
        try {
            $meta = $this->model->findOrFail($id);

            return $this->success(
                [
                    "meta_id" => $id,
                    "destroyed" => $meta
                ],
                'The Meta has been successfully deleted from the database!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found meta with this ID!");
        }
    }

}
