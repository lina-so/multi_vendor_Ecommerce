<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Image;
use App\Models\Option;
use App\Models\Product;
use App\Models\OptionValue;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductService
{
/********************************************************************************************/

public function index(Request $request, $paginate = 'paginate')
{
    // dd(Product::all());
    if(Auth::guard('vendor')->check())
    {
        $filterFields = $request->only(['name','status']);

        $productsQuery = Product::where('vendor_id',Auth::guard('vendor')->user()->id)->FilterByFields($filterFields,'products');

        if ($paginate === 'paginate') {
            $products = $productsQuery->paginate(6);

        }else if($paginate === 'trash')
        {
            $products = $productsQuery->onlyTrashed()->paginate(5);
        }
        else {
            $products = $productsQuery->get();
        }

        return $products;
    }
    else if(Auth::guard('admin')->check()) {

        $filterFields = $request->only(['name','status']);

        $productsQuery = Product::FilterByFields($filterFields,'products');

        if ($paginate === 'paginate') {
            $products = $productsQuery->paginate(6);

        }else if($paginate === 'trash')
        {
            $products = $productsQuery->onlyTrashed()->paginate(5);
        }
        else {
            $products = $productsQuery->get();
        }

        return $products;
    }

}

/********************************************************************************************/

    public function createProduct($requestData)
    {
        DB::beginTransaction();

        $request = $requestData->validated();

        $slug = Str::slug($request['name']);
        $request['slug']= $slug;

        // dd($requestData);
        try {
            $product = Product::create($request);


            if ($requestData->hasFile('image')) {
                foreach ($requestData->file('image') as $image) {
                    $imagePath = $this->uploadImage($image, $product->id);

                    $imageData = new Image(['path' => $imagePath]);
                    $product->images()->save($imageData);
                }
            }

            // store options & values
            if(isset($request['options']))
            {
                foreach($request['options'] as $optionData)
                {
                    $option = Option::find($optionData['option_id']);
                    if($option)
                    {
                        foreach ($optionData['values'] as $valueData) {
                            $value = new OptionValue;
                            $value->option_id = $option->id;
                            $value->name = $valueData['value'];
                            $value->save();

                            $product->options()->attach($option->id, ['option_value_id' => $value->id]);
                        }

                    }
                }
            }
            DB::commit();
            return $product;

        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

        // Example in a controller method
        // $product = Product::find($productId);
        // $images = $product->images; // Retrieve associated images
    }
/********************************************************************************************/

    protected function uploadImage($image, $productId)
    {
        if(Auth::guard('admin')->name == 'admin'){
            $folderName = 'admin' ;
        }
        else if(Auth::guard('vendor')->name == 'vendor')
        {
            $folderName = 'vendor';
        }

        $folderPath = 'images/' . $folderName . '/products/' . $productId ;

          // Store the image in the public directory within the storage folder
        $path = Storage::disk('public')->putFile($folderPath, $image);


        return $path;

    }

/********************************************************************************************/
    public function updateProduct($requestData, $brandId)
    {
        DB::beginTransaction();

        try {
            $requestData = $requestData->validated();
            $brand = Product::findOrFail($brandId);
            $brand->update($data);
            DB::commit();
            return $brand;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
/********************************************************************************************/

    public function deleteProduct($id)
    {
        $brand = Product::findOrFail($id);
        $brand->delete();
    }
/*********************************************************************************************/
    public function deleteAll(Request $request)
    {
        $delete_all_ids = explode(',',$request->delete_all_id);
        if($request->force)
            Product::whereIn('id',$delete_all_ids)->forceDelete();
        else
            Product::whereIn('id',$delete_all_ids)->delete();

    }
}

