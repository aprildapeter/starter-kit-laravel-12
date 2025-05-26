<?php

use App\Http\Controllers\MasterData\User\PostController as UserPostController;
use App\Http\Controllers\MasterData\User\ReadController as UserReadController;
use App\Http\Controllers\MasterData\User\ViewController as UserViewController;
use App\Http\Controllers\ProfileUser\PostController;
use App\Http\Controllers\ProfileUser\ViewController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth')->group(function () {
    //START USER
    Route::get('/user/data', [UserReadController::class, 'data'])->name('user.data');
    Route::get('/user', [UserViewController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserViewController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserPostController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserViewController::class, 'edit'])->name('user.edit');
    Route::put('/user/edit/{id}', [UserPostController::class, 'update'])->name('user.update');
    Route::patch('/user/ubah-status/{id}', [UserPostController::class, 'ubahStatus'])->name('user.ubah-status');
    Route::patch('/user/reset-password/{id}', [UserPostController::class, 'resetPassword'])->name('user.reset-password');
    
    Route::get('/profile-user/{id}', [ViewController::class, 'index'])->name('profile-user.index');
    Route::put('/profile-user/{id}', [PostController::class, 'update'])->name('profile-user.update');
    Route::put('/profile-user/ubah-password/{id}', [PostController::class, 'ubahPassword'])->name('profile-user.ubah-password');
    //END USER
});
