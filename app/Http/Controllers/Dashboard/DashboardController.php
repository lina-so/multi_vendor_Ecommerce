<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /*****************************************************************************************************/

    public function index()
    {
        $allUsers = User::count();
        $allVendors = Vendor::count();
        $allOrders = Order::count();
        $newOrders = Order::where('created_at',now())->count();
        return view('dashboard.dashboard' , compact('allUsers','allVendors','allOrders','newOrders'));
    }

    /*****************************************************************************************************/

}
