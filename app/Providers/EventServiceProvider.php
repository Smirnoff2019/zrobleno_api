<?php

namespace App\Providers;

use App\Events\ContractorRegisteredEvent;
use App\Events\CustomerRegisteredEvent;
use App\Listeners\GeneralListener;
use App\Listeners\TenderApplicationChangeStatusSubscriber;
use App\Models\Payment\Payment;
use App\Models\TenderParticipant\TenderParticipant;
use App\Observers\Payment\PaymentObserver;
use App\Observers\TenderParticipant\TenderParticipantObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\GeneralEvent;
use App\Events\PasswordResetEvent;
use App\Events\PasswordResetSuccessfullyEvent;
use App\Events\Tender\NewParticipant;
use App\Listeners\ContractorRegisteredEventListener;
use App\Listeners\CustomerRegisteredEventListener;
use App\Listeners\NewParticipantEventListener;
use App\Listeners\PasswordResetEventListener;
use App\Listeners\PasswordResetSuccessfullyEventListener;
use App\Listeners\TenderChangeStatusSubscriber;
use App\Listeners\TenderRestartApplicationStatusChangeSubscriber;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        GeneralEvent::class => [
            GeneralListener::class
        ],
        PasswordResetEvent::class => [
            PasswordResetEventListener::class
        ],
        CustomerRegisteredEvent::class => [
            CustomerRegisteredEventListener::class
        ],
        PasswordResetSuccessfullyEvent::class => [
            PasswordResetSuccessfullyEventListener::class
        ],
        ContractorRegisteredEvent::class => [
            ContractorRegisteredEventListener::class
        ],
        NewParticipant::class => [
            NewParticipantEventListener::class
        ]
    ];


    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        TenderChangeStatusSubscriber::class,
        TenderRestartApplicationStatusChangeSubscriber::class,
        TenderApplicationChangeStatusSubscriber::class
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Payment::observe(PaymentObserver::class);
        // TenderParticipant::observe(TenderParticipantObserver::class);
        //
    }
}
