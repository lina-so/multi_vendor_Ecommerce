<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\AjaxController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\store\StoreController;
use App\Http\Controllers\Vendor\Offers\OfferController;
use App\Http\Controllers\Vendor\Coupon\CouponController;
use App\Http\Controllers\Vendor\Review\ReviewController;
use App\Http\Controllers\Dashboard\Brand\BrandController;
use App\Http\Controllers\Vendor\Product\ProductController;
use App\Http\Controllers\Dashboard\Option\OptionController;
use App\Http\Controllers\Dashboard\Admin\AdminLoginController;
use App\Http\Controllers\Dashboard\Category\CategoryController;
use App\Http\Controllers\Dashboard\Admin\AdminRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('vendor/register', function () {
//     return view('auth.register');
// });

Route::group([
    // 'middleware'=>['vendor'],
    'as' => 'dashboard.',
    'prefix' => 'vendor/dashboard',
], function () {


    Route::get('/dashboard',[DashboardController::class,'index'])->name('vendor.dashboard');



    Route::get('/products/trash',[ProductController::class,'trash'])->name('products.vendor.trash');
    Route::put('/products/{brand}/restore',[ProductController::class,'restore'])->name('products.vendor.restore');
    Route::delete('/products/{brand}/forceDelete',[ProductController::class,'forceDelete'])->name('products.vendor.forceDelete');
    Route::delete('/products/deleteAll',[ProductController::class,'deleteAll'])->name('products.vendor.deleteAll');



    Route::resource('/products', ProductController::class, [
        'names' => 'vendor.products',
    ]);


    Route::post('/orders/update/{id}',[OrderController::class,'updateStatus'])->name('updateStatus');

    Route::resource('/orders', OrderController::class, [
        'names' => 'vendor.orders',
    ]);


    Route::resource('/offers', OfferController::class, [
        'names' => 'vendor.offers',
    ]);

    Route::resource('/reviews', ReviewController::class, [
        'names' => 'vendor.reviews',
    ]);

    Route::post('/update-review-status', [ReviewController::class,'updateStatus']);


    // Route::post('/update_order_status/{id}',[OrderController::class,'updateStatus'])->name('updateStatus');


    Route::delete('/orders/deleteAll',[OrderController::class,'deleteAll'])->name('orders.vendor.deleteAll');


    Route::resource('/stores', StoreController::class, [
        'names' => 'vendor.stores',
    ]);

    Route::resource('/coupon', CouponController::class, [
        'names' => 'vendor.coupon',
    ]);

    Route::get('/get_brand_categories/{id}', [AjaxController::class, 'get_brand_categories'])->name('get_brand_categories');


    // Route::get('/orders',[ OrderController::class,'index'])->name('vendor.orders.index');

    Route::get('/get-stores/{id}', [StoreController::class, 'getStores'])->name('getStores');

    Route::get('/download/{mediaId}', [StoreController::class,'download'])->name('download.file');


});

// Route::get('/vendor/register',[DashboardController::class,'register'])->name('vendor.register');

