<?php

namespace App\Jobs\PersonalDataRequest;

use App\Models\UserPersonalDataChangeRequests\UserPersonalDataChangeRequests;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeletePersonalDataRequest implements ShouldQueue
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
        $userPersonalDataChangeRequests = UserPersonalDataChangeRequests::findOrFail(
            $this->id
        );

        $userPersonalDataChangeRequests->delete();

        return $userPersonalDataChangeRequests;
    }

}
