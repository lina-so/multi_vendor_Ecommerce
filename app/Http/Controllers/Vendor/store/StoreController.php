<?php

namespace App\Http\Controllers\Vendor\store;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Services\StoreService;
use App\Services\SoftDeleteService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreStoreRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class StoreController extends Controller
{
    protected $productService,$softDeleteService ,$brandService ,$categoryService;

    public function __construct(StoreService $storeService,SoftDeleteService $softDeleteService)
    {
        $this->storeService = $storeService;
        $this->softDeleteService = $softDeleteService;
    }
    /*************************************************************************************************/
    public function index()
    {
        $vendorStores = $this->storeService->index();
        return view('vendor.stores.index',compact('vendorStores'));
    }

      /*************************************************************************************************/

    public function create()
    {
        $store = new Store;

        return view('vendor.stores.create',compact('store'));
    }

    /*************************************************************************************************/

    public function store(StoreStoreRequest $request)
    {
        $store = $this->storeService->createStore($request);
        //    dd($store);
        if (is_string($store)) {
            return back()->with('customError', 'store creation failed: ' . $store);
        }

        return redirect()->route('dashboard.vendor.stores.index')->with('success','store created successfully!');

    }

    /*************************************************************************************************/

    public function show(string $id)
    {
        //
    }
    /*************************************************************************************************/

    public function edit(string $id)
    {
        $store = Store::findOrFail($id);
        return view('vendor.stores.edit',compact('store'));
    }

    /*************************************************************************************************/

    public function update(StoreStoreRequest $request, string $id)
    {
        $store = $this->storeService->updateStore($request,$id);
        //    dd($store);
        if (is_string($store)) {
            return back()->with('customError', 'store creation failed: ' . $store);
        }

        return redirect()->route('dashboard.vendor.stores.index')->with('success','store updated successfully!');
    }

    /*************************************************************************************************/

    public function destroy(string $id)
    {
        $stores = $this->storeService->deleteStore($id);
        return redirect()->route('dashboard.vendor.stores.index')->with('success','store deleted successfully !!');
    }
    /*************************************************************************************************/

    public function getStores($id)
    {
        $stores = Store::where('vendor_id', $id)->pluck('name', 'id');

        return response()->json($stores);
    }
    /*************************************************************************************************/

    public function download($mediaId)
    {
        $mediaItem = Media::findOrFail($mediaId);

        return response()->download($mediaItem->getPath(), $mediaItem->file_name);
    }
    /*****************************************************************************************************/
    public function deleteAllStores(Request $request)
    {
        // Call the service method to delete all selected stores
        $this->storeService->deleteSelectedStores($request->delete_all_ids);

        return redirect()->back()->with('success', 'Selected stores have been deleted successfully.');
    }
}


/**
[
    {"name": "Facebook", "link": "https://www.facebook.com/store-page"},
    {"name": "Twitter", "link": "https://www.twitter.com/store_page"},
    {"name": "Instagram", "link": "https://www.instagram.com/storepage"}
]

 */
