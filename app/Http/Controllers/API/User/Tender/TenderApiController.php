<?php

namespace App\Http\Controllers\API\User\Tender;

use App\Models\User\User;
use App\Models\Tender\Tender;
use App\Jobs\Tender\TenderCreate;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Tender\TenderRequest;
use App\Http\Resources\User\Tender\TenderResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\User\Tender\TenderResourceCollection;

class TenderApiController extends ApiController
{
    
    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = TenderResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = TenderResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('auth:api');
        $this->model = $user;
        $this->textUserNotFound = "No user with this `id` was found!";
        $this->textTenderNotFound = "No user tender with this `id` was found!";
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param  int  $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $user_id)
    {
        try {
            return $this->collection(
                $this->model
                    ->findOrFail($user_id)
                    ->tenders()
                    ->latest()
                    ->paginate($this->perPage)
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->textUserNotFound);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \App\Http\Requests\Api\Tender\TenderRequest  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TenderRequest $request, int $user_id)
    {
        try {
            return $this->resource(
                TenderCreate::dispatchNow(
                    $request->only([
                        Tender::COLUMN_NAME,
                        Tender::COLUMN_MAX_PARTICIPANTS,
                        Tender::COLUMN_PRICE,
                        Tender::COLUMN_PROJECT_ID,
                    ]),
                    $this->model->findOrFail($user_id)
                )
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->textUserNotFound);
        }
    }
}
