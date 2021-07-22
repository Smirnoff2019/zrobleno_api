<?php

namespace App\Jobs\Tender;

use App\Events\GeneralEvent;
use App\Models\User\User;
use Illuminate\Support\Arr;
use App\Models\Tender\Tender;
use Illuminate\Bus\Queueable;
use App\Jobs\Project\ProjectCreate;
use App\Models\User\Customer\Customer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\TenderApplication\TenderApplication;

class NewlyCreateTender implements ShouldQueue
{
    use Dispatchable, 
        InteractsWithQueue, 
        Queueable, 
        SerializesModels;

    /**
     * Tender data
     *
     * @var array
     */
    protected $data;

    /**
     * Tender owner
     *
     * @var Customer
     */
    protected $customer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data, User $customer)
    {
        $this->data = $data;
        $this->customer = $customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $project = ProjectCreate::dispatchNow(
            $this->data, 
            $this->customer
        );
        $project->loadCount('rooms');

        if(--$project->rooms_count > 1 ) {
            $name = "Ремонт {$project->rooms_count}-ох кімнатної квартири";
        } else {
            $name = 'Ремонт 1-о кімнатної квартири';
        }

        
        $max_participants = rand(3, 9);
        $price = (int) (( ((int) $project->total_price / $max_participants) / 100 ) * 1.5);
        
        
        $tender = factory(Tender::class)->create([
            Tender::COLUMN_NAME => $name,
            Tender::COLUMN_MAX_PARTICIPANTS => $max_participants,
            Tender::COLUMN_PRICE => $price,
            Tender::COLUMN_PROJECT_ID => $project,
        ]);

        $tender->setAsAwaitingConfirmation();
        $tender->customer()->associate($this->customer);
        $tender->application()->create()->setAsAwaitingConfirmation();
        
        $tender->push();

        // dd([
        //     $name,
        //     $price,
        //     $max_participants,
        //     $project,
        //     $tender->load('application.status')
        // ]);
        
        event(new GeneralEvent(
            $this->customer, 
            "Очікуйте підтвердження менеджером вашої заявки",
            "Ви подали новий запит на замовлення!",
            "",
            "",
            "",
            "access",
            "tender"
        ));

        return $tender->refresh();
    }

}
