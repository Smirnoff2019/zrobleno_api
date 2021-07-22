<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Post\PostCategoryResourceCollection;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostResourceCollection;
use App\Models\Category\BlogCategory;
use App\Models\Post\BlogPost;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BlogApiController extends ApiController
{

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
     * @var Post
     */
    protected $model;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\Post\BlogPost $blog
     */
    public function __construct( BlogPost $blog )
    {
        $this->model = $blog;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param Request $request
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
                BlogCategory::whereNull(BlogCategory::COLUMN_PARENT_ID)->get()
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
        $blog = factory(BlogPost::class)->create([
            BlogPost::COLUMN_SLUG        => $request->slug,
            BlogPost::COLUMN_TITLE       => $request->title,
            BlogPost::COLUMN_DESCRIPTION => $request->description,
            BlogPost::COLUMN_CONTENT     => $request->text,
            BlogPost::COLUMN_PARENT_ID   => $request->parent_id,
            BlogPost::COLUMN_IMAGE_ID    => $request->image_id,
            BlogPost::COLUMN_USER_ID     => $request->user_id,
        ]);

        //Categories
        $blog->categories()->sync($request->categories);
        //Meta
        $blog->meta()->attach($request->meta, [
            "value" => $request->value,
            "action" => 'storage'
        ]);

        return $this->resource($blog);
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
