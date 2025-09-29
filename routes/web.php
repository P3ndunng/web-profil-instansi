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
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\CkeditorUploadController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SliderController;

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
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

// Publik Berita
Route::get('/berita', [InfoController::class, 'beritaPublik'])->name('infoP.berita');
Route::get('/berita/{id}', [InfoController::class, 'detailBerita'])->name('infoP.berita.detail');

// Publik Pengumuman
Route::get('/pengumuman', [InfoController::class, 'pengumumanPublik'])->name('infoP.pengumuman');
Route::get('/pengumuman/{id}', [InfoController::class, 'detailPengumuman'])->name('infoP.pengumuman.detail');

// Publik Artikel - MENGGUNAKAN ArtikelController
Route::get('/artikel', [ArtikelController::class, 'artikelPublik'])->name('infoP.artikel');
Route::get('/artikel/{id}', [ArtikelController::class, 'detail'])->name('infoP.artikel-detail');

// Publik Agenda (redirect ke Google Calendar)
Route::get('/agenda', function () {
    return redirect()->away('https://calendar.google.com/calendar/u/0/r?cid=bbptuhptbaturraden@gmail.com&pli=1');
})->name('infoP.agenda');

/*
|--------------------------------------------------------------------------
| API PUBLIK (untuk frontend)
|--------------------------------------------------------------------------
*/
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/menus', [MenuController::class, 'getMenusForNavbar'])->name('menus');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->as('admin.')->group(function () {

    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    // === MASTER DATA ===
    Route::resource('users', UserController::class);
    Route::resource('kategoris', KategoriController::class);

    // Menu dengan fitur tambahan
    Route::resource('menu', MenuController::class);
    Route::patch('menu/{id}/toggle', [MenuController::class, 'toggleStatus'])->name('menu.toggle');
    Route::post('menu/reorder', [MenuController::class, 'reorder'])->name('menu.reorder');
    Route::post('menu/{id}/duplicate', [MenuController::class, 'duplicate'])->name('menu.duplicate');

    Route::resource('kontak', KontakController::class);
    Route::resource('media', MediaController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('sliders', SliderController::class);

    // ===== MANAGEMEN INFORMASI =====
    Route::get('/manajemen-informasi', fn() => view('infos.index'))->name('manajemen.index');

    // === BERITA ===
    Route::get('/berita', [InfoController::class, 'indexBerita'])->name('berita.index');
    Route::get('/berita/create', [InfoController::class, 'createBerita'])->name('berita.create');
    Route::post('/berita', [InfoController::class, 'storeBerita'])->name('berita.store');
    Route::get('/berita/{id}/edit', [InfoController::class, 'editBerita'])->name('berita.edit');
    Route::put('/berita/{id}', [InfoController::class, 'updateBerita'])->name('berita.update');
    Route::delete('/berita/{id}', [InfoController::class, 'destroyBerita'])->name('berita.destroy');

    // === PENGUMUMAN ===
    Route::get('/pengumuman', [InfoController::class, 'indexPengumuman'])->name('pengumuman.index');
    Route::get('/pengumuman/create', [InfoController::class, 'createPengumuman'])->name('pengumuman.create');
    Route::post('/pengumuman', [InfoController::class, 'storePengumuman'])->name('pengumuman.store');
    Route::get('/pengumuman/{id}/edit', [InfoController::class, 'editPengumuman'])->name('pengumuman.edit');
    Route::put('/pengumuman/{id}', [InfoController::class, 'updatePengumuman'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [InfoController::class, 'destroyPengumuman'])->name('pengumuman.destroy');

    // === ARTIKEL - MENGGUNAKAN ArtikelController ===
    Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('/artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
    Route::post('/artikel', [ArtikelController::class, 'store'])->name('artikel.store');
    Route::get('/artikel/{id}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/{id}', [ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/{id}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');

    // === AGENDA ===
    Route::get('/agenda', [InfoController::class, 'indexAgenda'])->name('agenda.index');
    Route::get('/agenda/create', [InfoController::class, 'createAgenda'])->name('agenda.create');
    Route::post('/agenda', [InfoController::class, 'storeAgenda'])->name('agenda.store');
    Route::get('/agenda/{id}/edit', [InfoController::class, 'editAgenda'])->name('agenda.edit');
    Route::put('/agenda/{id}', [InfoController::class, 'updateAgenda'])->name('agenda.update');
    Route::delete('/agenda/{id}', [InfoController::class, 'destroyAgenda'])->name('agenda.destroy');

    // === CKEDITOR IMAGE UPLOAD ===
    Route::post('/ckeditor/upload', [CkeditorUploadController::class, 'upload'])->name('ckeditor.upload');
});
