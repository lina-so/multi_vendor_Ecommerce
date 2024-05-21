<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Order;
use App\Models\Option;
use App\Models\OrderItem;
use App\Models\OptionValue;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\DeliveringOrderMailEvent;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderController extends Controller
{

/****************************************************************************************************************/

    public function index(Request $request)
{
    $vendor = Auth::guard('vendor');

    if ($vendor->check()) {
        $vendorStores = $vendor->user()->stores;

        $code = $request->input('code');
        $status = $request->input('status');
        $store_id = $request->input('store_id');

        $vendorOrders = collect();

        foreach ($vendorStores as $store) {
            $orders = $store->orders();

            if ($code) {
                $orders->where('code', $code);
            }

            if ($status) {
                $orders->where('status', $status);
            }

            if ($store_id) {
                $orders->where('store_id', $store_id);
            }

            // أضف الطلبات إلى مجموعة الطلبات للبائع
            $vendorOrders = $vendorOrders->merge($orders->get()->groupBy('user_id'));
        }
    }

    return view('vendor.orders.index', compact('vendorStores', 'vendorOrders'));
}




/****************************************************************************************************************/
    public function create()
    {
        //
    }

/****************************************************************************************************************/

    public function store(Request $request)
    {
        //
    }
/****************************************************************************************************************/

    public function show(string $id)
    {
        $optionNames = Option::pluck('name', 'id');
        $optionValues = OptionValue::pluck('name', 'id');
        $order = Order::findOrFail($id)->first();
        $orderItems = OrderItem::where('order_id',$id)->get();
        // dd($orderItems);
        return view('vendor.orders.showOrderItems',compact('orderItems','optionNames','optionValues'));
    }

/****************************************************************************************************************/

    public function edit($id)
    {
    }
/****************************************************************************************************************/

    public function update(Request $request, $id)
    {
          // $order = Order::findOrFail($id);
        $order = Order::with('products')->findOrFail($id);
        $user = $order->user;

        if (!$request->has('tracking_number')) {
            if ($order->status !== $request->status) {
                if($request->status =='completed')
                {
                    foreach ($order->products as $product) {
                        $product->increment('sales');
                    }
                }
                $order->status = $request->status;
                $order->tracking_number = null;
                $order->save();
            }
        } else {
            if ($order->status !== $request->status_delivering) {
                $order->status = $request->status_delivering;
                $order->tracking_number = $request->tracking_number;
                $order->save();
                event(new DeliveringOrderMailEvent($order,$user));
            }
        }
        return redirect()->back()->with('success',"change order's status successfully");

        }

/****************************************************************************************************************/

    public function updateStatus(Request $request, $id)
{
    // $order = Order::findOrFail($id);
    $order = Order::with('products')->findOrFail($id);
    $user = $order->user;

    if (!$request->has('tracking_number')) {
        if ($order->status !== $request->status) {
            if($request->status =='completed')
            {
                foreach ($order->products as $product) {
                    $product->increment('sales');
                }
            }
            $order->status = $request->status;
            $order->tracking_number = null;
            $order->save();
        }
    } else {
        if ($order->status !== $request->status_delivering) {
            $order->status = $request->status_delivering;
            $order->tracking_number = $request->tracking_number;
            $order->save();
            event(new DeliveringOrderMailEvent($order,$user));
        }
    }
    return redirect()->back()->with('success',"change order's status successfully");

}

/****************************************************************************************************************/

    public function destroy(string $id)
    {
        //
    }
}
