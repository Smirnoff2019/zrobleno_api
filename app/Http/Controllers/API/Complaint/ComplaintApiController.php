<?php

namespace App\Http\Controllers\API\Complaint;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Complaint\ComplaintResource;
use App\Http\Resources\Complaint\ComplaintResourceCollection;
use App\Jobs\Complaint\ComplaintCreate;
use App\Models\Complaint\Complaint;
use App\Models\Status\Complaint\RejectedStatus;
use App\Models\User\User;
use Illuminate\Http\Request;

class ComplaintApiController extends ApiController
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
     * @param  \App\Models\User\User $user
     * @return void
     */
    public function __construct( User $user )
    {
        $this->model = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param Request $request
     * @param \App\Models\User\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function index( Request $request, User $user )
    {
        return $this->collection(
            $user->complaints()->paginate($request->perPage ?? $this->perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function store( Request $request, User $user )
    {
        return $this->resource(
            ComplaintCreate::dispatchNow(
                $request->only([
                    Complaint::COLUMN_SUBJECT,
                    Complaint::COLUMN_MESSAGE,
                ]),
                $user,
                User::find($request->get('recipient_id', null))
            )
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @param \App\Models\User\User $user
     * @param int $complaint_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( User $user, int $complaint_id )
    {
        return $this->resource(
            $user->complaints()->findOrFail($complaint_id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User\User $user
     * @param int $complaint_id
     * @return \App\Http\Response\Template\SuccessResponse
     */
    public function update( Request $request, User $user, int $complaint_id )
    {
        $complaint = $user->complaints()->findOrFail($complaint_id);

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
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param \App\Models\User\User $user
     * @param int $complaint_id
     * @return \App\Http\Response\Template\SuccessResponse
     */
    public function destroy( User $user, int $complaint_id )
    {
        $complaint = $user->complaints()->findOrFail($complaint_id);
        $complaint->status()->associate(RejectedStatus::first())->save();

        return $this->success(
            $this->resource($complaint->refresh()),
            'Complaint was rejected!'
        );
    }

}
