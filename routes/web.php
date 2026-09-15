<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\AuthController;


// ======================================================
// AUTHENTICATION
// ======================================================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// ======================================================
// HALAMAN YANG WAJIB LOGIN
// ======================================================

Route::middleware('auth')->group(function () {

    // ==================================================
    // DASHBOARD
    // ==================================================

    Route::get('/', [DashboardController::class, 'index']);


    // ==================================================
    // PRODUK
    // ==================================================

    Route::get('/produk', [ProdukController::class, 'index']);

    Route::get('/produk/tambah', [ProdukController::class, 'create']);

    Route::post('/produk', [ProdukController::class, 'store']);

    Route::get('/produk/detail/{id}', [ProdukController::class, 'show']);

    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit']);

    Route::put('/produk/{id}', [ProdukController::class, 'update']);

    Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);


    // ==================================================
    // PENJUALAN
    // ==================================================

    Route::get('/penjualan', [PenjualanController::class, 'index'])
        ->name('penjualan.index');

    Route::get('/penjualan/tambah', [PenjualanController::class, 'create'])
        ->name('penjualan.create');

    Route::post('/penjualan', [PenjualanController::class, 'store'])
        ->name('penjualan.store');

    Route::get('/penjualan/detail/{id}', [PenjualanController::class, 'show'])
        ->name('penjualan.detail');

    Route::get('/penjualan/edit/{id}', [PenjualanController::class, 'edit'])
        ->name('penjualan.edit');

    Route::put('/penjualan/{id}', [PenjualanController::class, 'update'])
        ->name('penjualan.update');

    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])
        ->name('penjualan.destroy');


    // ==================================================
    // PRODUKSI
    // ==================================================

    Route::get('/produksi', [ProduksiController::class, 'index']);

    Route::get('/produksi/tambah', [ProduksiController::class, 'create']);

    Route::post('/produksi', [ProduksiController::class, 'store']);

    Route::get('/produksi/detail/{id}', [ProduksiController::class, 'show']);

    Route::get('/produksi/edit/{id}', [ProduksiController::class, 'edit']);

    Route::put('/produksi/{id}', [ProduksiController::class, 'update']);

    Route::delete('/produksi/{id}', [ProduksiController::class, 'destroy']);

});