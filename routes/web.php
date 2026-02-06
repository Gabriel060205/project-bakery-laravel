<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\TableController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// --- GROUP ADMIN ---
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Manajemen Meja
    Route::resource('/admin/tables', TableController::class)->only(['index', 'store', 'destroy']);

    // Manajemen Voucher
    Route::resource('/admin/vouchers', VoucherController::class)->only(['index', 'store', 'destroy']);

    // Manajemen Menu (CRUD)
    Route::resource('/admin/menus', MenuController::class);

    // Manajemen Staff (Karyawan)
    Route::resource('/admin/users', UserController::class);
});

// --- GROUP CHEF ---
Route::middleware(['auth', 'role:chief'])->group(function () {
    // Dashboard Chef
    Route::get('/chief/dashboard', [ChefController::class, 'index'])->name('chief.dashboard');
    
    // History Chef
    Route::get('/chief/history', [ChefController::class, 'history'])->name('chief.history');

    // Update Status Pesanan
    Route::post('/chief/order/{id}/update', [ChefController::class, 'updateStatus'])->name('chief.update');
});

// --- GROUP CASHIER ---
Route::middleware(['auth', 'role:cashier'])->group(function () {
    // Dashboard Kasir
    Route::get('/cashier/dashboard', [CashierController::class, 'index'])->name('cashier.dashboard');

    // History Kasir
    Route::get('/cashier/history', [CashierController::class, 'history'])->name('cashier.history');

    // Konfirmasi Pembayaran
    Route::post('/cashier/order/{id}/confirm', [CashierController::class, 'confirmPayment'])->name('cashier.confirm');
});

// --- RUTE CUSTOMER (TANPA LOGIN) ---

// 1. Scan Meja (Pintu Masuk)
Route::get('/meja/{no_meja}', [OrderController::class, 'index'])->name('order.index');

// 2. Simpan Nama & Masuk Menu
Route::post('/order/start', [OrderController::class, 'startOrder'])->name('order.start');

// 3. Halaman Pilih Menu
Route::get('/menu', [OrderController::class, 'showMenu'])->name('order.menu');

// 4. Checkout
Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

// 5. Sukses
Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');