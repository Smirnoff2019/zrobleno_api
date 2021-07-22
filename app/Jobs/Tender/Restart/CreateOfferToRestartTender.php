<?php

namespace App\Jobs\Tender\Restart;

use App\Events\Tender\NewTenderRestartApplicationCreatedEvent;
use App\Jobs\Tender\TenderCreate;
use App\Models\Status\TenderRestart\AwaitingConfirmationStatus;
use App\Models\User\User;
use App\Models\Tender\Tender;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User\Contractor\Contractor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateOfferToRestartTender implements ShouldQueue
{
    use Dispatchable, 
        InteractsWithQueue, 
        Queueable, 
        SerializesModels;

    /**
     * Contractor
     *
     * @var Contractor|User
     */
    protected $contractor;

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
     * @return Tender
     */
    public function handle()
    {
        $application = $this->tender->offerToRestart()->firstOrCreate([]);
        $application->setAsAwaitingConfirmation()->save();

        $tender = TenderCreate::dispatchNow(
            ['max_participants' => $this->tender->max_participants],
            $this->tender->project,
            $this->tender->user
        );

        event(new NewTenderRestartApplicationCreatedEvent($this->tender));

        return $this->tender;
    }

}
