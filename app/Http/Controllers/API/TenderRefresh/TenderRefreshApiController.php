<?php

namespace App\Http\Controllers\API\TenderRefresh;

use App\Models\Tender\Tender;
use App\Http\Controllers\ApiController;
use App\Models\TenderRefresh\TenderRefresh;
use App\Http\Resources\Tender\TenderResource;
use App\Models\Status\Tender\CompletedStatus;
use App\Models\TenderApplication\TenderApplication;
use App\Http\Resources\Tender\TenderResourceCollection;
use App\Models\Status\TenderApplication\CanceledStatus;
use App\Models\Status\TenderApplication\ConfirmedStatus;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Status\Tender\RecruitmentOfParticipantsStatus;
use App\Models\Status\TenderApplication\AwaitingConfirmationStatus;
use App\Models\Status\Tender\ActiveStatus;
use App\Models\Status\Tender\CanceledStatus as TenderCanceledStatus;

class TenderRefreshApiController extends ApiController
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
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param int $tender_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function offer( int $tender_id )
    {
        try {
            $tender = $this->model->findOrFail($tender_id);
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->notFoundMessage);
        }
        
        $newTender = factory(Tender::class)
            ->create([
                Tender::COLUMN_PROJECT_ID       => $tender->project_id,
                Tender::COLUMN_USER_ID          => $tender->user_id,
                Tender::COLUMN_STATUS_ID        => AwaitingConfirmationStatus::first(),
                Tender::COLUMN_NAME             => $tender->name,
                Tender::COLUMN_MAX_PARTICIPANTS => $tender->max_participants,
                Tender::COLUMN_PRICE            => $tender->price,
            ]);

        $newApplication = factory(TenderApplication::class)
            ->create([
                TenderApplication::COLUMN_TENDER_ID => $newTender->id,
                TenderApplication::COLUMN_STATUS_ID => AwaitingConfirmationStatus::first(),
            ]);

        $refresh = factory(TenderRefresh::class)
            ->create([
                TenderRefresh::COLUMN_TENDER_ID     => $tender->id,
                TenderRefresh::COLUMN_NEW_TENDER_ID => $newApplication->tender_id,
                TenderRefresh::COLUMN_STATUS_ID     => AwaitingConfirmationStatus::first(),
            ]);

        return $this->resource(
            $newTender
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param int $tender_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm( int $tender_id )
    {
        try {
            $tender = $this->model->findOrFail($tender_id);
        } catch (ModelNotFoundException $e) {
            return $this->notFound($this->notFoundMessage);
        }

        $confirmedStatus = ConfirmedStatus::first();
        $completedStatus = CompletedStatus::first();

        $tender->status()->associate(RecruitmentOfParticipantsStatus::first());
        $tender->application->status()->associate($confirmedStatus);
        $tender->tenderRefresh->status()->associate($confirmedStatus);
        $tender->tenderRefresh->tender->status()->associate($completedStatus);
        $tender->push();

        return $this->resource(
            $tender->refresh()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param int $tender_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function reject( int $tender_id )
    {
        $tender = Tender::findOrFail($tender_id);
        $canceledStatus = CanceledStatus::first();

        $tender->status()->associate(TenderCanceledStatus::first());
        $tender->application->status()->associate($canceledStatus);
        $tender->tenderRefresh->status()->associate($canceledStatus);
        $tender->push();

        return $this->resource(
            $tender->refresh()
        );

    }

}
