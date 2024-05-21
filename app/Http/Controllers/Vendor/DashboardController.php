<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Auth::guard('vendor')->user());

        return view('vendor.dashboard');

    }
/*************************************************************************/
    public function markNotificationAsRead($id)
    {
         if (Auth::guard('vendor')->check()) {

        $vendor = Auth::guard('vendor')->user();
        // Find the unread notification by ID
        $unreadNotification = $vendor->unreadNotifications()->find($id);

        // Check if the unread notification exists
        if ($unreadNotification) {
            // Mark the notification as read
            $unreadNotification->markAsRead();
        }
    }

        return response()->json(['success' => true]);
    }

/***************************************************************************/

    public function register()
    {
        return view('auth.register');
    }
/***************************************************************************/

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
