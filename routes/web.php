<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('infos', InfoController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});
Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('kategoris', KategoriController::class);
Route::resource('menu', MenuController::class);
Route::resource('kontak', App\Http\Controllers\KontakController::class);
Route::resource('media', App\Http\Controllers\MediaController::class);
Route::resource('galeri', App\Http\Controllers\GaleriController::class);
Route::resource('galeri', App\Http\Controllers\GaleriController::class);
Route::resource('media', App\Http\Controllers\MediaController::class);
Route::resource('kontak', App\Http\Controllers\KontakController::class);
Route::resource('galeri', App\Http\Controllers\GaleriController::class);
