<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\ApplicationController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::post('/join', [ApplicationController::class, 'store'])
    ->name('applications.store');

// Admin routes
Route::prefix('admin')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');

    // Admin protected routes
    Route::middleware(['auth','is_admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/applications', [AdminApplicationController::class, 'index'])->name('admin.applications');
        Route::post('/applications/{application}/approve', [AdminApplicationController::class, 'approve'])->name('admin.applications.approve');
        Route::post('/applications/{application}/reject', [AdminApplicationController::class, 'reject'])->name('admin.applications.reject');
        Route::get('/applications/{application}/edit', [AdminApplicationController::class, 'edit'])->name('admin.applications.edit');
        Route::put('/applications/{application}', [AdminApplicationController::class, 'update'])->name('admin.applications.update');
        Route::delete('/applications/{application}', [AdminApplicationController::class, 'destroy'])->name('admin.applications.destroy');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    });

});


