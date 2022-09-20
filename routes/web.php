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
    Route::get('/barang', [App\Http\Controllers\HomeController::class, 'master_barang'])->name('barang')->middleware('admin');
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

Route::group(['prefix' => '/customer'], function () {
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'customer_create'])->name('customer.create');
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'customer_store'])->name('customer.store');
    Route::post('/data/{id}', [App\Http\Controllers\HomeController::class, 'customer_data'])->name('customer.data');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'customer_edit'])->name('customer.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'customer_update'])->name('customer.update');
    Route::delete('/delete', [App\Http\Controllers\HomeController::class, 'customer_delete'])->name('customer.delete');
});

Route::group(['prefix' => '/barang'], function () {
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'master_barang_store'])->name('barang.store');
    Route::post('/data/{id}', [App\Http\Controllers\HomeController::class, 'master_barang_data'])->name('barang.data');
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'master_barang_create'])->name('barang.create');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'master_barang_edit'])->name('barang.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'master_barang_update'])->name('barang.update');
    Route::delete('/delete', [App\Http\Controllers\HomeController::class, 'master_barang_delete'])->name('barang.delete');
});

Route::get('/kota', [App\Http\Controllers\MasterController::class, 'data_kota'])->name('data.kota');
Route::get('/merek', [App\Http\Controllers\MasterController::class, 'data_merek'])->name('data.merek');
Route::get('/satuan', [App\Http\Controllers\MasterController::class, 'data_satuan'])->name('data.satuan');
Route::get('/tipe', [App\Http\Controllers\MasterController::class, 'data_tipe'])->name('data.tipe');
Route::get('/jasa', [App\Http\Controllers\MasterController::class, 'data_jasa'])->name('data.jasa');
Route::get('/supplier', [App\Http\Controllers\MasterController::class, 'data_supplier'])->name('data.supplier');
// Route::get('/customer', [App\Http\Controllers\MasterController::class, 'data_customer'])->name('data.customer');


