<?php

namespace App\Http\Controllers\API\Taxonomy;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Taxonomy\TaxonomyResource;
use App\Http\Resources\Taxonomy\TaxonomyResourceCollection;
use App\Jobs\Taxonomy\TaxonomyCreate;
use App\Models\Status\Common\ActiveStatus;
use App\Models\Taxonomy\Taxonomy;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TaxonomyApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = TaxonomyResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = TaxonomyResourceCollection::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var Taxonomy
     */
    protected $model;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\Taxonomy\Taxonomy $taxonomy
     */
    public function __construct( Taxonomy $taxonomy )
    {
        //$this->middleware('auth:api');
        $this->model = $taxonomy;
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
            TaxonomyCreate::dispatchNow(
                $request->only([
                    Taxonomy::COLUMN_SLUG,
                    Taxonomy::COLUMN_NAME,
                    Taxonomy::COLUMN_DESCRIPTION
                ])
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
            return $this->response()->json("Not found taxonomy with this ID!");
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
            $taxonomy = $this->model->findOrFail($id);

            return $this->success([
                'update' => $taxonomy->update(
                    $request->only([
                        Taxonomy::COLUMN_SLUG,
                        Taxonomy::COLUMN_NAME,
                        Taxonomy::COLUMN_DESCRIPTION,
                        Taxonomy::COLUMN_STATUS_ID
                    ])
                ),
                'taxonomy' => $this->resource($taxonomy->refresh())
            ],
                'Taxonomy data was successfully updated!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found taxonomy with this ID!");
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
            $taxonomy = $this->model->findOrFail($id);
            $taxonomy->delete();

            return $this->success(
                [
                    "taxonomy_id" => $id,
                    "destroyed" => $taxonomy
                ],
                'The Taxonomy has been successfully deleted from the database!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found taxonomy with this ID!");
        }
    }

}
