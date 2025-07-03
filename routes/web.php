<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;

// Semua rute dibungkus dalam middleware 'web' agar session berfungsi
Route::middleware('web')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Rute untuk Pelanggan (Tampilan Utama)
    |--------------------------------------------------------------------------
    */
    Route::get('/', [CustomerController::class, 'home'])->name('home');
    Route::get('/menu', [CustomerController::class, 'menu'])->name('menu');

    // Rute untuk Keranjang Belanja
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/keranjang/hapus/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/keranjang/update/{id}', [CartController::class, 'update'])->name('cart.update');

    /*
    |--------------------------------------------------------------------------
    | Rute Bawaan Breeze (Dashboard & Profil Pengguna)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
        Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('/pesanan/buat', [CartController::class, 'placeOrder'])->name('order.place');
        Route::get('/pesanan/sukses', function () {
            return view('cart.success');
        })->name('order.success');
        
        Route::get('/riwayat-pesanan', [CustomerController::class, 'riwayatPesanan'])->name('pesanan.riwayat');
    });

    /*
    |--------------------------------------------------------------------------
    | Rute untuk Dashboard Admin
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware(['auth', 'is.admin'])->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/menu', [AdminController::class, 'indexMenu'])->name('menu.index');
        Route::get('/menu/tambah', [AdminController::class, 'createMenu'])->name('menu.create');
        Route::post('/menu/tambah', [AdminController::class, 'storeMenu'])->name('menu.store');
        Route::get('/menu/{menu}/edit', [AdminController::class, 'editMenu'])->name('menu.edit');
        Route::put('/menu/{menu}', [AdminController::class, 'updateMenu'])->name('menu.update');
        Route::delete('/menu/{menu}', [AdminController::class, 'destroyMenu'])->name('menu.destroy');
        Route::get('/pesanan', [AdminController::class, 'indexPesanan'])->name('pesanan.index');
        Route::get('/pesanan/{transaksi}', [AdminController::class, 'showPesanan'])->name('pesanan.show');
        Route::patch('/pesanan/{transaksi}/update-status', [AdminController::class, 'updateStatusPesanan'])->name('pesanan.updateStatus');
    });

});

// File ini sudah otomatis memiliki middleware 'web', jadi biarkan di luar grup.
require __DIR__.'/auth.php';