<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;

Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'store']);

});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('item', ItemController::class)
        ->except(['show']);

    Route::resource('customer', CustomerController::class)
        ->except(['show']);

    Route::resource('invoice', InvoiceController::class)
        ->except(['show']);
});
