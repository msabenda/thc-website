<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/join', [ApplicationController::class, 'store'])
    ->name('applications.store');
