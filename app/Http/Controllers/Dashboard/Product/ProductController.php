<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Models\Store;
use App\Models\Option;
use App\Models\Review;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Services\BrandService;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Support\Facades\DB;
use App\Services\SoftDeleteService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    protected $productService,$softDeleteService ,$brandService ,$categoryService;

    public function __construct(ProductService $productService ,BrandService $brandService, CategoryService $categoryService,SoftDeleteService $softDeleteService)
    {
        $this->productService = $productService;
        $this->softDeleteService = $softDeleteService;
        $this->brandService = $brandService;
        $this->categoryService = $categoryService;

    }

    /*****************************************************************************************************/

    public function index(Request $request)
    {
          // if(!Gate::allows('carts.view')) //=  Gate::denies('carts.view')
        // {
        //     abort(403);
        // }
        // Gate::authorize('carts.view');

        $paginate = 'paginate';
        $products = $this->productService->index($request,$paginate);
        return view('dashboard.products.index',compact('products'));
    }

    /*****************************************************************************************************/


    public function create(Request $request)
    {
        $paginate = false;

        $product = new Product;
        $categories = $this->categoryService->index($request,$paginate);
        $brands = $this->brandService->index($request,$paginate);
        $vendors = Vendor::all();
        $options = Option::all();
        $stores = Store::all();



        return view('dashboard.products.create',compact('product','categories','brands','vendors','options','stores'));
    }

    /*****************************************************************************************************/

    public function store(StoreProductRequest $request)
    {
        // dd($request->validated());
        $product = $this->productService->createProduct($request);
           // افحص إذا كانت النتيجة رسالة خطأ
        //    dd($product);
        if (is_string($product)) {
            return back()->with('customError', 'Product creation failed: ' . $product);
        }


        return redirect()->route('dashboard.products.index')->with('success','product created!');
    }

    /*****************************************************************************************************/

    public function show($id)
    {
        $product = Product::with('options','images','optionValues','brand','reviews','store')->findOrFail($id);
        $optionsWithValues = $product->productOptionValues->groupBy('option.name');
        $sumRating = Review::where('product_id',$id)->sum('rating');
        $countRating = Review::where('product_id',$id)->count();
        $overAllRatings = 0;
        if($countRating>0)
        {
            $overAllRatings = round($sumRating/$countRating,2);
        }
        $ratings_count = Review::select('rating', DB::raw('COUNT(*) as count'))
        ->groupBy('rating')
        ->pluck('count', 'rating');

        $inWishlist = Wishlist::countWishlist($id);


        // dd($optionsWithValues);
        return view('layouts.front.sections.product-details',compact('product','optionsWithValues','overAllRatings','countRating','ratings_count','inWishlist'));
    }

    /*****************************************************************************************************/

    public function edit(string $id)
    {
        $product = Product::find($id);
        if(!$product)
        {
            return redirect()->route('dashboard.products.index')->with('info','Record not found!');
        }

        return view('dashboard.products.edit',[
            'product'=>$product,
        ]);
    }

    /*****************************************************************************************************/

    public function update(StoreProductRequest $request, string $id)
    {
        $product = $this->productService->updateProduct($request,$id);
        return redirect()->route('dashboard.products.index')->with('success', 'product updated!');
    }


    /*****************************************************************************************************/
    public function destroy(string $id)
    {
        $product = $this->productService->deleteProduct($id);
        return redirect()->route('dashboard.products.index')->with('success','product deleted!');
    }

    /*****************************************************************************************************/
    public function trash(Request $request)
    {
        $paginate = 'trash';
        $products = $this->productService->index($request,$paginate);
        return view('dashboard.products.trash',compact('products'));

    }

    /*****************************************************************************************************/
    public function restore($id)
    {
        $product = $this->softDeleteService->restore(Product::class,$id);
        return redirect()->route('dashboard.products.trash')->with('success','product restored successfully !!');
    }

    /*****************************************************************************************************/
    public function forceDelete($id)
    {
        $product = $this->softDeleteService->forceDelete(Product::class,$id);
        return redirect()->route('dashboard.products.trash')->with('success','product deleted successfully !!');
    }
     /*****************************************************************************************************/
     public function deleteAll(Request $request)
     {
         $products = $this->productService->deleteAll($request);
         return redirect()->route('dashboard.products.trash')->with('success','products deleted successfully !!');
     }
     /*****************************************************************************************************/

}

