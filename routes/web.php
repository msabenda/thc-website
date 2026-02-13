<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\ApplicationController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/join', [ApplicationController::class, 'store'])
    ->name('applications.store');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    /*
    |-------------------------
    | Admin Authentication
    |-------------------------
    */

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');


    /*
    |-------------------------
    | Protected Admin Routes
    |-------------------------
    */

    Route::middleware(['auth', 'is_admin'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Applications Listing
        Route::get('/applications', [AdminApplicationController::class, 'index'])
            ->name('applications.index');

        // Edit Application
        Route::get('/applications/{application}/edit', [AdminApplicationController::class, 'edit'])
            ->name('applications.edit');

        // Update Application
        Route::put('/applications/{application}', [AdminApplicationController::class, 'update'])
            ->name('applications.update');

        // Delete Application
        Route::delete('/applications/{application}', [AdminApplicationController::class, 'destroy'])
            ->name('applications.destroy');

        // Approve
        Route::post('/applications/{application}/approve', [AdminApplicationController::class, 'approve'])
            ->name('applications.approve');

        // Reject
        Route::post('/applications/{application}/reject', [AdminApplicationController::class, 'reject'])
            ->name('applications.reject');

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');
    });
});
