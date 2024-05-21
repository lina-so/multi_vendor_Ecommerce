<?php

namespace App\Http\Controllers\Vendor\Coupon;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Coupon\CouponRequest;

class CouponController extends Controller
{
   /*************************************************************/
    public function index()
    {


        $coupons =  Coupon::all();
        $couponCount = Coupon::count();
        if(Auth::guard('vendor')->check())
        {
            // $user = Auth::guard('vendor')->user();
            // dd($user->HasRoles);
            // if (Gate::denies('coupons.index')) {
            //     abort(403, 'Unauthorized');
            // }

            return view('vendor.coupon.index',compact('coupons','couponCount'));
        }else{
            return view('layouts.front.sections.coupons',compact('coupons','couponCount'));

        }
    }

   /*************************************************************/

    public function create()
    {
        $coupon = new Coupon();
        return view('vendor.coupon.create',compact('coupon'));
    }

    /*************************************************************/


    public function store(CouponRequest $request)
    {
        $requestData = $request->validated();

        $coupon = Coupon::create($requestData);

        $message = 'Coupon added successfully';
        return redirect()->route('dashboard.vendor.coupon.index')->with('success',$message);

    }




    /*************************************************************/

    public function show(string $id)
    {
        //
    }

    /*************************************************************/

    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('vendor.coupon.edit',compact('coupon'));
    }

   /*************************************************************/

    public function update(CouponRequest $request, string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $requestData = $request->validated();
        $coupon->update($requestData);

        $message = 'Coupon updated successfully';
        return redirect()->route('dashboard.vendor.coupon.index')->with('success',$message);


    }



   /*************************************************************/

    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        $message = 'Coupon deleted successfully';
        return redirect()->route('dashboard.vendor.coupon.index')->with('success',$message);



    }
   /*************************************************************/

   public function checkCoupon(Request $request)
   {
       $couponCode = $request->input('coupon_code');
       $coupon = Coupon::where('code', $couponCode)->first();

       $totalAmount = $request->input('total');
       session()->put('coupon', $couponCode);

       if ($coupon && $coupon->max_uses > 0 && $coupon->expires_at >= now()) {
           $new_max_uses = $coupon->max_uses - 1;
           $coupon->update(['max_uses' => $new_max_uses]);

           // Check the type of the coupon
           if ($coupon->type === 'fixed') {
               $discountAmount = $coupon->discount_amount;
           } elseif ($coupon->type === 'percent') {
               $discountAmount = $totalAmount * ($coupon->discount_amount / 100);
           }
           $finalPrice = $totalAmount - $discountAmount;

           return response()->json([
               'valid' => true,
               'finalPrice' => $finalPrice
           ]);
       } else {
           session()->forget('coupon'); //
           $finalPrice = $totalAmount; // No coupon available
           return response()->json([
               'valid' => false,
               'finalPrice' => $finalPrice  // إرسال السعر النهائي دون تطبيق الخصم
           ]);
       }
   }



}
