<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Catalog & Product Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog.list');
Route::get('/barang/{id}', [CatalogController::class, 'show'])->name('catalog.show');
Route::post('/barang/{id}/pesan', [CatalogController::class, 'orderViaWa'])->name('catalog.order');
Route::post('/barang/{id}/pesan-wa', [CatalogController::class, 'orderViaWa'])->name('catalog.orderWa');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| Admin Dashboard & Management Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('admin')->group(function (): void {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Manajemen Kategori
    Route::resource('kategori', KategoriController::class)->names('admin.kategori')->except(['show']);

    // Manajemen Barang & Varian
    Route::resource('barang', BarangController::class)->names('admin.barang')->except(['show']);
    Route::post('barang/{barangId}/varian', [BarangController::class, 'storeVarian'])->name('admin.barang.varian.store');
    Route::put('barang/{barangId}/varian/{varianId}', [BarangController::class, 'updateVarian'])->name('admin.barang.varian.update');
    Route::delete('barang/{barangId}/varian/{varianId}', [BarangController::class, 'destroyVarian'])->name('admin.barang.varian.destroy');

    // Manajemen Leads
    Route::get('leads', [LeadController::class, 'index'])->name('admin.leads.index');
    Route::patch('leads/{id}/status', [LeadController::class, 'updateStatus'])->name('admin.leads.updateStatus');
    Route::delete('leads/{id}', [LeadController::class, 'destroy'])->name('admin.leads.destroy');

    // Manajemen Users (Superadmin only)
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});
