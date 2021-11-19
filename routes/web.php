<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Modules\LaporanController;
use App\Http\Controllers\Modules\ManageCurrentUser;
use App\Http\Controllers\Modules\OutletController;
use App\Http\Controllers\Modules\PaketController;
use App\Http\Controllers\Modules\Pelanggan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Modules\Pengguna;
use App\Http\Controllers\Modules\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';


Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cekrole:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('{user}/moduser', [ManageCurrentUser::class, 'mod_curacc'])->name('modcuracc');
        Route::get('pengguna', [AdminController::class, 'pengguna'])->name('pengguna');
        Route::resource('pengguna', Pengguna::class)->except('index', 'show')->parameter('pengguna', 'user');
        Route::post('pengguna/{user}/role', [Pengguna::class, 'assign_role'])->name('pengguna.assign.role');
        Route::resource('pelanggan', Pelanggan::class)->except('show')->parameter('pelanggan', 'member');
        Route::get('outlet', [AdminController::class, 'outlet'])->name('outlet');
        Route::resource('outlet', OutletController::class)->except('show', 'index');
        Route::get('paket', [AdminController::class, 'paket'])->name('paket');
        Route::resource('paket', PaketController::class)->except('index', 'show');
        Route::post('transaksi/{transaksi}/paid', [TransaksiController::class, 'paid'])->name('transaksi.paid');
        Route::post('transaksi/{transaksi}/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.selesai');
        Route::resource('transaksi', TransaksiController::class);
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
    });
    Route::group(['middleware' => ['cekrole:disabled'], 'prefix' => 'newuser', 'as' => 'newuser.'], function () {
        Route::view('dashboard', 'newuser.dashboard')->name('dashboard');
    });
    Route::group(['middleware' => ['cekrole:kasir'], 'prefix' => 'kasir', 'as' => 'kasir.'], function () {
        Route::view('dashboard', 'kasir.dashboard')->name('dashboard');
        Route::post('{user}/moduser', [ManageCurrentUser::class, 'mod_curacc'])->name('modcuracc');
        Route::resource('pelanggan', Pelanggan::class)->except('show')->parameter('pelanggan', 'member');
        Route::post('transaksi/{transaksi}/paid', [TransaksiController::class, 'paid'])->name('transaksi.paid');
        Route::post('transaksi/{transaksi}/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.selesai');
        Route::resource('transaksi', TransaksiController::class);
    });
    Route::group(['middleware' => ['cekrole:owner'], 'prefix' => 'owner', 'as' => 'owner.'], function () {
        Route::view('dashboard', 'owner.dashboard')->name('dashboard');
        Route::post('{user}/moduser', [ManageCurrentUser::class, 'mod_curacc'])->name('modcuracc');
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
    });
});
