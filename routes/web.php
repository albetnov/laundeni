<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cekrole:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('{user}/moduser', [AdminController::class, 'mod_curacc'])->name('modcuracc');
    });
    Route::group(['middleware' => ['cekrole:disabled'], 'prefix' => 'newuser', 'as' => 'newuser.'], function () {
        Route::view('dashboard', 'newuser.dashboard')->name('dashboard');
    });
    Route::group(['middleware' => ['cekrole:kasir'], 'prefix' => 'kasir', 'as' => 'kasir.'], function () {
        Route::view('dashboard', 'kasir.dashboard')->name('dashboard');
    });
    Route::group(['middleware' => ['cekrole:owner'], 'prefix' => 'owner', 'as' => 'owner.'], function () {
        Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    });
});

require __DIR__ . '/auth.php';
