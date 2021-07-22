<?php

namespace App\Http\Controllers\API\SupplierCategory;

use App\Http\Controllers\ApiController;
use App\Models\SupplierCategory\SupplierCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\SupplierCategory\SupplierCategoryResource;
use App\Http\Requests\Api\SupplierCategory\SupplierCategoryRequest;
use App\Http\Requests\Api\SupplierCategory\SupplierCategoryIndexRequest;
use App\Http\Requests\Api\SupplierCategory\SupplierCategoryUpdateRequest;
use App\Http\Resources\SupplierCategory\SupplierCategoryResourceCollection;

class SupplierCategoryApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = SupplierCategoryResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = SupplierCategoryResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\SupplierCategory\SupplierCategory $category
     * @return void
     */
    public function __construct(SupplierCategory $category)
    {
        $this->middleware('auth:api');
        $this->model = $category->with([
            'status',
        ]);

        $this->notFoundMessage = "No supplier categories with this ID found!";
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param  SupplierCategoryIndexRequest $request
     * @return JsonResponse
     */
    public function index(SupplierCategoryIndexRequest $request)
    {
        return $this->collection(
            $this->model
                ->when(
                    $request->filled('name'), 
                    function($query) use($request) {
                        return $query->where(SupplierCategory::COLUMN_NAME, 'like', "%{$request->name}%");
                    }
                )
                ->when(
                    $request->filled('slug'), 
                    function($query) use($request) {
                        return $query->where(SupplierCategory::COLUMN_SLUG, 'like', "%{$request->slug}%");
                    }
                )
                ->when(
                    $request->filled('orderBy') && $request->filled('direction'), 
                    function($query) use($request) {
                        return $query->orderBy(
                            $request->orderBy,
                            $request->direction,
                        );
                    }
                )
                ->unless(
                    $request->filled('orderBy'), 
                    function($query) use($request) {
                        return $query->latest();
                    }
                )
                ->paginate($request->perPage ?? $this->perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  SupplierCategoryRequest  $request
     * @return JsonResponse
     */
    public function store(SupplierCategoryRequest $request)
    {
        return $this->resource(
            factory(SupplierCategory::class)->create($request->only([
                'name',
                'slug',
                'status_id',
            ]))
        );
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int $category_id
     * @return JsonResponse
     */
    public function show(SupplierCategory $category)
    {
        return $this->resource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  SupplierCategoryUpdateRequest $request
     * @param  int $category_id
     * @return JsonResponse
     */
    public function update(SupplierCategoryUpdateRequest $request, int $category_id)
    {
        try {
            $category = $this->model
                ->findOrFail($category_id);

            return $this->success(
                [
                    'update' => $category->update($request->only([
                        'name',
                        'slug',
                        'status_id',
                    ])),
                    'categories' => $this->resource($category->refresh())
                ],
                'Supplier categories data was successfully updated!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->notFoundMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int $category_id
     * @return JsonResponse
     */
    public function destroy(int $category_id)
    {
        try {
            $result = $this->model
                ->findOrFail($category_id)
                ->delete();

            return $result
                ? $this->success(
                    [
                        "category_id" => $category_id,
                        "destroyed" => $result
                    ],
                    'The supplier categories has been successfully deleted from the database!'
                )
                : $this->error();
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->notFoundMessage);
        }
    }

}
