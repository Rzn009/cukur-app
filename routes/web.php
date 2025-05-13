<?php

use App\Http\Controllers\Admin\BarberController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard.admin');
    Route::resource('/barber', BarberController::class);
    Route::resource('/services', ServiceController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('/bookings', BookingController::class);
    Route::resource('/schedule', ScheduleController::class);
    Route::get('/customer', [CustomerController::class, 'index'])->name('page.customer');
    Route::put('/customer/profile', [CustomerController::class, 'profilUpdate'])->name('customer.profile.update');

    Route::post('/notifications/{id}/read', function ($id) {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return back();
    })->name('notifications.markAsRead');
});
