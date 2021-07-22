<?php

namespace App\Http\Resources\Tender;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\Tender\Application\TenderApplicationResource;
use App\Http\Resources\Tender\Deals\TenderDealsResource;
use App\Http\Resources\Tender\Participant\ParticipantResource;
use App\Http\Resources\Tender\Restart\TenderRestartOfferResource;
use App\Http\Resources\User\UserResource;
use App\Schemes\Tender\TenderSchema;
use Illuminate\Support\Str;

class TenderResource extends ApiResource implements TenderSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'Tender retrieved successfully!';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->loadMissing([
            'application',
            'status',
            'participants',
            'activeDeal',
            'customer',
            'project',
            'offerToRestart',
        ])
            ->loadCount([
                'participants',
            ]);

        return [
            'id'                                     => $this->id,
            'uid'                                    => $this->uid,
            'name'                                   => $this->name,
            'max_participants'                       => $this->max_participants,
            'participants_count'                     => (int) $this->participants_count,
            'price'                                  => $this->price,
            'can_show_customer_data'                 => $this->can_show_customer_data,
            'can_restarting'                         => $this->can_restarting,
            'can_offer_deals'                        => $this->can_offer_deals,
            'can_create_new_complaints'              => $this->can_create_new_complaints,
            'can_customer_reject_tender_application' => $this->can_customer_reject_tender_application,
            'terms_of_reference_url'                 => $this->terms_of_reference_url,
            'activeDeal'                             => $this->when(
                $this->activeDeal,
                new TenderDealsResource($this->activeDeal),
                null
            ),
            'participants'                           => $this->when(
                $this->participants,
                ParticipantResource::collection($this->participants),
                []
            ),
            'restart_offer'                          => $this->when(
                $this->offerToRestart,
                new TenderRestartOfferResource($this->offerToRestart),
                null
            ),
            'application'                            => $this->when(
                $this->application,
                new TenderApplicationResource($this->application),
                null
            ),
            'customer'                               => $this->when(
                $this->customer,
                new UserResource($this->customer),
                null
            ),
            'project'                                => $this->when(
                $this->project,
                new ProjectResource($this->project),
                null
            ),
            'status'                                 => $this->when(
                $this->status,
                new StatusResource($this->status),
                null
            ),
            'started_at'                             => $this->started_at,
            'finished_at'                            => $this->finished_at,
            'updated_at'                             => $this->updated_at,
            'created_at'                             => $this->created_at,
        ];
    }

}
