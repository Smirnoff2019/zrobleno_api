<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostResourceCollection;
use App\Models\Post\FormPost;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FormApiController extends ApiController
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
     * @param \App\Models\Post\FormPost $form
     */
    public function __construct( FormPost $form )
    {
        //$this->middleware('auth:api');
        $this->model = $form;
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
        $form = factory(FormPost::class)->create([
            FormPost::COLUMN_SLUG        => $request->slug,
            FormPost::COLUMN_TITLE       => $request->title,
            FormPost::COLUMN_DESCRIPTION => $request->description,
            FormPost::COLUMN_CONTENT     => $request->text,
            FormPost::COLUMN_PARENT_ID   => $request->parent_id,
            FormPost::COLUMN_IMAGE_ID    => $request->image_id,
            FormPost::COLUMN_USER_ID     => $request->user_id,
        ]);

        //Categories
        $form->categories()->sync($request->categories);
        //Meta
        $form->meta()->attach($request->meta, [
            "value" => $request->value,
            "action" => 'storage'
        ]);

        return $this->resource($form);
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
            return $this->response()->json("Not found portfolio with this ID!");
        }
    }

}
