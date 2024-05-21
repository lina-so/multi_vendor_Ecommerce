<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $addr = $this->order->billingAddress;
        $user = Auth::user()->name;
        return (new MailMessage)
                    ->subject("New Order #{$this->order->code}")
                    ->from('arazona@arazona-store.ps' , 'ARAZONA STORE')
                    ->greeting("Hi {$notifiable->name} ,")
                    ->line("new order (#{$this->order->code}) created by {$user}")
                    ->action('View Order', url('/dashboard'))
                    ->line('Thank you for using our application');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $addr = $this->order->billingAddress;
        $user = Auth::user()->name;

        return[
            "body" => "order (#{$this->order->code}) created by {$user} ",
            "icon" =>'lni lni-star-filled',
            "url" => url('/dashboard'),
            "order_id" => $this->order->id,

        ];
    }
}
