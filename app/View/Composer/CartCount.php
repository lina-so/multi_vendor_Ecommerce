<?php

namespace App\View\Composer;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class CartCount
{
    public $cartCount;
    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
        $user = Auth::user();
        $cartCount = 0;
        if($user)
        {
            $cartCount = Cart::with('product')->where('user_id',Auth::id())->count();
        }
            $mainCategoriesWithSubCategories = Category::with('subcategories')->whereNull('parent_id')->take(3)->get();
            $products = Product::with('brand','options','optionValues','images','offer','productOptionValues')->latest()->paginate(12);
            $brands = Brand::all();
            $bestSellingProducts = Product::orderBy('sales', 'desc')->take(6)->get();


        $view->with('cartCount', $cartCount)->
        with('mainCategoriesWithSubCategories',$mainCategoriesWithSubCategories)->with('products',$products)
        ->with('brands',$brands)->with('bestSellingProducts',$bestSellingProducts);
    }
}
