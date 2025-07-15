<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\GaleriController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/',function () {
    return view('beranda');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard',function () {
        return  view('admin.dashboard');
    })->name('dashboard');

    Route::resource('infos', InfoController::class);
    Route::resource('users', UserController::class);
    Route::resource('kategoris', KategoriController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('kontak', KontakController::class);
    Route::resource('media', MediaController::class);
    Route::resource('galeri', GaleriController::class);
});
