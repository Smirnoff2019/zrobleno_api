<?php

namespace App\Jobs\User;

use App\Models\Role\CustomerRole;
use App\Models\Status\Common\ActiveStatus;
use App\Models\User\Customer\Customer;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class CreateCustomer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Project data
     *
     * @var array
     */
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = optional((object) $this->data);

        $customer = Customer::create([
            User::COLUMN_FIRST_NAME        => $data->first_name,
            User::COLUMN_MIDDLE_NAME       => $data->middle_name,
            User::COLUMN_LAST_NAME         => $data->last_name,
            User::COLUMN_PHONE             => $data->phone,
            User::COLUMN_EMAIL             => $data->email,
            User::COLUMN_EMAIL_VERIFIED_AT => now(),
            User::COLUMN_PASSWORD          => $data->password,
            User::COLUMN_REMEMBER_TOKEN    => Str::random(10),
            User::COLUMN_ROLE_ID           => CustomerRole::first()->id,
            User::COLUMN_STATUS_ID         => ActiveStatus::first()->id,
        ]);

        return $customer;
    }

}
