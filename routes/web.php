<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public/Client
Route::get('/adoptions', [AdoptionController::class, 'index'])->name('adoptions.index');
Route::get('/adoptions/{guineaPig}', [AdoptionController::class, 'show'])->name('adoptions.show');

Route::get('/hotel', [HotelController::class, 'index'])->name('hotel.index');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

// Protected
Route::middleware('auth')->group(function () {
    Route::post('/adoptions/{guineaPig}/apply', [AdoptionController::class, 'store'])->name('adoptions.store');
    Route::get('/hotel/book', [HotelController::class, 'create'])->name('hotel.create');
    Route::post('/hotel/book', [HotelController::class, 'store'])->name('hotel.store');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Employee/Admin
Route::middleware(['auth', 'role:employee,admin'])->group(function () {
    Route::get('/admin/adoptions', [AdoptionController::class, 'adminIndex'])->name('admin.adoptions.index');
    Route::post('/admin/adoptions/{adoption}/status', [AdoptionController::class, 'updateStatus'])->name('admin.adoptions.updateStatus');
});
