<?php

namespace App\Listeners\order;

use App\Events\DeliveringOrderMailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\DeliveringOrderStatusNotification;

class DeliveringOrderListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DeliveringOrderMailEvent $event): void
    {
        $order = $event->order;
        $user = $event->user;
        $user->notify(new DeliveringOrderStatusNotification($order));

    }
}
