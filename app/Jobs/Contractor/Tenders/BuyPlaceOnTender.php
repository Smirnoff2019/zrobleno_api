<?php

namespace App\Jobs\Contractor\Tenders;

use App\Events\GeneralEvent;
use App\Events\Tender\NewParticipant;
use App\Events\Tender\TenderActivation;
use App\Jobs\Tender\ActivateTender;
use App\Models\User\User;
use App\Models\Tender\Tender;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User\Contractor\Contractor;
use App\Notifications\Contractor\NewParticipantSuccessfullyArrivedToTender;
use App\Notifications\Customer\NewParticipantSuccessfullyArrivedToTender as CustomerNewParticipantSuccessfullyArrivedToTender;
use App\Traits\Logs\Loger;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class BuyPlaceOnTender implements ShouldQueue
{
    use Dispatchable, 
        InteractsWithQueue, 
        Queueable, 
        SerializesModels,
        Loger;

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
    public function __construct(User $contractor, Tender $tender)
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
        DB::transaction(function () {
                
            $this->tender->loadCount('participants');

            $price = $this->tender->price;
            $check = $this->contractor->isEnoughtMoney($price);

            if(!$check) {
                return response()->errorMessage('Not enought money');
            }

            if($this->tender->max_participants <= $this->tender->participants_count) {
                return response()->errorMessage('Participants limited');
            }

            $remainder = $this->contractor->minusFromBonusAccount($price, $this->tender->id);

            if($remainder) {
                $this->contractor->minusFromMainAccount($remainder, $this->tender->id);
            }

            $this->tender->participants()->attach($this->contractor->id);
            $this->tender->save();

            event(new NewParticipant($this->tender, $this->contractor));

        });

        return $this->tender->refresh();
    }

}