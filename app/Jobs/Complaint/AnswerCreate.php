<?php

namespace App\Jobs\Complaint;

use App\Models\Complaint\Complaint;
use App\Models\ComplaintRecipient\ComplaintRecipient;
use App\Models\ComplaintResponse\ComplaintResponse;
use App\Models\Image\Image;
use App\Models\Status\Complaint\ProcessedStatus;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AnswerCreate implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var \App\Models\User\User
     */
    protected $user;

    /**
     * @var \App\Models\Complaint\Complaint $complaint
     */
    protected $complaint;

    /**
     * Create a new job instance.
     *
     * @param array $data
     * @param \App\Models\User\User $user
     * @param \App\Models\Complaint\Complaint $complaint
     */
    public function __construct(array $data, User $user, Complaint $complaint)
    {
        $this->data = $data;
        $this->user = $user;
        $this->complaint = $complaint;
    }

    /**
     * Execute the job.
     *
     * @return Image
     */
    public function handle()
    {
        $data = optional((object) $this->data);
        $user = $this->user;
        $complaint = $this->complaint;


        $response = factory(Complaint::class)->create([
            Complaint::COLUMN_SUBJECT    => $data->subject,
            Complaint::COLUMN_MESSAGE    => $data->message,
            Complaint::COLUMN_USER_ID    => $this->user->id,
            Complaint::COLUMN_STATUS_ID  => ProcessedStatus::first(),
        ]);

        factory(ComplaintResponse::class)->create([
            ComplaintResponse::COLUMN_COMPLAINT_ID => $complaint->id,
            ComplaintResponse::COLUMN_RESPONSE_ID  => $response->id,
            ComplaintResponse::COLUMN_USER_ID      => $user->id,
        ]);

        factory(ComplaintRecipient::class)->create([
            ComplaintRecipient::COLUMN_COMPLAINT_ID => $complaint->id,
            ComplaintRecipient::COLUMN_USER_ID      => $user->id,
        ]);

        $complaint->status()->associate(ProcessedStatus::first());
        $complaint->push();

        return $response;
    }

}
