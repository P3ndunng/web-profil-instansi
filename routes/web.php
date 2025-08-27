<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ProfilController;
use App\Models\Galeri;
use App\Http\Controllers\CkeditorUploadController;

/*
|--------------------------------------------------------------------------
| LOGIN & LOGOUT
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/
// Beranda - menggunakan BerandaController
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Profil publik
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

// BERITA PUBLIK
Route::get('/berita', [InfoController::class, 'beritaPublik'])->name('infoP.berita');
// Bisa ditambahkan artikel/pengumuman/agenda publik jika perlu

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
| Semua route admin menggunakan prefix 'admin' dan nama route 'admin.*'
*/
Route::middleware(['auth'])->prefix('admin')->as('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Resource controller lain
    Route::resource('users', UserController::class);
    Route::resource('kategoris', KategoriController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('kontak', KontakController::class);
    Route::resource('media', MediaController::class)->parameters([
    'media' => 'media']);
    Route::resource('galeri', GaleriController::class);

    // ===== MANAGEMEN INFORMASI =====
    Route::get('/manajemen-informasi', function () {
        return view('infos.index');
    })->name('manajemen.index');

    // Berita
    Route::get('/berita', [InfoController::class, 'indexBerita'])->name('berita.index');
    Route::get('/berita/create', [InfoController::class, 'createBerita'])->name('berita.create');
    Route::post('/berita', [InfoController::class, 'storeBerita'])->name('berita.store');
    Route::get('/berita/{id}/edit', [InfoController::class, 'editBerita'])->name('berita.edit');
    Route::put('/berita/{id}', [InfoController::class, 'updateBerita'])->name('berita.update');
    Route::delete('/berita/{id}', [InfoController::class, 'destroyBerita'])->name('berita.destroy');

    // Pengumuman
    Route::get('/pengumuman', [InfoController::class, 'indexPengumuman'])->name('pengumuman.index');
    Route::get('/pengumuman/create', [InfoController::class, 'createPengumuman'])->name('pengumuman.create');
    Route::post('/pengumuman', [InfoController::class, 'storePengumuman'])->name('pengumuman.store');
    Route::get('/pengumuman/{id}/edit', [InfoController::class, 'editPengumuman'])->name('pengumuman.edit');
    Route::put('/pengumuman/{id}', [InfoController::class, 'updatePengumuman'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [InfoController::class, 'destroyPengumuman'])->name('pengumuman.destroy');

    // Artikel
    Route::get('/artikel', [InfoController::class, 'indexArtikel'])->name('artikel.index');
    Route::get('/artikel/create', [InfoController::class, 'createArtikel'])->name('artikel.create');
    Route::post('/artikel', [InfoController::class, 'storeArtikel'])->name('artikel.store');
    Route::get('/artikel/{id}/edit', [InfoController::class, 'editArtikel'])->name('artikel.edit');
    Route::put('/artikel/{id}', [InfoController::class, 'updateArtikel'])->name('artikel.update');
    Route::delete('/artikel/{id}', [InfoController::class, 'destroyArtikel'])->name('artikel.destroy');

    // Agenda
    Route::get('/agenda', [InfoController::class, 'indexAgenda'])->name('agenda.index');
    Route::get('/agenda/create', [InfoController::class, 'createAgenda'])->name('agenda.create');
    Route::post('/agenda', [InfoController::class, 'storeAgenda'])->name('agenda.store');
    Route::get('/agenda/{id}/edit', [InfoController::class, 'editAgenda'])->name('agenda.edit');
    Route::put('/agenda/{id}', [InfoController::class, 'updateAgenda'])->name('agenda.update');
    Route::delete('/agenda/{id}', [InfoController::class, 'destroyAgenda'])->name('agenda.destroy');
});

Route::post('/ckeditor/upload', [CkeditorUploadController::class, 'upload'])->name('ckeditor.upload');
