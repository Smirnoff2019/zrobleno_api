<?php

namespace App\Jobs\Tests;

use App\Models\User\User;
use App\Models\Tender\Tender;
use Illuminate\Bus\Queueable;
use App\Models\User\Customer\Customer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\TenderApplication\TenderApplication;
use App\Notifications\TestNotification;

class SendNotify implements ShouldQueue
{
    use Dispatchable, 
        InteractsWithQueue, 
        Queueable, 
        SerializesModels;

    /**
     * User
     *
     * @var User
     */
    protected $user;

    /**
     * Notification subject
     *
     * @var string
     */
    protected $subject;

    /**
     * Notification message
     *
     * @var string
     */
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, string $subject, string $message)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notifyNow(new TestNotification($this->subject, $this->message));
    }

}
