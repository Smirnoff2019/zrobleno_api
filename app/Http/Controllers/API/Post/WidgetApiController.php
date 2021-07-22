<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostResourceCollection;
use App\Models\Post\Post;
use App\Models\Post\WidgetPost;
use Illuminate\Http\Request;

class WidgetApiController extends ApiController
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
     * @param \App\Models\Post\WidgetPost $widget
     */
    public function __construct( WidgetPost $widget )
    {
        $this->model = $widget;
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

        $widget = factory(WidgetPost::class)->create([
            WidgetPost::COLUMN_SLUG        => $request->slug,
            WidgetPost::COLUMN_TITLE       => $request->title,
            WidgetPost::COLUMN_DESCRIPTION => $request->description,
            //WidgetPost::COLUMN_CONTENT     => $request->text,
            //WidgetPost::COLUMN_PARENT_ID   => $request->parent_id,
            WidgetPost::COLUMN_IMAGE_ID    => $request->image_id,
            WidgetPost::COLUMN_USER_ID     => $request->user_id,
        ]);

        //Categories
        //$widget->categories()->sync($request->categories);
        //Meta
        $widget->meta()->attach($request->meta, [
            "value" => $request->value,
            "action" => 'storage'
        ]);

        return $this->resource($widget);
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
