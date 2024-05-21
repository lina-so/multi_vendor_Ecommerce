<?php

namespace App\Http\Controllers\Front;

use App\Models\Role;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\Store;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReviewRequest;

class FrontController extends Controller
{
/*****************************************************************************************************/
    public function index()
    {
        // $guard = Auth::guard('vendor')->check();
        // if(!$guard)
        // {
        //     $user = Auth::user();
        // }
        // $user = Auth::guard('vendor')->user();

        // $role = $user->roleUsers->role_id;


        // $roleAbilities = Role::findOrFail($role);
        // $abilities = $roleAbilities->abilities;

        // $abilityCollection = collect();

        // foreach ($abilities as $ability) {
        //     $abilityName = $ability->ability;
        //     $abilityType = $ability->type;

        //     if($abilityType == 'allow')
        //     {
        //         $abilityCollection->push([
        //             'ability' => $abilityName,
        //             'type' => $abilityType
        //         ]);
        //     }
        // }


        $mainCategoriesWithSubCategories = Category::with('subcategories')->whereNull('parent_id')->take(3)->get();
        $featuredProducts = Product::where('status','active')->where('featured',1)->latest()->with('images')->take(8)->get();
        $newProducts = Product::where('status','active')->latest()->with('images')->take(8)->get();
        $bestSellingProducts = Product::orderBy('sales', 'desc')->take(8)->get();


        return view('layouts.front.home',compact('featuredProducts','mainCategoriesWithSubCategories','newProducts','bestSellingProducts'));
    }
/*****************************************************************************************************/

    public function getAllProducts()
    {
        $products = Product::with('brand','options','optionValues','images','offer','productOptionValues')->latest()->paginate(12);
        $mainCategoriesWithSubCategories = Category::with('subcategories')->whereNull('parent_id')->take(3)->get();
        $brands = Brand::all();

        return view('layouts.front.sections.all_products',compact('products','mainCategoriesWithSubCategories','brands'));
    }

/*****************************************************************************************************/

    public function sortProducts(Request $request)
    {
        $sortBy = $request->sortBy;

        if ($sortBy === 'price') {
            $products = Product::with(['images' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])->orderBy('price', 'asc')->get();
        } elseif ($sortBy === 'name') {
            $products = Product::with(['images' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])->orderBy('name', 'asc')->get();
        } else {
            $products = Product::with('images')->get();
        }

        return response()->json($products);
    }
/*****************************************************************************************************/
    /*
     "_token" => "24dAFMMhZZqrfDHWdRRQ1i5LgKoUTcGtUIHqo0PX"
      "mainCategory" => "1"
      "subCategory" => "9"
      "brand" => "7"
      "color" => "pink"
      "priceRange" => "1000-10000"
    ]
     */


    public function ProductsFilter(Request $request)
    {
    $validatedData = $request->validate([
        'mainCategory' => 'nullable|exists:categories,id',
        'subCategory' => 'nullable|exists:categories,id',
        'brand' => 'nullable|exists:brands,id', // assuming you have a brands table
        'priceRange' => 'nullable',
    ]);

    $products = Product::query();

    $products->when($request->filled('mainCategory'), function ($query) use ($validatedData) {
        $query->where('category_id', $validatedData['mainCategory']);
    });

    $products->when($request->filled('brand'), function ($query) use ($validatedData) {
        $query->where('brand_id', $validatedData['brand']);
    });

    $products->when($request->filled('priceRange'), function ($query) use ($validatedData) {
        $priceRangeArray = explode('-', $validatedData['priceRange']);
        $minPrice = $priceRangeArray[0];
        $maxPrice = $priceRangeArray[1];

        $query->whereBetween('price', [$minPrice, $maxPrice]);
    });

    $products = $products->with('images')->paginate(10);


    return response()->json($products);
    }

/*****************************************************************************************************/
    public function review(StoreReviewRequest $request)
    {
        $data =$request->validated();
        $review_exists = Review::where('user_id',Auth::user()->id )->where('product_id',$data['product_id'])->count();
        if($review_exists>0)
        {
             return redirect()->back()->with('danger','you are already rating this product');
        }
        else{
            $review = Review::create($data);
            return redirect()->back()->with('success','you are rating this product successfully');
        }

    }
/*****************************************************************************************************/
    public function vendorProfile($id)
    {
        $store = Store::with('vendor','products')->findOrFail($id);
        return view('layouts.front.sections.vendorProfile.vendor-profile',compact('store'));
    }
    /*******************************************************************************************************/

    public function getAllOffers()
    {
        $offers = Offer::all();
        $items = collect([]);

        foreach ($offers as $offer) {
            $offerable = $offer->offerable;

            if ($offerable instanceof Brand || $offerable instanceof Category) {
                $items = $items->merge($offerable->products);
            } elseif ($offerable instanceof Product) {
                $items->push($offerable);
            }
        }
            // إزالة المنتجات المكررة
        $items = $items->unique('id');
        // dd($items);

        $bestSellingProducts = Product::orderBy('sales', 'desc')->take(6)->get();

        return view('layouts.front.sections.offers',compact('items','bestSellingProducts'));
    }


}
