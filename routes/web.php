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
    // Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('role:owner,kasir');
    Route::get('/owner', [App\Http\Controllers\HomeController::class, 'home_owner'])->name('home_owner')->middleware('role:owner');
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'home_admin'])->name('home_admin')->middleware('role:admin');
    Route::get('/kasir', [App\Http\Controllers\HomeController::class, 'home_kasir'])->name('home_kasir')->middleware('role:kasir');
    Route::get('/barang', [App\Http\Controllers\HomeController::class, 'master_barang'])->name('barang')->middleware('admin');
    Route::get('/customer', [App\Http\Controllers\HomeController::class, 'master_customer'])->name('customer')->middleware('owner');
    Route::get('/supplier', [App\Http\Controllers\HomeController::class, 'master_supplier'])->name('supplier')->middleware('owner');
    Route::get('/user', [App\Http\Controllers\HomeController::class, 'master_user'])->name('user')->middleware('owner');
    Route::get('/promo', [App\Http\Controllers\HomeController::class, 'master_promo'])->name('promo');
    Route::get('/merk', [App\Http\Controllers\HomeController::class, 'master_merk'])->name('merk')->middleware('owner');
    Route::get('/tipe', [App\Http\Controllers\HomeController::class, 'master_tipe'])->name('tipe')->middleware('owner');
    Route::get('/jasa', [App\Http\Controllers\HomeController::class, 'master_jasa'])->name('jasa')->middleware('owner');
    Route::get('/pegawai', [App\Http\Controllers\HomeController::class, 'master_pegawai'])->name('pegawai')->middleware('owner');
    Route::get('/satuan', [App\Http\Controllers\HomeController::class, 'master_satuan'])->name('satuan')->middleware('owner');
    Route::get('/master', [App\Http\Controllers\HomeController::class, 'archive_master'])->name('master');
    Route::get('/transaksi', [App\Http\Controllers\HomeController::class, 'archive_trans'])->name('transaksi');
    Route::get('/laporan', [App\Http\Controllers\HomeController::class, 'archive_laporan'])->name('laporan');
    Route::get('/beli', [App\Http\Controllers\HomeController::class, 'transaksi_beli'])->name('pembelian');
    Route::get('/tambah-beli', [App\Http\Controllers\HomeController::class, 'tambah_beli'])->name('tambah-beli');
    Route::get('/jual', [App\Http\Controllers\HomeController::class, 'transaksi_jual'])->name('penjualan');
    Route::get('/tambah-jual', [App\Http\Controllers\HomeController::class, 'tambah_jual'])->name('tambah-jual');
    Route::get('/hutang', [App\Http\Controllers\HomeController::class, 'master_hutang'])->name('master_hutang');
    Route::get('/bayar-hutang', [App\Http\Controllers\HomeController::class, 'bayar_hutang'])->name('bayar_hutang');
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


Route::group(['prefix' => '/kota'], function () {
    // Route::post('/store', [App\Http\Controllers\HomeController::class, 'master_kota_store'])->name('kota.store');
    Route::post('/data', [App\Http\Controllers\HomeController::class, 'master_kota_data'])->name('kota.data');
    // Route::get('/create', [App\Http\Controllers\HomeController::class, 'master_kota_create'])->name('kota.create');
    // Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'master_kota_edit'])->name('kota.edit');
    // Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'master_kota_update'])->name('kota.update');
    // Route::delete('/delete', [App\Http\Controllers\HomeController::class, 'master_kota_delete'])->name('kota.delete');
});

Route::group(['prefix' => '/user'], function () {
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'master_user_store'])->name('user.store');
    Route::post('/data', [App\Http\Controllers\HomeController::class, 'master_user_data'])->name('user.data');
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'master_user_create'])->name('user.create');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'master_user_edit'])->name('user.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'master_user_update'])->name('user.update');
    Route::delete('/delete', [App\Http\Controllers\HomeController::class, 'master_user_delete'])->name('user.delete');
});



Route::group(['prefix' => '/merek'], function () {
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'master_merek_store'])->name('merek.store');
    Route::post('/data', [App\Http\Controllers\HomeController::class, 'master_merek_data'])->name('merek.data');
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'master_merek_create'])->name('merek.create');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'master_merek_edit'])->name('merek.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'master_merek_update'])->name('merek.update');
    Route::delete('/delete', [App\Http\Controllers\HomeController::class, 'master_merek_delete'])->name('merek.delete');
});

Route::group(['prefix' => '/satuan'], function () {
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'master_satuan_store'])->name('satuan.store');
    Route::post('/data', [App\Http\Controllers\HomeController::class, 'master_satuan_data'])->name('satuan.data');
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'master_satuan_create'])->name('satuan.create');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'master_satuan_edit'])->name('satuan.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'master_satuan_update'])->name('satuan.update');
    Route::delete('/delete', [App\Http\Controllers\HomeController::class, 'master_satuan_delete'])->name('satuan.delete');
});

Route::group(['prefix' => '/tipe'], function () {
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'master_tipe_store'])->name('tipe.store');
    Route::post('/data', [App\Http\Controllers\HomeController::class, 'master_tipe_data'])->name('tipe.data');
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'master_tipe_create'])->name('tipe.create');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'master_tipe_edit'])->name('tipe.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'master_tipe_update'])->name('tipe.update');
    Route::delete('/delete', [App\Http\Controllers\HomeController::class, 'master_tipe_delete'])->name('tipe.delete');
});

Route::group(['prefix' => '/jasa'], function () {
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'master_jasa_store'])->name('jasa.store');
    Route::post('/data', [App\Http\Controllers\HomeController::class, 'master_jasa_data'])->name('jasa.data');
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'master_jasa_create'])->name('jasa.create');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'master_jasa_edit'])->name('jasa.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'master_jasa_update'])->name('jasa.update');
    Route::delete('/delete', [App\Http\Controllers\HomeController::class, 'master_jasa_delete'])->name('jasa.delete');
});

Route::group(['prefix' => '/supplier'], function () {
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'master_supplier_store'])->name('supplier.store');
    Route::post('/data', [App\Http\Controllers\HomeController::class, 'master_supplier_data'])->name('supplier.data');
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'master_supplier_create'])->name('supplier.create');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'master_supplier_edit'])->name('supplier.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'master_supplier_update'])->name('supplier.update');
    Route::delete('/delete', [App\Http\Controllers\HomeController::class, 'master_supplier_delete'])->name('supplier.delete');
});

Route::group(['prefix' => '/pegawai'], function () {
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'master_pegawai_store'])->name('pegawai.store');
    Route::post('/data', [App\Http\Controllers\HomeController::class, 'master_pegawai_data'])->name('pegawai.data');
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'master_pegawai_create'])->name('pegawai.create');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'master_pegawai_edit'])->name('pegawai.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'master_pegawai_update'])->name('pegawai.update');
    Route::delete('/delete', [App\Http\Controllers\HomeController::class, 'master_pegawai_delete'])->name('pegawai.delete');
});


Route::group(['prefix' => '/promo'], function () {
    Route::post('/data', [App\Http\Controllers\HomeController::class, 'promo_data'])->name('promo.data');
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'promo_create'])->name('promo.create');
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'promo_store'])->name('promo.store');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'promo_edit'])->name('promo.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'promo_update'])->name('promo.update');
    Route::delete('/delete', [App\Http\Controllers\HomeController::class, 'promo_delete'])->name('promo.delete');
});
