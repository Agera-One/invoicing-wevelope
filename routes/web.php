<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'store']);

});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome');
    });

    // Route::get('/members', [MemberController::class, 'index']);
    // Route::post('/members', [MemberController::class, 'store'])->name('members.store');
    // Route::put('/members/{id}', [MemberController::class, 'update'])->name('members.update');
    // Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
});
