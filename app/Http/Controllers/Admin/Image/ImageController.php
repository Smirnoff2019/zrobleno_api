<?php

namespace App\Http\Controllers\Admin\Image;

use App\Filters\ImageFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Jobs\File\UploadFiles;
use App\Jobs\Image\ImageCreate;
use App\Models\File\File;
use App\Models\Image\Image;
use App\Models\ImagesGroup\ImagesGroup;

class ImageController extends Controller
{

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 50;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Image $image, array $routes, array $layouts)
    {
        $this->model = $image;
        
        $this->routes = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ImageFilter $filter)
    {
        return view($this->layouts->index, [
            'records' => $this->model->filter($filter)->latest()->paginate( $this->perPageCount($request) )
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
        $image = ImageCreate::dispatchNow(
                    $request->only([
                        Image::COLUMN_PARENT_ID,
                        Image::COLUMN_STATUS_ID,
                    ]),
                    UploadFiles::dispatchNow(
                        $request->file('image'),
                        $request->only([
                            File::COLUMN_TITLE,
                            File::COLUMN_DESCRIPTION,
                            File::COLUMN_SORT,
                        ]),
                        $request->user()
                    )
                );

        return redirect()
            ->route($this->routes->index)    
            ->with('success', $this->successCreateMessage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createGroup(Request $request, ImagesGroup $group)
    {
        $imagesGroup = $group->create($request->only('name'));

        return redirect()->back()->with('success', $this->successCreateMessage);
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
        return redirect()->route($this->routes->index);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Image $image)
    {
        return view($this->layouts->edit, ['record' => $image]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        
        $image->update($request->only(
            'images_group_id',
            'status_id',
            'parent_id'
        ));
        $image->file->update($request->only(
            'title',
            'description',
            'sort',
            'status_id',
        ));

        return back()->with('success', $this->successUpdateMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {   
        $image->delete($image);
        
        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}

