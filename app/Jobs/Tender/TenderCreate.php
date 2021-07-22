<?php

namespace App\Jobs\Tender;

use App\Events\GeneralEvent;
use App\Models\Project\Project;
use App\Models\Status\Tender\AwaitingConfirmationStatus;
use App\Models\User\User;
use App\Models\Tender\Tender;
use App\Models\TenderApplication\TenderApplication;
use Illuminate\Bus\Queueable;
use App\Models\User\Customer\Customer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TenderCreate implements ShouldQueue
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
     * Tender project
     *
     * @var Project|array
     */
    protected $project;

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
    public function __construct($data, Project $project, User $customer)
    {
        $this->data = $data;
        $this->project = $project;
        $this->customer = $customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = (object) $this->data;
        $project = $this->project;

        $total_price = (int) $project->total_price;
        
        $coeff = 0.025;
        if($total_price <= 200000) $coeff = 0.02;
        if($total_price > 200000 && $total_price <= 4000000) $coeff = 0.01;
        if($total_price > 4000000) $coeff = 0.008;

        $price = (int) $project->total_price / $data->max_participants * $coeff;

        $tender = Tender::create([
            'uid'              => Tender::createRandUid(),
            'name'             => "Ремонт квартири {$project->total_area} м2",
            'max_participants' => $data->max_participants,
            'price'            => $price,
            'started_at'       => now()->addDays(1),
            'finished_at'      => now()->addDays(31)
        ]);

        $tender->project()->associate($project);
        $tender->status()->associate(AwaitingConfirmationStatus::first());
        $tender->customer()->associate($this->customer);
        $tender->application()->associate(TenderApplication::create()->setAsAwaitingConfirmation());
        
        $tender->save();
        
        $this->callNotifyEvent($this->customer, $tender);

        return $tender;
    }


    public function callNotifyEvent($user, $tender) 
    {
        $title = "Ваше заявка на замовлення №{$tender->uid} успішно зареєстровано!";
        $content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

        return event(new GeneralEvent($user, $content, $title, "https://customer.zrobleno.com.ua/application", 'tender', $tender->id, 'success', 'application'));
    } 

}
