<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationsMenu extends Component
{

    public $allNotification , $newCount;
    public function __construct($count = 10)
    {
        $user = Auth::guard('vendor');
        // dd($user);

        if (Auth::guard('vendor')->check()) {
            $user = Auth::guard('vendor')->user();
            $this->allNotification = $user->notifications()->take($count)->get();
            $this->newCount = $user->unreadNotifications()->count();
        } else {
            $this->allNotification = collect();
            $this->newCount = 0;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notifications-menu');
    }
}
