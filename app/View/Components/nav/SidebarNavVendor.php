<?php

namespace App\View\Components\nav;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class SidebarNavVendor extends Component
{
    public $items , $active;
    public function __construct()
    {
        $this->items = $this->prepareItems(config('sidebarVendor'));
        $this->active = Route::currentRouteName();
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav.sidebar-nav-vendor');
    }

    protected function prepareItems($items)
    {
        $user = Auth::guard('vendor')->user();
        foreach($items as $key=>$item)
        {
            if (isset($item['ability']) && !$user->can($item['ability'])) {
                unset($items[$key]);
            }
        }
        return $items;

    }
}
