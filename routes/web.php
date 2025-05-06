<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard.admin');
});