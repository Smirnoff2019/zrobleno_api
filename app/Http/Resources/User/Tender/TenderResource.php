<?php

namespace App\Http\Resources\User\Tender;

use Illuminate\Support\Str;
use App\Http\Resources\ApiResource;
use App\Schemes\Tender\TenderSchema;
use App\Http\Resources\Status\StatusResource;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Tender\Participant\ParticipantResource;
use App\Http\Resources\User\Tender\TenderApplication\TenderApplicationResource;

class TenderResource extends ApiResource implements TenderSchema
{

    /**
     * HTTP response status message
     *
     * @var string
     */
    protected $responseMessage = 'User tender retrieved successfully';

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
            ])
            ->withCount([
                'participants'
            ]);

        return [
            self::COLUMN_ID                 => $this->{self::COLUMN_ID},
            'pid'                           => (string) Str::padLeft($this->id, 8, 0),
            self::COLUMN_NAME               => $this->{self::COLUMN_NAME},
            self::COLUMN_MAX_PARTICIPANTS   => $this->{self::COLUMN_MAX_PARTICIPANTS},
            'participants_count'            => (int) $this->participants_count,
            self::COLUMN_PRICE              => $this->{self::COLUMN_PRICE},
            'participants'                  => $this->when(
                                                    $this->participants, 
                                                    ParticipantResource::collection($this->participants),
                                                    []
                                                ),
            'application'                   => $this->when(
                                                    $this->application, 
                                                    new TenderApplicationResource($this->application),
                                                    null
                                                ),
            'project'                       => $this->when(
                                                    $this->project, 
                                                    new ProjectResource($this->project), 
                                                    null
                                                ),
            'status'                        => $this->when(
                                                    $this->status,
                                                    new StatusResource($this->status),
                                                    null
                                                ),
            self::COLUMN_STARTED_AT         => $this->{self::COLUMN_STARTED_AT},
            self::COLUMN_FINISHED_AT        => $this->{self::COLUMN_FINISHED_AT},
            self::COLUMN_UPDATED_AT         => $this->{self::COLUMN_UPDATED_AT},
            self::COLUMN_CREATED_AT         => $this->{self::COLUMN_CREATED_AT},
        ];
    }

}
