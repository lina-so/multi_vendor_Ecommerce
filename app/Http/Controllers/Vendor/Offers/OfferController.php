<?php

namespace App\Http\Controllers\Vendor\Offers;

use App\Models\Brand;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
 /*************************************************/

    public function index()
    {
        // dd("hi");
        $offers = Offer::with('offerable')->get();

        return view('vendor.offers.index', compact('offers'));
    }

 /*************************************************/

    public function create()
    {
        $brands = Brand::all();
        $products = Product::all();
        $categories = Category::all();


        return view('vendor.offers.create',compact('brands','products','categories'));

    }

 /*************************************************/
    public function store(Request $request)
    {
        // dd($request);

        if($request->radio == 1)
        {
            $brand = Brand::findOrFail($request->brand_id);
            $brand->offers()->create(['compare_price' => $request->brand_compare_price , 'period'=>$request->period]);
            $products = Product::where('brand_id',$request->brand_id)->get();
            foreach($products as $product)
            {
                if($product->price>0)
                {
                    $product->update(['compare_price' => $request->brand_compare_price]);
                }
            }

            return redirect()->route('dashboard.vendor.offers.index')->with('success','offer added successfully');
        }
        else if($request->radio == 2)
        {
            $category = Category::findOrFail($request->category_id);
            $category->offers()->create(['compare_price' => $request->category_compare_price,'period'=>$request->period]);
            $products = Product::where('category_id',$request->category_id)->get();
            foreach($products as $product)
            {
                if($product->price>0)
                {
                    $product->update(['compare_price' => $request->category_compare_price]);
                }
            }
           return redirect()->route('dashboard.vendor.offers.index')->with('success','offer added successfully');


        }
        else {
            $product = Product::findOrFail($request->product_id);
            $product->offer()->create(['compare_price' => $request->product_compare_price,'period'=>$request->period]);
            if($product->price>0)
            {
                $product->update(['compare_price' => $request->product_compare_price]);
            }
            return redirect()->route('dashboard.vendor.offers.index')->with('success','offer added successfully');


        }
    }
 /*************************************************/

    public function show(string $id)
    {
        //
    }

 /*************************************************/

    public function edit(string $id)
    {
        //
    }
 /*************************************************/

    public function update(Request $request, int $id)
    {
        $offer = Offer::findOrFail($id);
        $offer->update(['compare_price' => $request->compare_price,'period'=>$request->period]);
        if($offer->offerable_type == 'App\Models\Brand')
        {
            $products = Product::where('brand_id',$offer->offerable_id)->get();
            foreach($products as $product)
            {
                if($product->price>0)
                {
                    $product->update(['compare_price' => $request->compare_price]);
                }
            }
        }else if($offer->offerable_type == 'App\Models\Category')
        {
            $products = Product::where('category_id',$offer->offerable_id)->get();
            foreach($products as $product)
            {
                if($product->price>0)
                {
                    $product->update(['compare_price' => $request->compare_price]);
                }
            }
        }else{
            $product = Product::where('id',$offer->offerable_id)->first();

            $product->update(['compare_price' => $request->compare_price]);
        }
        return redirect()->back()->with('success', 'Discount updated successfully');
    }


 /*************************************************/

    public function destroy(string $id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();
        return redirect()->back()->with('success','offer deleted successfully');
    }
}
