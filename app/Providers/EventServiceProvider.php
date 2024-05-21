<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Events\QRcode\QRcodeStoreEvent;
use App\Events\DeliveringOrderMailEvent;
use App\Events\CompleteCheckoutMailEvent;
use App\Listeners\QRcode\QRcodeStoreListener;
use App\Listeners\NewOrderToStoreMailListener;
use App\Listeners\CompleteCheckoutMailListener;
use App\Listeners\order\DeliveringOrderListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CompleteCheckoutMailEvent::class=>[
            CompleteCheckoutMailListener::class,
            NewOrderToStoreMailListener::class,
        ],
        DeliveringOrderMailEvent::class=>[
            DeliveringOrderListener::class,
        ],
        QRcodeStoreEvent::class=>[
            QRcodeStoreListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
