<?php

namespace App\View\Components\Admin\Dashboard;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationsMenu extends Component
{
    public $allNotification , $newCount;
    public function __construct($count = 10)
    {
        $user = Auth::guard('admin');
        // dd($user);

        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
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
        return view('components.admin.dashboard.notifications-menu');
    }
}
