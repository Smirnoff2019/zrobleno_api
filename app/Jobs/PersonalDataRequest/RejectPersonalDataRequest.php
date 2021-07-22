<?php

namespace App\Jobs\PersonalDataRequest;

use App\Models\Status\TenderApplication\CanceledStatus;
use App\Models\UserPersonalDataChangeRequests\UserPersonalDataChangeRequests;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RejectPersonalDataRequest implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    protected $id;

    /**
     * Create a new job instance.
     *
     * @param int $id
     */
    public function __construct( int $id )
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return UserPersonalDataChangeRequests $userPersonalDataChangeRequests;
     */
    public function handle(): UserPersonalDataChangeRequests
    {
        $personal_data_request = UserPersonalDataChangeRequests::findOrFail($this->id);

        $personal_data_request->update([
            'status_id' => CanceledStatus::first()->id
        ]);

        return $personal_data_request->refresh();
    }

}
