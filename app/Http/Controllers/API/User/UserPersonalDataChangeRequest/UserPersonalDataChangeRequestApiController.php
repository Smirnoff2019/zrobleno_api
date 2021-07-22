<?php

namespace App\Http\Controllers\API\User\UserPersonalDataChangeRequest;

use App\Http\Controllers\ApiController;
use App\Http\Resources\UserPersonalDataChangeResource\UserPersonalDataChangeResource;
use App\Http\Resources\UserPersonalDataChangeResource\UserPersonalDataChangeResourceCollection;
use App\Jobs\PersonalDataRequest\ConfirmPersonalDataRequest;
use App\Jobs\PersonalDataRequest\CreatePersonalDataRequest;
use App\Jobs\PersonalDataRequest\DeletePersonalDataRequest;
use App\Jobs\PersonalDataRequest\RejectPersonalDataRequest;
use App\Models\UserPersonalDataChangeRequests\UserPersonalDataChangeRequests;
use Illuminate\Http\Request;

class UserPersonalDataChangeRequestApiController extends ApiController
{

    /**
     * The repository resource model namespace.
     *
     * @var string
     */
    protected $resourceName = UserPersonalDataChangeResource::class;

    /**
     * The repository resource collections model namespace.
     *
     * @var string
     */
    protected $resourceCollectionName = UserPersonalDataChangeResourceCollection::class;

    /**
     * Instantiate a new controller instance.
     *
     * @param UserPersonalDataChangeRequests $userPersonalDataChangeRequests
     */
    public function __construct(UserPersonalDataChangeRequests $userPersonalDataChangeRequests)
    {
        $this->middleware('auth:api');
        $this->model = $userPersonalDataChangeRequests;

        $this->textUserDataChangeNotFound = "No user personal data change request was found!";
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store( Request $request )
    {
        return $this->resource(CreatePersonalDataRequest::dispatchNow(
            $request->toArray(),
            $request->user()
        ));
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param int $userPersonalDataChangeRequests_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( int $userPersonalDataChangeRequests_id )
    {
        return $this->resource(
            $this->model->findOrFail($userPersonalDataChangeRequests_id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param \Illuminate\Http\Request $request
     * @param int $userPersonalDataChangeRequests_id
     * @return \App\Http\Response\Template\SuccessResponse
     */
    public function update( Request $request, int $userPersonalDataChangeRequests_id )
    {
        $userPersonalDataChangeRequests = $this->model->findOrFail($userPersonalDataChangeRequests_id);

        return $this->success([
            'update' => $userPersonalDataChangeRequests->update(
                $request->only([
                    UserPersonalDataChangeRequests::COLUMN_DATA => [
                        'first_name'  => $request->first_name,
                        'middle_name' => $request->middle_name,
                        'last_name'   => $request->last_name,
                        'phone'       => $request->phone,
                        'email'       => $request->email,
                        'legal_data'  => [
                            'bill'          => $request->bill,
                            'MFO'           => $request->MFO,
                            'EDRPOU_code'   => $request->EDRPOU_code,
                            'serial_number' => $request->serial_number,
                            'legal_status'  => $request->legal_status
                        ]
                    ]
                ])
            ),
            'userPersonalDataChangeRequests' => $this->resource($userPersonalDataChangeRequests->refresh())
        ],
            'User personal data change request was successfully updated!'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param int $userPersonalDataChangeRequests_id
     * @return \App\Http\Response\Template\SuccessResponse
     */
    public function destroy( int $userPersonalDataChangeRequests_id )
    {
        return $this->success(
            [
                "userPersonalDataChangeRequests_id" => $userPersonalDataChangeRequests_id,
                "destroyed" => DeletePersonalDataRequest::dispatchNow(
                    $userPersonalDataChangeRequests_id
                )
            ],
            'The User personal data change request has been successfully deleted from the database!'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @method POST
     * @param int $personal_data_request_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm( int $personal_data_request_id )
    {
        return $this->resource(
            ConfirmPersonalDataRequest::dispatchNow(
                $personal_data_request_id
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @method POST
     * @param int $personal_data_request_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject( int $personal_data_request_id )
    {
        return $this->resource(
            RejectPersonalDataRequest::dispatchNow(
                $personal_data_request_id
            )
        );
    }

}
