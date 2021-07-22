<?php

namespace App\Http\Controllers\API\Complaint\ComplaintResponse;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Complaint\ComplaintResource;
use App\Http\Resources\Complaint\ComplaintResourceCollection;
use App\Jobs\Complaint\AnswerCreate;
use App\Models\Complaint\Complaint;
use App\Models\Status\Complaint\RejectedStatus;
use App\Models\Status\Complaint\SatisfiedStatus;
use App\Models\User\User;
use Illuminate\Http\Request;

class ComplaintResponseApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = ComplaintResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = ComplaintResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param \App\Models\User\User $user
     * @return void
     */
    public function __construct( User $user  )
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param Request $request
     * @param \App\Models\User\User $user
     * @param \App\Models\Complaint\Complaint $complaint
     * @return \Illuminate\Http\JsonResponse
     */
    public function index( Request $request, User $user )
    {
        return $this->collection(
            $user->answers()->paginate($request->perPage ?? $this->perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User\User $user
     * @param \App\Models\Complaint\Complaint $complaint
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, User $user, Complaint $complaint)
    {
        return $this->resource(
            AnswerCreate::dispatchNow(
                $request->only([
                    Complaint::COLUMN_SUBJECT,
                    Complaint::COLUMN_MESSAGE,
                ]),
                $user,
                $complaint
            )
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param \App\Models\User\User $user
     * @param int $complaint_id
     * @param int $response_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( User $user, int $complaint_id, int $response_id )
    {
        return $this->resource(
            $user->answers()->where('complaint_id', $complaint_id)->findOrFail($response_id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User\User $user
     * @param int $complaint_id
     * @param int $response_id
     * @return \App\Http\Response\Template\SuccessResponse
     */
    public function update( Request $request, User $user, int $complaint_id, int $response_id )
    {

        $complaint = $user->answers()->where('complaint_id', $complaint_id)->findOrFail($response_id);

        return $this->success(
            [
                'update' => $complaint->update(
                    $request->only([
                        Complaint::COLUMN_SUBJECT,
                        Complaint::COLUMN_MESSAGE,
                        Complaint::COLUMN_STATUS_ID,
                    ])
                ),
                'complaint' => $this->resource($complaint)
            ],
            'Complaint was successfully updated!'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param int $user_id
     * @param int $complaint_id
     * @param int $response_id
     * @return \App\Http\Response\Template\SuccessResponse
     */
    public function satisfied( int $user_id, int $complaint_id, int $response_id )
    {
        $user = User::findOrFail($user_id);
        $complaint = $user->answers()->where('complaint_id', $complaint_id)->findOrFail($response_id);
        $complaint->status()->associate(SatisfiedStatus::first())->save();

        return $this->success(
            $this->resource($complaint->refresh()),
            'Complaint was satisfied!'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param int $user_id
     * @param int $complaint_id
     * @param int $response_id
     * @return \App\Http\Response\Template\SuccessResponse
     */
    public function rejected( int $user_id, int $complaint_id, int $response_id )
    {
        $user = User::findOrFail($user_id);
        $complaint = $user->answers()->where('complaint_id', $complaint_id)->findOrFail($response_id);
        $complaint->status()->associate(RejectedStatus::first())->save();

        return $this->success(
            $this->resource($complaint->refresh()),
            'Complaint was satisfied!'
        );
    }

}
