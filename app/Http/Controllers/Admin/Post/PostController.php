<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post\BlogPost;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PostController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @param BlogPost $post
     * @param array $routes
     * @param array $layouts
     */
    public function __construct(BlogPost $post, array $routes, array $layouts)
    {
        $this->model = $post;
        
        $this->routes = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param Request $request
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {

        $query = $this->model;
        if($request->filled('category_id')) {
            $query = $query->whereHas('categories', function (Builder $query) use($request) {
                return $query->where('category_id', $request->get('category_id'));
            });
        }
        $records = $query->latest()->paginate(50);

        return view($this->layouts->index, ['records' => $records]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @method GET
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view($this->layouts->create);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $post = $this->model->create($request->all());

        return redirect()
            ->route($this->routes->edit, $post->id)
            ->with('success', $this->successCreateMessage);
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @method GET
     * @param Request $request
     * @param BlogPost $post
     * @return Application|Factory|Response|View
     */
    public function edit(Request $request, BlogPost $post)
    {
        return view($this->layouts->edit, ['record' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param BlogPost $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BlogPost $post)
    {

        $post->update($request->all());

        if($request->get('categories', null)) {
            $post->categories()->sync($request->categories);
        }

        return back()->with('success', $this->successUpdateMessage)->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param BlogPost $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(BlogPost $post)
    {

        $post->delete($post);

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);

    }

}
