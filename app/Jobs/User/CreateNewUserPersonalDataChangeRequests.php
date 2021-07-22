<?php

namespace App\Jobs\User;

use App\Models\Role\CustomerRole;
use App\Models\Status\Common\ActiveStatus;
use App\Models\User\Customer\Customer;
use App\Models\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class CreateNewUserPersonalDataChangeRequests implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * User
     *
     * @var User
     */
    protected $user;

    /**
     * Request
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
    }

}
