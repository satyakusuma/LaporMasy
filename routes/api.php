<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Rute yang bisa diakses tanpa login
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Rute yang wajib login (Proteksi menggunakan auth middleware)
Route::middleware('auth:web')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});