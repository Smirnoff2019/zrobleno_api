<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostResourceCollection;
use App\Models\Post\PagePost;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PageApiController extends ApiController
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
     * @param \App\Models\Post\PagePost $page
     */
    public function __construct( PagePost $page )
    {
        $this->model = $page;
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
        $page = factory(PagePost::class)->create([
            PagePost::COLUMN_SLUG        => $request->slug,
            PagePost::COLUMN_TITLE       => $request->title,
            PagePost::COLUMN_DESCRIPTION => $request->description,
            PagePost::COLUMN_CONTENT     => $request->text,
            PagePost::COLUMN_PARENT_ID   => $request->parent_id,
            PagePost::COLUMN_IMAGE_ID    => $request->image_id,
            PagePost::COLUMN_USER_ID     => $request->user_id,
        ]);

        //Categories
        $page->categories()->sync($request->categories);
        //Meta
        $page->meta()->attach($request->meta, [
            "value" => $request->value,
            "action" => 'storage'
        ]);

        return $this->resource($page);
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
