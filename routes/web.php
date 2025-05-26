<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\ViewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Cek apakah pengguna sudah login
    if (auth()->check()) {
        return redirect()->route('dashboard.index'); // Arahkan ke dashboard jika sudah login
    }

    // Jika belum login, arahkan ke halaman login
    return app(LoginController::class)->index();
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ViewController::class, 'index'])->name('dashboard.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// MASTER DATA
require __DIR__ . '/module/master-data.php';
