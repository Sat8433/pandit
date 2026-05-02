<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PoojaController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PanditController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', function () {
    return view('welcome_pooja');
})->name('home');

// Pooja routes
Route::get('/poojas', [PoojaController::class, 'index'])->name('poojas.index');
Route::get('/poojas/{pooja}', [PoojaController::class, 'show'])->name('poojas.show');


// Pandit routes
Route::get('/pandits', [PanditController::class, 'index'])->name('pandits.index');
Route::get('/pandits/{pandit}', [PanditController::class, 'show'])->name('pandits.show');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User bookings
    Route::get('/my-bookings', [BookingController::class, 'userBookings'])->name('bookings.user');
    Route::get('/bookings/create/{pooja}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    
    // Pandit specific routes
    Route::middleware('pandit')->group(function () {
        Route::get('/pandit/dashboard', [DashboardController::class, 'panditDashboard'])->name('pandit.dashboard');
        Route::get('/pandit/bookings', [BookingController::class, 'panditBookings'])->name('pandit.bookings');
        Route::post('/bookings/{booking}/accept', [BookingController::class, 'accept'])->name('bookings.accept');
        Route::post('/bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
    });
    
    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/admin/poojas', [PoojaController::class, 'adminIndex'])->name('admin.poojas.index');
        Route::get('/admin/poojas/create', [PoojaController::class, 'create'])->name('admin.poojas.create');
        Route::post('/admin/poojas', [PoojaController::class, 'store'])->name('admin.poojas.store');
        Route::get('/admin/poojas/{pooja}/edit', [PoojaController::class, 'edit'])->name('admin.poojas.edit');
        Route::put('/admin/poojas/{pooja}', [PoojaController::class, 'update'])->name('admin.poojas.update');
        Route::delete('/admin/poojas/{pooja}', [PoojaController::class, 'destroy'])->name('admin.poojas.destroy');
        
        Route::get('/admin/pandits', [PanditController::class, 'adminIndex'])->name('admin.pandits.index');
        Route::post('/admin/pandits/{pandit}/verify', [PanditController::class, 'toggleVerify'])->name('admin.pandits.verify');
        Route::delete('/admin/pandits/{pandit}', [PanditController::class, 'destroy'])->name('admin.pandits.destroy');
        
        // Samagri Routes
        Route::resource('/admin/samagri', \App\Http\Controllers\SamagriController::class)->names([
            'index' => 'admin.samagri.index',
            'create' => 'admin.samagri.create',
            'store' => 'admin.samagri.store',
            'edit' => 'admin.samagri.edit',
            'update' => 'admin.samagri.update',
            'destroy' => 'admin.samagri.destroy'
        ]);
    });
});

require __DIR__.'/auth.php';
