<?php

namespace App\Http\Controllers\API\Post\PostTypes;

use App\Http\Controllers\ApiController;
use App\Http\Resources\PostType\PostTypeResource;
use App\Http\Resources\PostType\PostTypeResourceCollection;
use App\Jobs\PostType\PostTypeCreate;
use App\Models\PostType\PostType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PostTypeApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = PostTypeResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = PostTypeResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\PostType\PostType $postType
     */
    public function __construct( PostType $postType )
    {
        //$this->middleware('auth:api');
        $this->model = $postType;
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

        $postType = PostTypeCreate::dispatchNow(
            $request->only([
                PostType::COLUMN_SLUG,
                PostType::COLUMN_NAME,
                PostType::COLUMN_DESCRIPTION,
            ])
        );

        //Categories
        $postType->categories()->sync($request->categories);

        //Meta
        $postType->meta()->attach($request->meta, [
            "value" => $request->value,
            "action" => 'markup'
        ]);

        //Taxonomies
        $postType->taxonomy()->sync($request->taxonomies);

        return $this->resource(
            $postType
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
            return $this->response()->json("Not found post type with this ID!");
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
            $postType = $this->model->findOrFail($id);
            //Categories
            if ($request->categories)
            {
                $postType->categories()->sync($request->categories);
            }
            //Meta
            if ($request->meta)
            {
                $postType->meta()->detach();
                $postType->meta()->attach($request->meta, [
                    "value" => $request->value,
                    "action" => 'markup'
                ]);
            }
            //Taxonomies
            if ($request->taxonomies)
            {
                $postType->taxonomy()->sync($request->taxonomies);
            }

            return $this->success(
                [
                    'update' => $postType->update(
                        $request->except(
                            PostType::COLUMN_SLUG
                        )
                    ),
                    'PostType' => $this->resource($postType->refresh())
                ],
                'PostType was successfully updated!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found post type with this ID!");
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
            $postType = $this->model->findOrFail($id);
            //Categories
            $postType->categories()->detach();
            //Meta
            $postType->meta()->detach();
            //Taxonomies
            $postType->taxonomy()->detach();
            $postType->delete();

            return $this->success(
                [
                    "postType_id" => $id,
                    "destroyed" => $postType
                ],
                'The PostType has been successfully deleted from the database!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found post type with this ID!");
        }

    }

}
