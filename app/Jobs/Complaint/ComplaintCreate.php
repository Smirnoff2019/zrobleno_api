<?php

namespace App\Jobs\Complaint;

use App\Models\Complaint\Complaint;
use App\Models\Image\Image;
use App\Models\Status\Complaint\InProcessingStatus;
use App\Models\User\User;
use App\Schemes\Complaint\ComplaintSchema;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ComplaintCreate implements ShouldQueue, ComplaintSchema
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
     * @var \App\Models\User\User
     */
    protected $recipient;

    /**
     * Create a new job instance.
     *
     * @param array $data
     * @param \App\Models\User\User $user
     * @param User|null $recipient
     */
    public function __construct(array $data, User $user, User $recipient = null)
    {
        $this->data = $data;
        $this->user = $user;
        $this->recipient = $recipient;
    }

    /**
     * Execute the job.
     *
     * @return Image
     */
    public function handle()
    {
        $data = optional((object) $this->data);

        $complaint = factory(Complaint::class)->create([
            Complaint::COLUMN_SUBJECT    => $data->subject,
            Complaint::COLUMN_MESSAGE    => $data->message,
        ]);

        $complaint->user()->associate($this->user);
        $complaint->status()->associate(InProcessingStatus::first());
        
        if($this->recipient) {
            $this->recipient->complaintsToMe()->save($complaint);
        }

        $complaint->push();

        return $complaint;
    }

}
