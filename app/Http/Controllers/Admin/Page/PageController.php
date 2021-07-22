<?php

namespace App\Http\Controllers\Admin\Page;

use App\Filters\PageFilter;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Post\PagePost;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\Factory;
use App\Models\MetaField\MetaFieldsGroup;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Contracts\Foundation\Application;

class PageController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @param PagePost $page
     * @param array $routes
     * @param array $layouts
     */
    public function __construct( PagePost $page, array $routes, array $layouts )
    {
        $this->model = $page;

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
    public function index( Request $request, PageFilter $filter )
    {
        $records = $this->model
            ->filter($filter)
            ->paginate( $this->perPageCount($request) );
//        if($request->filled('category_id'))
//        {
//            $query = $query->whereHas('categories', function (Builder $query) use($request) {
//                return $query->where('category_id', $request->get('category_id'));
//            });
//        }

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
    public function store( Request $request )
    {
        $page = $this->model->create($request->only([
            'title',
            'slug',
            'description',
            'content',
            'image_id',
            'status_id',
        ]));
//        if($request->get('categories', null))
//        {
//            $page->categories()->sync($request->categories);
//        }

        return redirect()
            ->route($this->routes->edit, $page->id)
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
     * @param PagePost $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit( Request $request, PagePost $page )
    {
        return view($this->layouts->edit, ['record' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param PagePost $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( Request $request, PagePost $page )
    {
        $page->update($request->all());

//        if($request->get('categories', null)) {
//            $page->categories()->sync($request->categories);
//        }

        return back()->with('success', $this->successUpdateMessage)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param PagePost $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy( PagePost $page )
    {
        $page->delete($page);

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}
