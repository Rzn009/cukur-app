<?php

use App\Http\Controllers\Admin\BarberController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\RiviewController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('frontend.welcome');
});

Route::get('/about', function () {
    return view('frontend.about');
});

Route::get('/contact', function () {
    return view('frontend.contact');
});

Route::get('/furniture', function () {
    return view('frontend.furniture');
});

Route::get('/blog', function () {
    return view('frontend.blog');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [DashboardAdminController::class, 'editProfileAdmin'])->name('profile.edit');
    Route::put('/profile/update', [DashboardAdminController::class, 'updateProfile'])->name('profile.update');

    // USER MANAGEMENT
    Route::middleware(['permission:manage user'])->group(function () {
        Route::resource('/users', UserManagementController::class);
    });

    // ROLE MANAGEMENT
    Route::middleware(['permission:manage role'])->group(function () {
        Route::resource('/roles', RoleController::class);
    });

    // BARBER MANAGEMENT
    Route::middleware(['permission:manage barber'])->group(function () {
        Route::resource('/barbers', BarberController::class);
    });

    // SERVICE MANAGEMENT
    Route::middleware(['permission:manage service'])->group(function () {
        Route::resource('/services', ServiceController::class);
    });

    // SCHEDULE MANAGEMENT
    Route::middleware(['permission:manage schedule'])->group(function () {
        Route::resource('/schedules', ScheduleController::class);
    });

    // BOOKING MANAGEMENT
});
// Customer Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/customer', [CustomerController::class, 'index'])->name('page.customer');
    Route::put('/customer/profile', [CustomerController::class, 'profilUpdate'])->name('customer.profile.update');

    Route::resource('/bookings', BookingController::class);

    // Customer Reviews
    Route::middleware(['checkPermissionOrSuperAdmin:create reviews'])->group(function () {
        Route::post('/reviews', [RiviewController::class, 'store'])->name('reviews.store');
    });
});

// Common Routes for Authenticated Users
Route::middleware(['auth'])->group(function () {
    Route::post('/notifications/{id}/read', function ($id) {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return back();
    })->name('notifications.markAsRead');
});
