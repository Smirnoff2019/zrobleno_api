<?php

namespace App\Jobs\PersonalDataRequest;

use App\Models\Status\TenderApplication\ConfirmedStatus;
use App\Models\UserPersonalDataChangeRequests\UserPersonalDataChangeRequests;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConfirmPersonalDataRequest implements ShouldQueue
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
            'status_id' => ConfirmedStatus::first()->id
        ]);

        $data = (object)$personal_data_request->data;

        $personal_data_request->user()->update([
            'first_name'  => $data->first_name ?? null,
            'middle_name' => $data->middle_name ?? null,
            'last_name'   => $data->last_name ?? null,
            'phone'       => $data->phone ?? null,
            'email'       => $data->email ?? null,
        ]);

        $personal_data_request->user->legalData()->updateOrCreate([
            'bill'          => $personal_data_request['data']['legal_data']['bill'] ?? null,
            'MFO'           => $personal_data_request['data']['legal_data']['MFO'] ?? null,
            'EDRPOU_code'   => $personal_data_request['data']['legal_data']['EDRPOU_code'] ?? null,
            'serial_number' => $personal_data_request['data']['legal_data']['serial_number'] ?? null,
            'legal_status'  => $personal_data_request['data']['legal_data']['legal_status'] ?? null
        ]);

        return $personal_data_request->refresh();
    }

}
