<?php

use Illuminate\Support\Facades\Auth;
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
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Auth::routes();
Route::group(['prefix' => '/home'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('role:owner,kasir');
    Route::get('/owner', [App\Http\Controllers\HomeController::class, 'home_owner'])->name('home_owner')->middleware('owner');
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'home_admin'])->name('home_admin')->middleware('admin');
    Route::get('/kasir', [App\Http\Controllers\HomeController::class, 'home_kasir'])->name('home_kasir')->middleware('kasir');
    Route::get('/barang', [App\Http\Controllers\HomeController::class, 'master_barang'])->name('barang')->middleware('owner');
    Route::get('/customer', [App\Http\Controllers\HomeController::class, 'master_customer'])->name('customer')->middleware('owner');
    Route::get('/supplier', [App\Http\Controllers\HomeController::class, 'master_supplier'])->name('supplier')->middleware('owner');
    Route::get('/user', [App\Http\Controllers\HomeController::class, 'master_user'])->name('user')->middleware('owner');
    Route::get('/promo', [App\Http\Controllers\HomeController::class, 'master_promo'])->name('promo')->middleware('owner');
    Route::get('/merk', [App\Http\Controllers\HomeController::class, 'master_merk'])->name('merk')->middleware('owner');
    Route::get('/tipe', [App\Http\Controllers\HomeController::class, 'master_tipe'])->name('tipe')->middleware('owner');
    Route::get('/jasa', [App\Http\Controllers\HomeController::class, 'master_jasa'])->name('jasa')->middleware('owner');
    Route::get('/pegawai', [App\Http\Controllers\HomeController::class, 'master_pegawai'])->name('pegawai')->middleware('owner');
    Route::get('/satuan', [App\Http\Controllers\HomeController::class, 'master_satuan'])->name('satuan')->middleware('owner');
});


