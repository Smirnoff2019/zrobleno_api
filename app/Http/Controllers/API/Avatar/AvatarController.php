<?php

namespace App\Http\Controllers\API\Avatar;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Avatar\AvatarResource;
use App\Http\Resources\Avatar\AvatarResourceCollection;
use App\Models\Avatar\Avatar;

class AvatarController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = AvatarResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = AvatarResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param Avatar $avatar
     * @return void
     */
    public function __construct(Avatar $avatar)
    {
        $this->model = $avatar->with('image.file', 'status');
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
                $request->filled('sort_by'),
                function($query,$sortBy) use($request) {
                    echo '<pre>$sortBy => <br />'; print_r($sortBy); echo '</pre>';
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
        // dd($records->toArray());
        return $this->collection(
            $records
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->resource(
            $this->model->create($request->only([
                'name',
                'gender',
                'color',
                'group',
                'image_id',
                'status_id',
            ]))
        );
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Avatar $avatar)
    {
        return $this->resource($avatar);
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
        return $this->success(
            [
                'update'    => $avatar->update($request->only([
                                        'name',
                                        'gender',
                                        'color',
                                        'group',
                                        'image_id',
                                        'status_id',
                                    ])),
                'avatar'      => $this->resource($avatar->refresh())
            ],
            'Avatar data was successfully updated!'
        );
    }

    /**
     * Remove the specified resource from databese.
     *
     * @method DELETE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avatar $avatar)
    {
        return $avatar->delete()
            ? $this->success(
                [
                    "id" => $avatar->id,
                    "destroyed" => $avatar
                ],
                'The avatar has been successfully deleted from the database!'
            )
            : $this->error();
    }

}
