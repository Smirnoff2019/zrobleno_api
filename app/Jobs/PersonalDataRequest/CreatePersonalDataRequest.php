<?php

namespace App\Jobs\PersonalDataRequest;

use App\Models\Status\TenderApplication\AwaitingConfirmationStatus;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\UserPersonalDataChangeRequests\UserPersonalDataChangeRequests;

class CreatePersonalDataRequest implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var User $user
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param array $data
     * @param User $user
     */
    public function __construct( array $data, User $user )
    {
        $this->data = $data;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return UserPersonalDataChangeRequests $userPersonalDataChangeRequests;
     */
    public function handle(): UserPersonalDataChangeRequests
    {
        $user = $this->user;
        $data = (object)$this->data;

        return UserPersonalDataChangeRequests::create([
            UserPersonalDataChangeRequests::COLUMN_USER_ID => $user->id,
            UserPersonalDataChangeRequests::COLUMN_STATUS_ID => AwaitingConfirmationStatus::first()->id,
            UserPersonalDataChangeRequests::COLUMN_DATA => [
                'first_name'  => $data->first_name,
                'middle_name' => $data->middle_name,
                'last_name'   => $data->last_name,
                'phone'       => $data->phone,
                'email'       => $data->email,
                'legal_data'  => [
                    'bill'          => $data->bill,
                    'MFO'           => $data->MFO,
                    'EDRPOU_code'   => $data->EDRPOU_code,
                    'serial_number' => $data->serial_number,
                    'legal_status'  => $data->legal_status
                ]
            ]
        ]);

    }

}
