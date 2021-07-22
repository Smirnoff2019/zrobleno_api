<?php

namespace App\Jobs\Tender;

use App\Events\Tender\ConfirmRestartTenderApplicationEvent;
use App\Models\Tender\Tender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConfirmRestartTenderApplication implements ShouldQueue
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
        $this->tender->offerToRestart->setAsConfirmed();

        event(new ConfirmRestartTenderApplicationEvent($this->tender));

        return $this->tender;
    }

}
