<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;

// Seller route
Route::get('/seller', [SellerController::class, 'index'])->name('seller.index');

// Storefront User routes
Route::get('/', [UserController::class, 'index'])->name('user.index');
Route::get('/register', [UserController::class, 'create'])->name('user.create');
Route::get('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/login', [UserController::class, 'loginStore'])->name('user.login.store');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::resource('user', UserController::class)->only(['index','create','store'])->names([
    'index' => 'user.list',
    'create' => 'user.add',
    'store' => 'user.store',
]);

// Storefront Search Route
Route::get('/search', [UserController::class, 'search'])->name('user.search');

// Dynamic Cart Endpoints
Route::get('/cart', [UserController::class, 'getCart'])->name('user.cart.get');
Route::post('/cart/add', [UserController::class, 'addToCart'])->name('user.cart.add');
Route::delete('/cart/{id}', [UserController::class, 'removeFromCart'])->name('user.cart.remove');

// Dynamic Checkout & Order Routes
Route::get('/checkout', [UserController::class, 'checkout'])->name('user.checkout');
Route::post('/checkout', [UserController::class, 'processCheckout'])->name('user.checkout.process');
Route::get('/order-confirmation/{order_number}', [UserController::class, 'orderConfirmation'])->name('user.order.confirmation');
Route::get('/my-orders', [UserController::class, 'myOrders'])->name('user.orders');

// Dynamic Product Details & Review Submission
Route::get('/product/{id?}', [UserController::class, 'showProduct'])->name('user.product.show');
Route::post('/product/{id}/review', [UserController::class, 'storeReview'])->name('user.product.review.store');

// Admin Auth Routes (Public)
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'loginStore'])->name('admin.login.store');

// Admin Protected Command Center Routes
Route::middleware('adminmiddleware')->group(function () {
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin', [AdminController::class, 'adminindex'])->name('admin.index');
    Route::get('/admin/users', [AdminController::class, 'allusers'])->name('admin.users.index');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/admin/reviews', [AdminController::class, 'reviewsIndex'])->name('admin.reviews.index');
    Route::delete('/admin/reviews/{id}', [AdminController::class, 'destroyReview'])->name('admin.reviews.destroy');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');

    // Admin Orders Manager
    Route::get('/admin/orders', [AdminController::class, 'ordersIndex'])->name('admin.orders.index');
    Route::put('/admin/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.update-status');

    // Admin Storefront Hero Section Cards Manager
    Route::get('/admin/hero', [AdminController::class, 'heroIndex'])->name('admin.hero.index');
    Route::post('/admin/hero', [AdminController::class, 'heroStore'])->name('admin.hero.store');
    Route::put('/admin/hero/{id}', [AdminController::class, 'heroUpdate'])->name('admin.hero.update');
    Route::delete('/admin/hero/{id}', [AdminController::class, 'heroDestroy'])->name('admin.hero.destroy');

    // Admin Category Sections Manager
    Route::get('/admin/categories', [AdminController::class, 'categoryIndex'])->name('admin.categories.index');
    Route::post('/admin/categories', [AdminController::class, 'categoryStore'])->name('admin.categories.store');
    Route::put('/admin/categories/{id}', [AdminController::class, 'categoryUpdate'])->name('admin.categories.update');
    Route::delete('/admin/categories/{id}', [AdminController::class, 'categoryDestroy'])->name('admin.categories.destroy');
    Route::post('/admin/categories/move-products', [AdminController::class, 'categoryMoveProducts'])->name('admin.categories.move-products');

    // Admin Products Manager Routes
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});