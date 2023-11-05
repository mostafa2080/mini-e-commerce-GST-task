<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



//public routes
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

//admin routes
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/categories', [CategoryController::class, 'listCategories']);
    Route::get('/product/category/{category}', [ProductController::class, 'getProductsByCategory']);
    Route::get('/banners', [BannerController::class, 'listBanners']);
});

//user routes
Route::middleware('auth:sanctum', 'role:user')->group(function () {
    Route::post('/add-to-cart', [CartController::class, 'addToCart']);
    Route::get('/user/cart', [CartController::class, 'getUserCart']);
    Route::post('/add-shipping-address', [ShippingAddressController::class, 'addShippingAddress']);
    Route::get('user/shipping-addresses', [ShippingAddressController::class, 'userShippingAddresses']);
    Route::put('shipping-addresses/{shippingAddress}', [ShippingAddressController::class, 'updateShippingAddress']);
});

//authenticated general routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', [UserController::class, 'getUserData']);
    Route::put('users/{user}', [UserController::class, 'updateUserData']);
});
