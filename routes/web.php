<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;

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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Rute untuk Dashboard Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Rute untuk Kelola Menu
    Route::get('/menu', [AdminController::class, 'indexMenu'])->name('menu.index');
    Route::get('/menu/tambah', [AdminController::class, 'createMenu'])->name('menu.create');
    Route::post('/menu/tambah', [AdminController::class, 'storeMenu'])->name('menu.store');
    Route::get('/menu/{menu}/edit', [AdminController::class, 'editMenu'])->name('menu.edit');
    Route::put('/menu/{menu}', [AdminController::class, 'updateMenu'])->name('menu.update');
    Route::delete('/menu/{menu}', [AdminController::class, 'destroyMenu'])->name('menu.destroy');
});


// Ini memuat semua rute untuk proses login, registrasi, dll. JANGAN DIHAPUS.
require __DIR__.'/auth.php';