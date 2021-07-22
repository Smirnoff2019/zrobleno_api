<?php

namespace App\Http\Controllers\API\Meta\MetaField;

use App\Http\Controllers\ApiController;
use App\Http\Resources\MetaField\MetaFieldResource;
use App\Http\Resources\MetaField\MetaFieldResourceCollection;
use App\Models\MetaField\MetaField;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MetaFieldApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = MetaFieldResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = MetaFieldResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\MetaField\MetaField $metaField
     */
    public function __construct( MetaField $metaField )
    {
        //$this->middleware('auth:api');
        $this->model = $metaField;
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
        $this->model = factory(MetaField::class)->create($request->only([
            MetaField::COLUMN_SLUG,
            MetaField::COLUMN_NAME,
            MetaField::COLUMN_DESCRIPTION,
            MetaField::COLUMN_OPTIONS
        ]));

        return $this->resource(
            $this->model
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( int $id )
    {

        try {
            return $this->resource(
                $this->model->findOrFail( $id )
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found meta field with this ID!");
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
            $metaField = $this->model->findOrFail($id);

            return $this->success(
                [
                    'update' => $metaField->update(
                        $request->only([
                            MetaField::COLUMN_SLUG,
                            MetaField::COLUMN_NAME,
                            MetaField::COLUMN_DESCRIPTION,
                            MetaField::COLUMN_OPTIONS
                        ])
                    ),
                    'MetaField' => $this->resource($metaField)
                ],
                'MetaField was successfully updated!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found meta field with this ID!");
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
            $metaField = $this->model->findOrFail($id);
            $metaField->delete();

            return $this->success(
                [
                    "metaField_id" => $id,
                    "destroyed" => $metaField
                ],
                'The MetaField has been successfully deleted from the database!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found meta field with this ID!");
        }

    }

}
