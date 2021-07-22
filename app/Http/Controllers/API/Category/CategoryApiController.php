<?php

namespace App\Http\Controllers\API\Category;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryResourceCollection;
use App\Jobs\Category\CategoryCreate;
use App\Models\Category\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = CategoryResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = CategoryResourceCollection::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var Category
     */
    protected $model;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\Category\Category $category
     */
    public function __construct( Category $category )
    {
        //$this->middleware('auth:api');
        $this->model = $category;
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

        $category = CategoryCreate::dispatchNow(
            $request->only([
                Category::COLUMN_SLUG,
                Category::COLUMN_NAME,
                Category::COLUMN_DESCRIPTION,
                Category::COLUMN_PARENT_ID,
                Category::COLUMN_USER_ID,
                Category::COLUMN_IMAGE_ID,
                Category::COLUMN_STATUS_ID,
            ])
        );
        //Meta
        if ($request->meta)
        {
            $category->meta()->attach($request->meta, [
                "value" => $request->value,
                "action" => $request->action
            ]);
        }
        //Taxonomies
        $category->taxonomy()->sync($request->taxonomies);

        return $this->resource(
            $category
        );

    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( int $id )
    {
        try {
            return $this->resource(
                $this->model->findOrFail($id)
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found categories with this ID!");
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
            $category = $this->model->findOrFail($id);
            //Meta
            if ($request->meta)
            {
                $category->meta()->detach();
                $category->meta()->attach($request->meta, [
                    "value" => $request->value,
                    "action" => $request->action
                ]);
            }
            //Taxonomy
            if ($request->taxonomies)
            {
                $category->taxonomy()->detach();
                $category->taxonomy()->sync($request->taxonomies);
            }

            return $this->success([
                'update' => $category->update(
                    $request->only([
                        Category::COLUMN_SLUG,
                        Category::COLUMN_NAME,
                        Category::COLUMN_DESCRIPTION,
                        Category::COLUMN_PARENT_ID,
                        Category::COLUMN_USER_ID,
                        Category::COLUMN_IMAGE_ID,
                        Category::COLUMN_STATUS_ID,
                    ])
                ),
                'categories' => $this->resource($category->refresh())
            ],
                'Category data was successfully updated!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found categories with this ID!");
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
            $category = $this->model->findOrFail($id);
            //Meta
            $category->meta()->detach();
            //Taxonomy
            $category->taxonomy()->detach();
            $category->delete();

            return $this->success(
                [
                    "category_id" => $id,
                    "destroyed" => $category
                ],
                'The Category has been successfully deleted from the database!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found categories with this ID!");
        }
    }

}
