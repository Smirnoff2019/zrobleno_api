<?php

namespace App\Http\Controllers\API\User\TenderApplication;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Models\Status\Status;
use App\Http\Controllers\ApiController;
use App\Models\TenderApplication\TenderApplication;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\TenderApplication\TenderApplicationResource;
use App\Http\Requests\Api\TenderApplication\TenderApplicationRequest;
use App\Http\Requests\Api\TenderApplication\TenderApplicationUpdateRequest;
use App\Http\Resources\TenderApplication\TenderApplicationResourceCollection;

class UserTenderApplicationApiController extends ApiController
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

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $user_id
     * @param  int  $tender_application_id
     * @return \Illuminate\Http\Response
     */
    public function show(int $user_id, int $tender_application_id)
    {
        try {
            $user = User::findOrFail($user_id);
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->textUserNotFound);
        }

        try {
            return $this->resource(
                $user->tenderApplications()->findOrFail($tender_application_id)
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->textTenderApplicationNotFound);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @param  int  $tender_application_id
     * @return \Illuminate\Http\Response
     */
    public function update(TenderApplicationUpdateRequest $request, int $user_id, int $tender_application_id)
    {
        try {
            $user = User::findOrFail($user_id);
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->textUserNotFound);
        }
        
        try {
            $tenderApplication = $user->tenderApplications()->findOrFail($tender_application_id);
            $result = $tenderApplication
                ->status()
                ->associate(
                    Status::find($request->{TenderApplication::COLUMN_STATUS_ID})
                );

            return $this->success(
                [
                    'update' => $result,
                    'tender_application' => $this->resource($tenderApplication->refresh())
                ],
                'The user tender application data was successfully updated!'
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->textTenderApplicationNotFound);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $user_id
     * @param  int  $tender_application_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $user_id, int $tender_application_id)
    {
        try {
            $user = User::findOrFail($user_id);
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->textUserNotFound);
        }

        try {
            $result = $user->tenderApplications()
                ->findOrFail($tender_application_id)
                ->delete();

            return $result
                ? $this->success(
                    [
                        "id" => $tender_application_id,
                        "destroyed" => $result
                    ],
                    'The user tender application has been successfully deleted from the database!'
                )
                : $this->error();
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->textTenderApplicationNotFound);
        }
    }

}
