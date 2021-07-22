<?php

namespace App\Http\Controllers\API\User\TenderApplication;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\TenderApplication\TenderApplication;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\TenderApplication\TenderApplicationResource;
use App\Http\Requests\Api\TenderApplication\TenderApplicationRequest;
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

        $this->model = $tenderApplication
            ->with([
                'tender',
                'status',
            ]);

        $this->textUserNotFound = "Not found user with this `id`!";
        $this->textTenderApplicationNotFound = "Not found user tender aplication with this `id`!";
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, int $user_id)
    {
        try {
            $user = User::findOrFail($user_id);
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->textUserNotFound);
        }

        return $this->collection(
            $user->tenderApplications()
                ->latest()
                ->paginate($this->perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \App\Http\Requests\Api\TenderApplication\TenderApplicationRequest  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function store(TenderApplicationRequest $request, int $user_id)
    {
        return $this->resource(
            factory(TenderApplication::class)->create([
                TenderApplication::COLUMN_TENDER_ID => $request->{TenderApplication::COLUMN_TENDER_ID},
                TenderApplication::COLUMN_STATUS_ID => $request->{TenderApplication::COLUMN_STATUS_ID},
            ])
        );
    }

}
