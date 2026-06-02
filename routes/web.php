<?php

use App\Http\Controllers\ViewDataController;
use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [ViewDataController::class, 'showLogin'])->name('login');
Route::get('/register', [ViewDataController::class, 'showRegister']);
Route::middleware(['auth:api'])->group(function () {
    Route::get('/dashboard', [ViewDataController::class, 'showDashboard']);
    
    // Fitur umum
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');

    // Fitur khusus ADMIN (Disposisi/Update Status)
    Route::middleware(['is_admin'])->group(function () {
        Route::put('/complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');
        Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])->name('complaints.destroy');
    });
});