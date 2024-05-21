<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Front\Cart\CartController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Dashboard\Roles\RoleController;
use App\Http\Controllers\Front\Order\CheckoutController;
use App\Http\Controllers\Vendor\Coupon\CouponController;
use App\Http\Controllers\Front\Wishlist\WishlistController;
use App\Http\Controllers\Auth\Socialite\SocialiteController;
use App\Http\Controllers\Dashboard\Product\ProductController;

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

Route::get('/', function () {
    return view('auth.register-as');
})->name('register-as');

// Auth::routes(['verify' => true]);

// Route::get('user/profile',[ProfileController::class,'index'])->middleware(['auth','verified']);
Route::get('user/profile',[ProfileController::class,'index'])->middleware(['auth:web','verified']);

// cart
Route::resource('cart', CartController::class)->except(['destroy','update']);



Route::delete('/cart/remove/{id}',  [CartController::class,'destroy'])->name('cart.remove');
Route::post('/cart/update/{id}',  [CartController::class,'update'])->name('cart.update');

// Mark Notification  as read
Route::post('/notification/MarkAsRead/{id}',  [DashboardController::class,'markNotificationAsRead'])->name('notification.read');

// checkout
Route::get('checkout',[CheckoutController::class,'index'])->name('checkout.index');
// Route::post('checkout',[CheckoutController::class,'store'])->name('checkout.store')->middleware('limit');
Route::post('checkout',[CheckoutController::class,'store'])->name('checkout.store');



// product details
Route::get('product-details/{id}', [ProductController::class,'show'])->name('product-details');
// all products
Route::get('/getAllProducts', [FrontController::class, 'getAllProducts'])->name('getAllProducts');
// sort products
Route::get('/sortProducts',[FrontController::class, 'sortProducts'])->name('sortProducts');
// home
Route::get('/home', [FrontController::class, 'index'])->name('home');
// filter products
Route::post('/productsFilter', [FrontController::class, 'ProductsFilter'])->name('ProductsFilter');
// review
Route::post('/product/review',  [FrontController::class,'review'])->name('product.review');
// wishlist
Route::post('/wishlist/{id}',  [WishlistController::class,'store'])->name('wishlist.store');
Route::get('/wishlist',  [WishlistController::class,'index'])->name('wishlist.index');
Route::delete('/wishlist/delete/{id}',  [WishlistController::class,'destroy'])->name('wishlist.delete');
// vendor profile
Route::get('/vendor-profile/{id}',  [FrontController::class,'vendorProfile'])->name('vendorProfile');
// offers
Route::get('/offers',  [FrontController::class,'getAllOffers'])->name('getAllOffers');
// checkout coupon
Route::post('/check-coupon', [CouponController::class, 'checkCoupon'])->name('checkCoupon');
// getAllCoupons
Route::get('/coupons',  [CouponController::class,'index'])->name('getAllCoupons');

//socialite (Github)
Route::get('/auth/{provider}/redirect',  [SocialiteController::class,'redirect'])->name('redirect');
Route::get('/auth/{provider}/callback',  [SocialiteController::class,'callback'])->name('callback');
