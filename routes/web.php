<?php

use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureNotBlocked;
use App\Http\Middleware\SuperAdmin;
use Illuminate\Support\Facades\Route;

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']); // alias lama, biar link/bookmark lama tetap jalan

// Profil & Program Keahlian 
Route::get('/profil/tentang', [ProfileController::class, 'tentang'])->name('profile.tentang');
Route::get('/profil/program-keahlian', [ProfileController::class, 'program'])->name('profile.program');

// Fasilitas & Prestasi
Route::redirect('/profil/fasilitas', '/profil/tentang')->name('profile.fasilitas');
Route::redirect('/profil/prestasi', '/berita')->name('profile.prestasi');
Route::redirect('/profil', '/profil/tentang');

// Produk siswa 
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');

// Berita & Pengumuman
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');

// Galeri & Like 
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');
Route::post('/galeri/{photo}/like', [GalleryController::class, 'toggleLike'])
    ->middleware('throttle:30,1')
    ->name('gallery.like');

// PPDB
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb.index');

// Kontak
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

// Guest Routes (Login & Register Admin)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store']);
});

Route::middleware(['guest', 'throttle:5,1'])->group(function () {
    Route::get('/daftar-admin', [AdminRegisterController::class, 'create'])->name('register.admin');
    Route::post('/daftar-admin', [AdminRegisterController::class, 'store'])->name('register.admin.store');
});

Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

// Grup Dashboard dengan Middleware Auth & EnsureNotBlocked
Route::middleware(['auth', EnsureNotBlocked::class])->group(function () {
    
    // Halaman Utama Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Panel Kelola Data Admin 
    Route::prefix('dashboard')->name('admin.')->group(function () {
        Route::resource('berita', AdminNewsController::class)->parameters(['berita' => 'article'])->names('news');
        Route::resource('galeri', AdminGalleryController::class)->parameters(['galeri' => 'photo'])->names('gallery');
        Route::resource('produk', AdminProductController::class)->parameters(['produk' => 'product'])->names('products');
        Route::get('pesan', [AdminMessageController::class, 'index'])->name('messages.index');
        Route::get('pesan/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
        Route::delete('pesan/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

        // Rute Khusus Kelola Admin (SuperAdmin saja)
        Route::middleware(SuperAdmin::class)->group(function () {
        Route::get('admin', [AdminUserController::class, 'index'])->name('admins.index');
        Route::get('admin/arsip', [AdminUserController::class, 'archived'])->name('admins.archived'); // Rute Arsip
        Route::post('admin', [AdminUserController::class, 'store'])->name('admins.store');
        Route::patch('admin/{user}/blokir', [AdminUserController::class, 'toggleBlock'])->name('admins.toggle');
        Route::delete('admin/{user}', [AdminUserController::class, 'destroy'])->name('admins.destroy'); // Rute Hapus
      });
    });
});