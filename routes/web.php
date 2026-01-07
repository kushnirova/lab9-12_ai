<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\GuineaPigController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\HotelBookingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public/Client
Route::get('/adoptions', [AdoptionController::class, 'index'])->name('adoptions.index');
Route::get('/adoptions/{guineaPig}', [AdoptionController::class, 'show'])->name('adoptions.show');

Route::get('/hotel', [HotelController::class, 'index'])->name('hotel.index');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

// Protected - Client Access
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::post('/adoptions/{guineaPig}/apply', [AdoptionController::class, 'store'])->name('adoptions.store');
    Route::get('/hotel/book', [HotelController::class, 'create'])->name('hotel.create');
    Route::post('/hotel/book', [HotelController::class, 'store'])->name('hotel.store');
    
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

// Protected - Shared Dashboard (All authenticated users can see dashboard)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Employee - Content Management
Route::middleware(['auth', 'role:employee'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/adoptions', [AdoptionController::class, 'adminIndex'])->name('adoptions.index');
    Route::post('/adoptions/{adoption}/status', [AdoptionController::class, 'updateStatus'])->name('adoptions.updateStatus');

    Route::resource('guinea_pigs', GuineaPigController::class);
    Route::resource('products', ProductController::class);
    
    // Hotel Bookings Management
    Route::get('/hotel-bookings', [HotelBookingController::class, 'index'])->name('hotel_bookings.index');
    Route::post('/hotel-bookings/{hotelBooking}/status', [HotelBookingController::class, 'updateStatus'])->name('hotel_bookings.updateStatus');
});

// Admin - User Management
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
});
