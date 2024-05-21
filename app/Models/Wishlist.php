<?php

namespace App\Models;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable  = ['user_id','wishlistable_type' ,'wishlistable_id'];

    public function wishlistable()
    {
        return $this->morphTo();
    }

    public static function countWishlist($product_id)
    {
        $countWishlist = 0;
        if(Auth::check())
        {
            $countWishlist = Wishlist::where(['user_id'=>Auth::user()->id,'wishlistable_id'=>$product_id])->count();
        }
        return $countWishlist;
    }

}
