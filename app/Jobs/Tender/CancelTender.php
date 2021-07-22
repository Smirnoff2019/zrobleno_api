<?php

namespace App\Jobs\Tender;

use App\Models\User\User;
use App\Models\Tender\Tender;
use Illuminate\Bus\Queueable;
use App\Models\User\Customer\Customer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\TenderApplication\TenderApplication;

class CancelTender implements ShouldQueue
{
    use Dispatchable, 
        InteractsWithQueue, 
        Queueable, 
        SerializesModels;

    /**
     * Tender owner
     *
     * @var Customer
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
        $this->tender->application->setAsCanceled(false);
        $this->tender->setAsCanceled(false);
        $this->tender->push();

        return $this->tender;
    }

}
