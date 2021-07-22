<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostResourceCollection;
use App\Models\Post\MenuPost;
use App\Models\Post\Post;
use Illuminate\Http\Request;

class MenuApiController extends ApiController
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
     * @param \App\Models\Post\MenuPost $menu
     */
    public function __construct( MenuPost $menu )
    {
        $this->model = $menu;
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
        $menu = factory(MenuPost::class)->create([
            MenuPost::COLUMN_SLUG        => $request->slug,
            MenuPost::COLUMN_TITLE       => $request->title,
            MenuPost::COLUMN_DESCRIPTION => $request->description,
            //MenuPost::COLUMN_CONTENT     => $request->text,
            //MenuPost::COLUMN_PARENT_ID   => $request->parent_id,
            MenuPost::COLUMN_IMAGE_ID    => $request->image_id,
            MenuPost::COLUMN_USER_ID     => $request->user_id,
        ]);

        //Categories
        //$menu->categories()->sync($request->categories);
        //Meta
        $menu->meta()->attach($request->meta, [
            "value" => $request->value,
            "action" => 'storage'
        ]);

        return $this->resource($menu);
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
