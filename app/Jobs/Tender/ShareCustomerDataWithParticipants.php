<?php

namespace App\Jobs\Tender;

use App\Events\GeneralEvent;
use App\Events\Tender\ShareCustomerDataWithParticipantsEvent;
use App\Events\Tender\TenderActivation;
use App\Models\Project\Project;
use App\Models\Status\Tender\ActiveStatus;
use App\Models\Status\Tender\AwaitingConfirmationStatus;
use App\Models\User\User;
use App\Models\Tender\Tender;
use App\Models\TenderApplication\TenderApplication;
use Illuminate\Bus\Queueable;
use App\Models\User\Customer\Customer;
use App\Traits\Logs\Loger;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ShareCustomerDataWithParticipants implements ShouldQueue
{
    use Dispatchable, 
        InteractsWithQueue, 
        Queueable, 
        SerializesModels,
        Loger;

    /**
     * Tender owner
     *
     * @var Tender
     */
    protected $tender;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Tender $tender)
    {
        $this->tender = $tender;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        event(new ShareCustomerDataWithParticipantsEvent($this->tender));

        return $this->tender;
    }

}
