<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostResourceCollection;
use App\Jobs\Post\PostCreate;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PostApiController extends ApiController
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
     * @param \App\Models\Post\Post $post
     */
    public function __construct( Post $post )
    {
        //$this->middleware('auth:api');
        $this->model = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return $this->collection(
            $this->model
                ->latest()
                ->paginate($request->get('per_page', $this->perPage))
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
        $post = PostCreate::dispatchNow(
                    $request->only([
                        Post::COLUMN_SLUG,
                        Post::COLUMN_TITLE,
                        Post::COLUMN_DESCRIPTION,
                        Post::COLUMN_CONTENT,
                        Post::COLUMN_POST_TYPE,
                        Post::COLUMN_PARENT_ID,
                        Post::COLUMN_IMAGE_ID,
                        Post::COLUMN_USER_ID,
                        Post::COLUMN_STATUS_ID
                    ])
                );


        //Categories
        $post->categories()->sync($request->categories);
        //Meta
        $post->meta()->attach($request->meta, [
            "value" => $request->value,
            "action" => 'storage'
        ]);

        return $this->resource($post);
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
            return $this->response()->json("Not found post with this ID!");
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
            $post = $this->model->findOrFail($id);
            //Categories
            if ($request->categories)
            {
                $post->categories()->sync($request->categories);
            }
            //Meta
            if ($request->meta)
            {
                $post->meta()->attach($request->meta, [
                    "value" => $request->value,
                    "action" => 'storage'
                ]);
            }

            return $this->success([
                'update' => $post->update(
                    $request->only([
                        Post::COLUMN_SLUG,
                        Post::COLUMN_TITLE,
                        Post::COLUMN_DESCRIPTION,
                        Post::COLUMN_CONTENT,
                        Post::COLUMN_POST_TYPE,
                        Post::COLUMN_PARENT_ID,
                        Post::COLUMN_IMAGE_ID,
                        Post::COLUMN_USER_ID,
                        Post::COLUMN_STATUS_ID
                    ])
                ),
                'post' => $this->resource($post->refresh())
            ],
                'Post data was successfully updated!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found post with this ID!");
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
            $post = $this->model->findOrFail($id);
            //Categories
            $post->categories()->detach();
            //Meta
            $post->meta()->detach();
            $post->delete();

            return $this->success(
                [
                    "post_id" => $id,
                    "destroyed" => $post
                ],
                'The Post has been successfully deleted from the database!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->response()->json("Not found post with this ID!");
        }
    }

}
