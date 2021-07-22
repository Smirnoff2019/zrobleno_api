<?php

namespace App\Jobs\Contractor\Tenders\Deals;

use App\Events\Tender\TenderDealCreatedEvent;
use App\Models\User\User;
use App\Models\Tender\Tender;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Models\TenderDeals\TenderDeals;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User\Contractor\Contractor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Status\TenderDeals\PendingStatus;
use App\Notifications\NotificationTypes\Tenders\SuccessTenderNotification;

class NewDealOffer implements ShouldQueue
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
    public function __construct(Contractor $contractor, Tender $tender)
    {
        $this->contractor = $contractor;
        $this->tender = $tender;
    }

    /**
     * Execute the job.
     *
     * @return Tender
     */
    public function handle()
    {
        $deal = TenderDeals::firstOrCreate(
            [
                TenderDeals::COLUMN_TENDER_ID => $this->tender->id,
                TenderDeals::COLUMN_CUSTOMER_ID => $this->tender->customer->id,
                TenderDeals::COLUMN_CONTRACTOR_ID => $this->contractor->id,
            ], 
            [
                TenderDeals::COLUMN_STATUS_ID => PendingStatus::first()->id,
            ]
        );

        event(new TenderDealCreatedEvent($this->tender, $this->contractor));

        return $deal;
    }

}
