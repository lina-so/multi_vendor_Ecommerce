<?php

namespace App\Services;


use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Events\QRcode\QRcodeStoreEvent;

class StoreService
{
/********************************************************************************************/

public function index()
{
    $vendor = Auth::guard('vendor');
    if ($vendor->check()) {
        $vendorStores = $vendor->user()->stores;
    }
    else{
        $vendorStores = collect();
    }
    return $vendorStores;
}

/********************************************************************************************/

    public function createStore($requestData)
    {
        DB::beginTransaction();

        try {
            $request = $requestData->validated();
            $store = Store::create($request);

            // dd($requestData);

            if ($requestData->hasFile('logo')) {
                $store->addMediaFromRequest('logo')->toMediaCollection('images');
            }

            // upload pdf
            if ($requestData->hasFile('return_policy')) {

                $pdfPath1 = $requestData->file('return_policy')->storeAs('pdfs', 'return_policy.pdf', 'public');
                 $store->addMedia(storage_path('app/public/' . $pdfPath1))->toMediaCollection('pdf1');
            }

            if ($requestData->hasFile('shipping_policy')) {
                $pdfPath2 = $requestData->file('shipping_policy')->storeAs('pdfs', 'shipping_policy.pdf', 'public');
                 $store->addMedia(storage_path('app/public/' . $pdfPath2))->toMediaCollection('pdf2');

            }


            event(new QRcodeStoreEvent($store));


            DB::commit();
            return $store;

        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

/********************************************************************************************/

public function updateStore($requestData, $storeId)
{
    DB::beginTransaction();

    try {
        $store = Store::findOrFail($storeId);
        $request = $requestData->validated();
        $store->update($request);

        // dd($requestData);

        // update logo
        if ($requestData->hasFile('logo')) {
            if ($store->hasMedia('images')) {
                $store->clearMediaCollection('images');
            }

            $store->addMediaFromRequest('logo')->toMediaCollection('images');
        }

        // update pdf
        if ($requestData->hasFile('return_policy')) {
            if ($store->hasMedia('pdf1')) {
                $store->clearMediaCollection('pdf1');
            }
            $pdfPath1 = $requestData->file('return_policy')->storeAs('pdfs', 'return_policy.pdf', 'public');
            $store->addMedia(storage_path('app/public/' . $pdfPath1))->toMediaCollection('pdf1');
        }

        if ($requestData->hasFile('shipping_policy')) {
            if ($store->hasMedia('pdf2')) {
                $store->clearMediaCollection('pdf2');
            }
            $pdfPath2 = $requestData->file('shipping_policy')->storeAs('pdfs', 'shipping_policy.pdf', 'public');
            $store->addMedia(storage_path('app/public/' . $pdfPath2))->toMediaCollection('pdf2');

        }



        DB::commit();
        return $store;

    } catch (\Exception $e) {
        DB::rollback();
        return $e->getMessage();
    }
}

/********************************************************************************************/

    public function deleteStore($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
    }

/*********************************************************************************************/

    public function deleteSelectedStores(array $storeIds)
    {
        // Delete stores based on the provided IDs
        Store::whereIn('id', $storeIds)->delete();
    }
}

