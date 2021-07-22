<?php

namespace App\Http\Controllers\API\Tender;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Models\Tender\Tender;
use Illuminate\Support\Carbon;
use App\Jobs\Tender\TenderCreate;
use App\Http\Controllers\ApiController;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Status\Tender\CanceledStatus;
use App\Http\Resources\Tender\TenderResource;
use App\Http\Requests\Api\Tender\TenderRequest;
use App\Http\Requests\Api\Tender\TenderUpdateRequest;
use App\Http\Resources\Tender\TenderResourceCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * @param \App\Models\Tender\Tender $tender
     * @return void
     */
    public function __construct(Tender $tender)
    {
        $this->middleware('auth:api');
        $this->model = $tender;

        $this->notFoundMessage = "No tender with this ID found!";
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
                ->withoutParticipant($request->user()->id)
                ->queryFilters($request)
                ->paginate($this->perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \App\Http\Requests\Api\Tender\TenderRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TenderRequest $request)
    {
        return $this->resource(
            TenderCreate::dispatchNow(
                $request->only([
                    Tender::COLUMN_NAME,
                    Tender::COLUMN_MAX_PARTICIPANTS,
                    Tender::COLUMN_PRICE,
                    Tender::COLUMN_PROJECT_ID,
                ]),
                User::find($request->user_id) ?? $request->user()
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $tender_id
     * @return \Illuminate\Http\Response
     */
    public function show(int $tender_id)
    {
        try {
            return $this->resource(
                $this->model->findOrFail($tender_id)
            );
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->notFoundMessage);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  TenderUpdateRequest  $request
     * @param  int  $tender_id
     * @return \Illuminate\Http\Response
     */
    public function update(TenderUpdateRequest $request, int $tender_id)
    {
        try {
            $tender = $this->model
                ->findOrFail($tender_id);
            $tender->update($request->only([
                Tender::COLUMN_NAME,
                Tender::COLUMN_MAX_PARTICIPANTS,
                Tender::COLUMN_PRICE,
                Tender::COLUMN_STATUS_ID,
            ]));

            return $this->resource($tender);
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->notFoundMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  TenderUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(TenderUpdateRequest $request, int $tender_id)
    {
        try {
            $tender = $this->model->findOrFail($tender_id);
            $result = $tender->status()->associate(CanceledStatus::first())->save();

            return $result
                ? $this->success(
                    $this->resource($tender->refresh()),
                    'The tender has been successfully canceled!'
                )
                : $this->error();
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->notFoundMessage);
        }
    }

}
