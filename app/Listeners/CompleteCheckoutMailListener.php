<?php

namespace App\Listeners;

use App\Mail\CompleteCheckoutMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CompleteCheckoutMailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompleteCheckoutMailListener
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
        $checkout = $event->checkout;
        $user = $event->user;

        Mail::to($user->email)->send(new CompleteCheckoutMail($checkout,$user));

    }
}
