<?php

namespace App\Listeners\QRcode;

use App\Models\Store;
use App\Events\QRcode\QRcodeStoreEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\QRcode\QRcodeNotification;

class QRcodeStoreListener
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
    public function handle(QRcodeStoreEvent $event): void
    {
        $store = $event->store;
        $vendor = $store->vendor;

        $vendor->notify(new QRcodeNotification($store));
    }
}
