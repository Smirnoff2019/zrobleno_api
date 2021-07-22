<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Post\PostCategoryResourceCollection;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostResourceCollection;
use App\Models\Category\PortfolioCategory;
use App\Models\Post\PortfolioPost;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PortfolioApiController extends ApiController
{

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 8;

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = PostResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = PostResourceCollection::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var PortfolioPost
     */
    protected $model;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\Post\PortfolioPost $portfolio
     */
    public function __construct( PortfolioPost $portfolio )
    {
        $this->model = $portfolio;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = $this->model;

        if($request->filled('category_id')) {
            $query = $query->whereHas('categories', function (Builder $query) use($request) {
                return $query->where('category_id', $request->get('category_id'));
            });
        }

        return $this->collection(
                        $query->latest()->paginate($request->get('per_page', $this->perPage))
                    )->additional([
                        'categories' => new PostCategoryResourceCollection(
                            PortfolioCategory::whereNull(PortfolioCategory::COLUMN_PARENT_ID)->get()
                        )
                    ]);
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
        $portfolio = factory(PortfolioPost::class)->create([
            PortfolioPost::COLUMN_SLUG        => $request->slug,
            PortfolioPost::COLUMN_TITLE       => $request->title,
            PortfolioPost::COLUMN_DESCRIPTION => $request->description,
            PortfolioPost::COLUMN_CONTENT     => $request->text,
            PortfolioPost::COLUMN_PARENT_ID   => $request->parent_id,
            PortfolioPost::COLUMN_IMAGE_ID    => $request->image_id,
            PortfolioPost::COLUMN_USER_ID     => $request->user_id,
        ]);

        //Categories
        $portfolio->categories()->sync($request->categories);
        //Meta
        $portfolio->meta()->attach($request->meta, [
            "value" => $request->value,
            "action" => 'storage'
        ]);

        return $this->resource($portfolio);
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
        return $this->resource(
            $this->model->findOrFail($id)
        );
    }

}
