<?php

namespace App\Http\Controllers\Admin\Avatar;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Avatar\Avatar;

class AvatarController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Avatar $avatar, array $routes, array $layouts)
    {
        $this->model = $avatar;
        
        $this->routes = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->model;

        $query = $query->when(
                $request->filled('gender'),
                function($query, $gender) use($request) {
                    return $query->where('gender', $request->get('gender'));
                }
            )
            ->when(
                $request->filled('color'),
                function($query, $color) use($request) {
                    return $query->where('color', $request->get('color'));
                }
            )
            ->when(
                $request->filled('status_id'),
                function($query, $status_id) use($request) {
                    return $query->where('status_id', $request->get('status_id'));
                }
            )
            ->when(
                $request->filled('sort_by'),
                function($query,$sortBy) use($request) {
                    switch ($request->get('sort_by', '')) {
                        case 'latest':
                            $query = $query->latest();
                            break;

                        case 'oldest':
                            $query = $query->oldest();
                            break;
                        
                        default:
                            $query->latest();
                            break;
                    }
                }
            );

        $records = $query->paginate($request->get('per_page') ?? $this->perPage);

        return view($this->layouts->index, [
            'records' => $records
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $avatar = $this->model->create($request->all());

        return redirect()
            ->route($this->routes->edit, $avatar->id)    
            ->with('success', $this->successCreateMessage);
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Avatar $avatar)
    {
        return view($this->layouts->edit, ['record' => $avatar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Avatar $avatar)
    {
        $avatar->update($request->all());

        return back()
            ->with('success', $this->successUpdateMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avatar $avatar)
    {   
        $avatar->delete($avatar);
        
        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}

