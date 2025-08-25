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
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BeritaController;
use App\Models\Galeri;

// LOGIN & LOGOUT
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// HALAMAN BERANDA (menampilkan galeri juga)
Route::get('/', function () {
    $galeris = Galeri::orderBy('id', 'desc')->get();
    return view('beranda', compact('galeris'));
})->name('beranda');

// PROFIL
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

// HALAMAN ADMIN
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('infos', InfoController::class);
    Route::resource('users', UserController::class);
    Route::resource('kategoris', KategoriController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('kontak', KontakController::class);
    Route::resource('media', MediaController::class);
    Route::resource('galeri', GaleriController::class);
});

// BERITA
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');


Route::get('infos/create-agenda', [InfoController::class, 'createAgenda'])->name('infos.create-agenda');
Route::get('infos/{id}/edit-agenda', [InfoController::class, 'editAgenda'])->name('infos.edit-agenda');
