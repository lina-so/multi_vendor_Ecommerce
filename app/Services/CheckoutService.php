<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderItem;
use App\Models\OrderAdress;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;
use App\Services\SoftDeleteService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;
use App\Events\CompleteCheckoutMailEvent;

class CheckoutService
{
/********************************************************************************************/

    public function confirmOrder($requestData,$items)
    {

        $request = $requestData->validated();
        DB::beginTransaction();
        try{
            foreach($items as $store_id => $cart_items)
            {
                // Check the coupon
                $couponCode = $requestData->input('coupon_code');
                $coupon = Coupon::where('code', $couponCode)->first();

                $totalAmountAfterDiscount = $requestData->total ;
                if($coupon)
                {
                    if ($coupon->max_uses > 0 || $coupon->expires_at > now())  {
                        // Check the type of the coupon
                        if ($coupon->type === 'fixed') {
                            $discountAmount = $coupon->discount_amount;
                        } elseif ($coupon->type === 'percent') {
                            $discountAmount = $requestData->total * ($coupon->discount_amount / 100);
                        }
                        // Calculate the total amount after discount
                        $totalAmountAfterDiscount = $requestData->total - $discountAmount;

                    } else {
                        $totalAmountAfterDiscount = $requestData->total; // No coupon available
                    }
                }


                $order = Order::create([
                    'user_id'=>Auth::id(),
                    'store_id'=>$store_id,
                    'payment_method'=>'PayPal',
                    'total'=>$totalAmountAfterDiscount,
                ]);

                foreach($cart_items as $item)
                {
                    $order_item = OrderItem::create([
                        'order_id'=>$order->id,
                        'product_id'=>$item->product_id,
                        'product_name'=>$item->product->name,
                        'price'=>$item->product->price,
                        'quantity'=>$item->quantity,
                        'options'=>$item->options,
                    ]);

                       // انقاص كمية المنتح
                    $product = $item->product;
                    if($product->quantity>0)
                    {
                        $new_quantity = $product->quantity - $item->quantity;
                        $product->update(['quantity' => $new_quantity]);
                    }
                }//end sub foreach

                $rawStreetAddress = $requestData->shipping ? ['add3'=>$requestData->add3] : [
                    'add1' => $requestData->add3,
                    'add2' => $requestData->add2,
                ];

                $streetAddress = json_encode($rawStreetAddress, JSON_UNESCAPED_UNICODE);

                $orderAddress = OrderAdress::create([
                    'order_id' => $order->id,
                    'type' => $requestData->shipping ? 'shipping' : 'billing',
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'email' => $request['email'],
                    'phone_number' => $request['phone_number'],
                    'street_address' => $streetAddress,
                    'city' => $request['city'],
                    'country' => $request['country'],
                    'postal_code' => $request['postal_code'],
                ]);

                event(new CompleteCheckoutMailEvent($order,Auth::user()));

            }//end foreach

            foreach ($items as $storeItems) {
                foreach ($storeItems as $item) {
                    $item->delete();
                }
            }

            session()->forget('coupon');


         DB::commit();

        }catch(Exception $e)
        {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
