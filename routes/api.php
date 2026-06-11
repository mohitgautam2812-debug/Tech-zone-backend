<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InquiryContactController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AboutPageController;

Route::get('/products', [ProductController::class, 'apiProducts']);

Route::get('/products/{id}', function ($id) {
    return Product::with('category', 'user', 'images')
        ->where('status', 'approved')
        ->findOrFail($id);
});

Route::post('/cart', [CartController::class, 'store']);

Route::get('/cart/{user}', [CartController::class, 'show']);

Route::put('/cart/{id}', [CartController::class, 'updateQty']);

Route::delete('/cart/{id}', [CartController::class, 'destroy']);


Route::post('/register', [AuthController::class, 'registerApi']);

Route::post('/login', [AuthController::class, 'loginApi']);

Route::post('/send-otp', [AuthController::class, 'sendOtp']);

Route::get('/my-orders/{id}', function ($id) {
    return \App\Models\Order::with('product')
        ->where('user_id', $id)
        ->latest()
        ->get();
});

// Wishlist
Route::post('/wishlist', function (Request $request) {
    return Wishlist::create([
        'user_id' => $request->user_id,
        'product_id' => $request->product_id,
    ]);
});

Route::get('/wishlist/{id}', function ($id) {
    return Wishlist::with('product.category')
        ->where('user_id', $id)
        ->latest()
        ->get();
});

Route::delete('/wishlist/{id}', function ($id) {
    Wishlist::findOrFail($id)->delete();
    return response()->json(['success' => true]);
});


Route::post('/inquiries', [InquiryContactController::class, 'storeApi']);


Route::post('/reviews', [ReviewController::class, 'storeApi']);

Route::get('/reviews/{productId}', [ReviewController::class, 'productReviews']);

Route::put('/reviews/{id}', [ReviewController::class, 'update']);

Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);

Route::get('/can-review/{productId}/{userId}', [ReviewController::class, 'canReview']);

Route::post('/generate-login-token', [AuthController::class, 'generateLoginToken']);

Route::get('/footer-settings', [SettingController::class, 'footer']);


Route::get('/featured-products', function () {
    return Product::with('category', 'user', 'images')
        ->where('status', 'approved')
        ->where('is_featured', 1)
        ->latest()
        ->take(6)
        ->get();
});

Route::post('/stripe/payment', [OrderController::class, 'stripePayment']);

Route::get('/invoice/{id}', [OrderController::class, 'downloadInvoice']);

Route::put('/cancel-order/{id}', [OrderController::class, 'cancelOrder']);

Route::get('/pages/{page}', [PageController::class, 'show']);

Route::get('/home-page', [PageController::class, 'homeApi']);


Route::prefix('blogs')->group(function () {
    Route::get('featured', [BlogController::class, 'apiFeatured'])->name('api.blogs.featured');
    Route::get('categories', [BlogController::class, 'apiCategories'])->name('api.blogs.categories');
    Route::get('/', [BlogController::class, 'apiIndex'])->name('api.blogs.index');
    Route::get('{slug}', [BlogController::class, 'apiShow'])->name('api.blogs.show');
});


Route::get('/categories', [CategoryController::class, 'apiCategories']);

// Return requests
Route::post('/return-request', [ReturnController::class, 'store']);
Route::get('/return-request/{orderId}', [ReturnController::class, 'show']);

// Refunds
Route::post('/refund-request', [RefundController::class, 'apiStore']);
Route::get('/refund-status/{orderId}', [RefundController::class, 'apiStatus']);
Route::get('/my-refunds/{userId}', [RefundController::class, 'apiUserRefunds']);


Route::post('/profile/update', [UserController::class, 'updateProfile']);

Route::post('/change-password', [UserController::class, 'changePassword']);

Route::get('/user-address/{id}', [OrderController::class, 'getUserAddress']);

Route::get('/addresses/{userId}', [AddressController::class, 'index']);

Route::post('/addresses', [AddressController::class, 'store']);

Route::put('/addresses/{id}', [AddressController::class, 'update']);

Route::delete('/addresses/{id}', [AddressController::class, 'destroy']);

Route::post('/addresses/default/{id}', [AddressController::class, 'setDefault']);

Route::get('/payments/{userId}', [OrderController::class, 'paymentHistory']);

Route::get('/my-inquiries/{email}', [InquiryContactController::class, 'userInquiries']);

Route::get('/about-page', [AboutPageController::class, 'aboutApi'])->name('about.api');