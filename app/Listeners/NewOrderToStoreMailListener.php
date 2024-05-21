<?php

namespace App\Listeners;

use App\Models\Store;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CompleteCheckoutMailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\OrderCreatedNotification;

class NewOrderToStoreMailListener
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
    public function handle(CompleteCheckoutMailEvent $event): void
    {
        $order = $event->checkout;
        $store_id = $order->store_id;
        $store = Store::where('id',$store_id)->first();
        $vendor = $store->vendor;

        $vendor->notify(new OrderCreatedNotification($order));


    }
}
