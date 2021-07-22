<?php

namespace App\Http\Controllers\API\TenderApplication;

use Illuminate\Http\Request;
use App\Models\Status\Status;
use App\Http\Controllers\ApiController;
use App\Models\TenderApplication\TenderApplication;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\TenderApplication\TenderApplicationResource;
use App\Http\Requests\Api\TenderApplication\TenderApplicationRequest;
use App\Http\Requests\Api\TenderApplication\TenderApplicationUpdateRequest;
use App\Http\Resources\TenderApplication\TenderApplicationResourceCollection;

class TenderApplicationApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = TenderApplicationResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = TenderApplicationResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\TenderApplication\TenderApplication $tenderApplication
     * @return void
     */
    public function __construct(TenderApplication $tenderApplication)
    {
        $this->middleware('auth:api');
        $this->model = $tenderApplication->with([
            'tender',
            'status',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TenderApplicationRequest $request)
    {
        return $this->resource(
            factory(TenderApplication::class)->create([
                TenderApplication::COLUMN_TENDER_ID => $request->{TenderApplication::COLUMN_TENDER_ID},
                TenderApplication::COLUMN_STATUS_ID => $request->{TenderApplication::COLUMN_STATUS_ID},
            ])
        );
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            return $this->resource(
                $this->model->findOrFail($id)
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No tender application with this ID found!");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TenderApplicationUpdateRequest $request, int $id)
    {
        
        try {
            $tenderApplication = $this->model
                ->findOrFail($id);
            $tenderApplication
                ->status()
                ->associate(Status::find($request->{TenderApplication::COLUMN_STATUS_ID}));

            return $this->resource($tenderApplication);
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No tender application with this ID found!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            $result = $this->model
                ->findOrFail($id)
                ->delete();

            return $result
                ? $this->success(
                    [
                        "id" => $id,
                        "destroyed" => $result
                    ],
                    'The tender application has been successfully deleted from the database!'
                )
                : $this->error();
        } catch (ModelNotFoundException $e) {
            return $this->notFound("No tender application with this ID found!");
        }
    }

}
