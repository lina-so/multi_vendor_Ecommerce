<?php

namespace App\Services;


use Carbon\Carbon;
use App\Models\Store;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class WishlistService
{
/********************************************************************************************/

public function index()
{

    $guard = Auth::guard('vendor')->check();
        if(!$guard)
        {
            $user = Auth::user();
        }
        else {
            $user = Auth::guard('vendor')->user();

        }

    $wishlists = Wishlist::where('user_id',$user->id)->where('wishlistable_type', 'App\Models\Product')->get();
    $wishlistProducts = collect();

    $inWishlist = 0;
    foreach ($wishlists as $wishlist) {
        if ($wishlist->wishlistable_type === 'App\Models\Product') {
            $product = Product::find($wishlist->wishlistable_id);
            $inWishlist = Wishlist::countWishlist($product->id);
            $wishlistProducts->push($product);
        }
    }
    $data = [
        'wishlistProducts'=>$wishlistProducts,
        'inWishlist'=>$inWishlist>0 ? $inWishlist : 0
    ];

    return $data;
}



/********************************************************************************************/

public function storeItem($id)
{
    DB::beginTransaction();

    try {
        $product = Product::findOrFail($id);


        $guard = Auth::guard('vendor')->check();
        if(!$guard)
        {
            $user = Auth::user();
        }
        $user = Auth::guard('vendor')->user();

        $ifExistsInWishlist = Wishlist::where('wishlistable_id',$id)->where('user_id',$user->id)->exists();
        if($ifExistsInWishlist)
        {
            return  ;
        }
        $wishlistData = new Wishlist(['user_id' => $user->id]);
        $product->wishlists()->save($wishlistData);



        DB::commit();
        return $product;

    } catch (\Exception $e) {
        DB::rollback();
        return $e->getMessage();
    }
}


/********************************************************************************************/

    public function deleteItem($id)
    {
        // $store = Store::findOrFail($id);
        // $store->delete();
    }

/*********************************************************************************************/


}

