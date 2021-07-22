<?php

namespace App\Jobs\User;

use App\Models\DiscountCard\DiscountCard;
use App\Models\Role\CustomerRole;
use App\Models\Status\Common\ActiveStatus;
use App\Models\Tender\Tender;
use App\Models\User\Customer\Customer;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class CreateDiscountCard implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Tender
     *
     * @var Tender
     */
    protected $tender;

    /**
     * User
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Tender $tender, User $user)
    {
        $this->tender = $tender;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $discount = factory(DiscountCard::class)->create([
            'user_id' => $this->user->id,
            'tender_id' => $this->tender->id,
        ]);

        return $discount;
    }

}
