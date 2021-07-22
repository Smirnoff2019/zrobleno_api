<?php

namespace App\Http\Resources\Contractor\Tenders;

use App\Http\Resources\ApiResource;
use App\Http\Resources\Contractor\Tenders\Deals\TenderDealsResource;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\Tender\Application\TenderApplicationResource;
use App\Http\Resources\Tender\Participant\ParticipantResource;
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
        ])
            ->loadCount([
                'participants',
            ]);

        return [
            'id'                 => $this->id,
            'uid'                => $this->uid,
            'name'               => $this->name,
            'max_participants'   => $this->max_participants,
            'participants_count' => (int) $this->participants_count,
            'price'              => $this->price,
            'showCustomerData'   => $this->hasShowCustomerData(),
            'activeDeal'         => $this->when(
                $this->activeDeal,
                new TenderDealsResource($this->activeDeal),
                null
            ),
            'participants'       => $this->when(
                $this->participants,
                ParticipantResource::collection($this->participants),
                []
            ),
            'application'        => $this->when(
                $this->application,
                new TenderApplicationResource($this->application),
                null
            ),
            'customer'           => $this->when(
                $this->hasShowCustomerData() && $this->customer,
                new UserResource($this->customer),
                null
            ),
            'project'            => $this->when(
                $this->project,
                new ProjectResource($this->project),
                null
            ),
            'status'             => $this->when(
                $this->status,
                new StatusResource($this->status),
                null
            ),
            'started_at'         => $this->started_at,
            'finished_at'        => $this->finished_at,
            'updated_at'         => $this->updated_at,
            'created_at'         => $this->created_at,
        ];
    }

}
