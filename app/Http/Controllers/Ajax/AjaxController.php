<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    public function get_brand_categories(Request $request,$id)
    {
        $categories = Product::where('brand_id', $id)->pluck('name', 'id');
        return response()->json($categories);
    }
}
