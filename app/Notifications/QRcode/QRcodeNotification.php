<?php

namespace App\Notifications\QRcode;

use App\Models\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class QRcodeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $store;
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $vendor = Auth::guard('vendor')->user()->name;
        $store = $this->store->vendor;
        $QRcode = 'http://127.0.0.1:8000/vendor-profile/'. $this->store->id;

        return (new MailMessage)
        ->subject("QRcode Fot your Store")
        ->from('arazona@arazona-store.ps' , 'ARAZONA STORE')
        ->greeting("Hi {$notifiable->name} ,")
        ->line("thank you for choosing 'ARAZONA STORE' ")
        ->line("Now you can put this QRcode for your store on your Social Media Accounts")
        ->action('View your Store', url('/dashboard'))
        ->line('Thank you for using our application')
        ->markdown('vendor.notifications.email', ['notifiable' => $notifiable, 'store' => $this->store, 'vendor_name' => $vendor, 'QRcode' => $QRcode]);
        // ->view(
        //     'vendor.notifications.email', // Path to your custom mail view
        //     ['notifiable' => $notifiable, 'store' => $this->store, 'vendor_name' => $vendor , 'QRcode'=>$QRcode]
        // );
        
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
