<?php

namespace App\Jobs\Tender;

use App\Events\Tender\RejectTenderApplicationEvent;
use App\Models\Tender\Tender;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RejectTenderApplication implements ShouldQueue
{
    use Dispatchable, 
        InteractsWithQueue, 
        Queueable, 
        SerializesModels;

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
        $this->tender->application->setAsCanceled(false);
        $this->tender->setAsCanceled(false);
        $this->tender->push();

        event(new RejectTenderApplicationEvent($this->tender));

        return $this->tender;
    }

}
