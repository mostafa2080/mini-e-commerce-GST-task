<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;


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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('users', [UserController::class, 'index'])->name('list.users');
    Route::get('/inactive/user/{id}', [UserController::class, 'InactiveUser'])->name('inactive.user');
    Route::get('/active/user/{id}', [UserController::class, 'activeUser'])->name('active.user');
    Route::get('/add/category', [CategoryController::class, 'create'])->name('create.category');
    Route::get('/category/list', [CategoryController::class, 'index'])->name('list.categories');
    Route::post('/store/category', [CategoryController::class, 'store'])->name('store.category');
    Route::get('/add/product', [ProductController::class, 'create'])->name('create.product');
    Route::post('/store/product', [ProductController::class, 'store'])->name('store.product');
    Route::get('/add/banner', [BannerController::class, 'create'])->name('create.banner');
    Route::post('/store/banner', [BannerController::class, 'store'])->name('store.banner');
}); //end admin routes

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class)->name('admin.login');
Route::get('admin/logout/page', [AdminController::class, 'adminLogoutPage'])->name('admin.logout.page');
