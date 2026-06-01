<?php

use App\Http\Controllers\ViewDataController;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [ViewDataController::class, 'showLogin'])->name('login');
Route::get('/register', [ViewDataController::class, 'showRegister']);
Route::middleware(['auth:api'])->group(function () {
    Route::get('/dashboard', [ViewDataController::class, 'showDashboard']);
});