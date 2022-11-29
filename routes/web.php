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
});

Route::group(['prefix' => '/master'], function () {
    Route::get('/', [App\Http\Controllers\MasterController::class, 'archive_master'])->name('master');

    Route::group(['prefix' => '/customer'], function () {
        Route::get('/', [App\Http\Controllers\MasterController::class, 'master_customer'])->name('customer');
        Route::get('/create', [App\Http\Controllers\MasterController::class, 'customer_create'])->name('customer.create');
        Route::post('/store', [App\Http\Controllers\MasterController::class, 'customer_store'])->name('customer.store');
        Route::post('/data/{id}', [App\Http\Controllers\MasterController::class, 'customer_data'])->name('customer.data');
        Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'customer_edit'])->name('customer.edit');
        Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'customer_update'])->name('customer.update');
        Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'customer_delete'])->name('customer.delete');
    });

    Route::group(['prefix' => '/jasa'], function () {
        Route::get('/', [App\Http\Controllers\MasterController::class, 'master_jasa'])->name('jasa');
        Route::post('/store', [App\Http\Controllers\MasterController::class, 'master_jasa_store'])->name('jasa.store');
        Route::post('/data', [App\Http\Controllers\MasterController::class, 'master_jasa_data'])->name('jasa.data');
        Route::get('/create', [App\Http\Controllers\MasterController::class, 'master_jasa_create'])->name('jasa.create');
        Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'master_jasa_edit'])->name('jasa.edit');
        Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'master_jasa_update'])->name('jasa.update');
        Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'master_jasa_delete'])->name('jasa.delete');
    });


    Route::group(['prefix' => '/merek'], function () {
        Route::get('/', [App\Http\Controllers\MasterController::class, 'master_merk'])->name('merk');
        Route::post('/store', [App\Http\Controllers\MasterController::class, 'master_merek_store'])->name('merek.store');
        Route::post('/data', [App\Http\Controllers\MasterController::class, 'master_merek_data'])->name('merek.data');
        Route::get('/create', [App\Http\Controllers\MasterController::class, 'master_merek_create'])->name('merek.create');
        Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'master_merek_edit'])->name('merek.edit');
        Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'master_merek_update'])->name('merek.update');
        Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'master_merek_delete'])->name('merek.delete');
    });

    Route::group(['prefix' => '/pegawai'], function () {
        Route::get('/', [App\Http\Controllers\MasterController::class, 'master_pegawai'])->name('pegawai');
        Route::post('/store', [App\Http\Controllers\MasterController::class, 'master_pegawai_store'])->name('pegawai.store');
        Route::post('/data', [App\Http\Controllers\MasterController::class, 'master_pegawai_data'])->name('pegawai.data');
        Route::get('/create', [App\Http\Controllers\MasterController::class, 'master_pegawai_create'])->name('pegawai.create');
        Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'master_pegawai_edit'])->name('pegawai.edit');
        Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'master_pegawai_update'])->name('pegawai.update');
        Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'master_pegawai_delete'])->name('pegawai.delete');
    });


    Route::group(['prefix' => '/kota'], function () {
        // Route::post('/store', [App\Http\Controllers\MasterController::class, 'master_kota_store'])->name('kota.store');
        Route::post('/data', [App\Http\Controllers\MasterController::class, 'master_kota_data'])->name('kota.data');
        // Route::get('/create', [App\Http\Controllers\MasterController::class, 'master_kota_create'])->name('kota.create');
        // Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'master_kota_edit'])->name('kota.edit');
        // Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'master_kota_update'])->name('kota.update');
        // Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'master_kota_delete'])->name('kota.delete');
    });

    Route::group(['prefix' => '/user'], function () {
        Route::get('/', [App\Http\Controllers\MasterController::class, 'master_user'])->name('user');
        Route::post('/store', [App\Http\Controllers\MasterController::class, 'master_user_store'])->name('user.store');
        Route::post('/data', [App\Http\Controllers\MasterController::class, 'master_user_data'])->name('user.data');
        Route::get('/create', [App\Http\Controllers\MasterController::class, 'master_user_create'])->name('user.create');
        Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'master_user_edit'])->name('user.edit');
        Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'master_user_update'])->name('user.update');
        Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'master_user_delete'])->name('user.delete');
    });




    Route::group(['prefix' => '/satuan'], function () {
        Route::get('/', [App\Http\Controllers\MasterController::class, 'master_satuan'])->name('satuan');
        Route::post('/store', [App\Http\Controllers\MasterController::class, 'master_satuan_store'])->name('satuan.store');
        Route::post('/data', [App\Http\Controllers\MasterController::class, 'master_satuan_data'])->name('satuan.data');
        Route::get('/create', [App\Http\Controllers\MasterController::class, 'master_satuan_create'])->name('satuan.create');
        Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'master_satuan_edit'])->name('satuan.edit');
        Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'master_satuan_update'])->name('satuan.update');
        Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'master_satuan_delete'])->name('satuan.delete');
    });

    Route::group(['prefix' => '/tipe'], function () {
        Route::get('/', [App\Http\Controllers\MasterController::class, 'master_tipe'])->name('tipe');
        Route::post('/store', [App\Http\Controllers\MasterController::class, 'master_tipe_store'])->name('tipe.store');
        Route::post('/data', [App\Http\Controllers\MasterController::class, 'master_tipe_data'])->name('tipe.data');
        Route::get('/create', [App\Http\Controllers\MasterController::class, 'master_tipe_create'])->name('tipe.create');
        Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'master_tipe_edit'])->name('tipe.edit');
        Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'master_tipe_update'])->name('tipe.update');
        Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'master_tipe_delete'])->name('tipe.delete');
    });

    Route::group(['prefix' => '/supplier'], function () {
        Route::get('/', [App\Http\Controllers\MasterController::class, 'master_supplier'])->name('supplier');
        Route::post('/store', [App\Http\Controllers\MasterController::class, 'master_supplier_store'])->name('supplier.store');
        Route::post('/data', [App\Http\Controllers\MasterController::class, 'master_supplier_data'])->name('supplier.data');
        Route::get('/create', [App\Http\Controllers\MasterController::class, 'master_supplier_create'])->name('supplier.create');
        Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'master_supplier_edit'])->name('supplier.edit');
        Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'master_supplier_update'])->name('supplier.update');
        Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'master_supplier_delete'])->name('supplier.delete');
    });



    Route::group(['prefix' => '/promo'], function () {
        Route::get('/', [App\Http\Controllers\MasterController::class, 'master_promo'])->name('promo');
        Route::post('/data', [App\Http\Controllers\MasterController::class, 'promo_data'])->name('promo.data');
        Route::get('/create', [App\Http\Controllers\MasterController::class, 'promo_create'])->name('promo.create');
        Route::post('/store', [App\Http\Controllers\MasterController::class, 'promo_store'])->name('promo.store');
        Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'promo_edit'])->name('promo.edit');
        Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'promo_update'])->name('promo.update');
        Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'promo_delete'])->name('promo.delete');
    });
});


Route::group(['prefix' => '/barang'], function () {
    Route::get('/', [App\Http\Controllers\MasterController::class, 'master_barang'])->name('barang');
    Route::post('/store', [App\Http\Controllers\MasterController::class, 'master_barang_store'])->name('barang.store');
    Route::post('/data/{id}', [App\Http\Controllers\MasterController::class, 'master_barang_data'])->name('barang.data');
    Route::get('/create', [App\Http\Controllers\MasterController::class, 'master_barang_create'])->name('barang.create');
    Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'master_barang_edit'])->name('barang.edit');
    Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'master_barang_update'])->name('barang.update');
    Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'master_barang_delete'])->name('barang.delete');
    Route::get('/selectdata', [App\Http\Controllers\MasterController::class, 'master_barang_select_data'])->name('barang.selectdata');
    Route::get('/selectdata/{id}', [App\Http\Controllers\MasterController::class, 'master_barang_select_data_detail'])->name('barang.selectdatadetail');
    Route::get('/selectdata/po/{id}', [App\Http\Controllers\MasterController::class, 'master_barang_select_data_po'])->name('barang.selectdatapo');
});


Route::group(['prefix' => '/transaksi'], function () {
    Route::get('/', [App\Http\Controllers\TransaksiController::class, 'archive_trans'])->name('transaksi');

    Route::group(['prefix' => '/beli'], function () {
        Route::get('/', [App\Http\Controllers\TransaksiController::class, 'transaksi_beli'])->name('pembelian');
        Route::get('/tambah', [App\Http\Controllers\TransaksiController::class, 'tambah_beli'])->name('tambah-beli');
        Route::post('/store', [App\Http\Controllers\TransaksiController::class, 'store_beli'])->name('store-beli');
        Route::post('/data', [App\Http\Controllers\TransaksiController::class, 'data_transaksi_beli'])->name('pembelian.data');
        Route::post('/data/{id}', [App\Http\Controllers\TransaksiController::class, 'detail_data_transaksi_beli'])->name('pembelian.data.detail');
        Route::get('/edit/{id}', [App\Http\Controllers\TransaksiController::class, 'edit_beli'])->name('edit-beli');
        Route::get('/detail/{id}', [App\Http\Controllers\TransaksiController::class, 'detail_beli'])->name('detail-beli');
        Route::post('/update/{id}', [App\Http\Controllers\TransaksiController::class, 'update_beli'])->name('update-beli');
        Route::delete('/delete', [App\Http\Controllers\TransaksiController::class, 'delete_beli'])->name('delete-beli');
        Route::get('/selectdata/{id}', [App\Http\Controllers\TransaksiController::class, 'selectdata_beli'])->name('selectdata-beli');
    });

    Route::group(['prefix' => '/jual'], function () {
        Route::get('/', [App\Http\Controllers\TransaksiController::class, 'transaksi_jual'])->name('penjualan');
        Route::post('/data', [App\Http\Controllers\TransaksiController::class, 'data_transaksi_jual'])->name('data_jual');
        Route::get('/tambah', [App\Http\Controllers\TransaksiController::class, 'tambah_jual'])->name('tambah-jual');
        Route::post('/store', [App\Http\Controllers\TransaksiController::class, 'store_jual'])->name('store_jual');
        Route::get('/detail/{id}', [App\Http\Controllers\TransaksiController::class, 'detail_jual'])->name('detail_jual');
        Route::post('/data_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'data_detail_jual'])->name('data_detail_jual');
    });


    Route::group(['prefix' => '/hutang'], function () {
        Route::get('/selectdata/{id}', [App\Http\Controllers\TransaksiController::class, 'selectdata_hutang'])->name('selectdata-hutang');
        Route::get('/bayar', [App\Http\Controllers\TransaksiController::class, 'bayar_hutang'])->name('bayar_hutang');
        Route::post('/data', [App\Http\Controllers\TransaksiController::class, 'data_hutang'])->name('data.hutang');
        Route::post('/data/{id}', [App\Http\Controllers\TransaksiController::class, 'detail_data_hutang'])->name('detail.data.hutang');
        Route::get('/edit/{id}', [App\Http\Controllers\TransaksiController::class, 'edit_hutang'])->name('edit.hutang');
        Route::get('/', [App\Http\Controllers\TransaksiController::class, 'master_hutang'])->name('master_hutang');
        Route::post('/store', [App\Http\Controllers\TransaksiController::class, 'store_hutang'])->name('store_hutang');
        Route::post('/update/{id}', [App\Http\Controllers\TransaksiController::class, 'update_hutang'])->name('update_hutang');
        Route::get('/detail/{id}', [App\Http\Controllers\TransaksiController::class, 'detail_hutang'])->name('detail_hutang');
    });

    Route::group(['prefix' => '/piutang'], function () {
        Route::get('/bayar', [App\Http\Controllers\TransaksiController::class, 'bayar_piutang'])->name('bayar_piutang');
        Route::get('/', [App\Http\Controllers\TransaksiController::class, 'master_piutang'])->name('master_piutang');
        Route::post('/data', [App\Http\Controllers\TransaksiController::class, 'data_piutang'])->name('data_piutang');
        Route::get('/detail/{id}', [App\Http\Controllers\TransaksiController::class, 'detail_piutang'])->name('detail_piutang');
        Route::post('/data_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'data_detail_piutang'])->name('data_detail_piutang');
        Route::get('/tambah_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'tambah_detail_piutang'])->name('tambah_detail_piutang');
        Route::post('/store_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'store_detail_piutang'])->name('store_detail_piutang');
    });

    Route::group(['prefix' => '/retur-jual'], function () {
        Route::get('/tambah', [App\Http\Controllers\TransaksiController::class, 'tambah_retur_jual'])->name('tambah-retur-jual');
        Route::get('/', [App\Http\Controllers\TransaksiController::class, 'transaksi_retur_jual'])->name('retur-penjualan');
    });

    Route::group(['prefix' => '/retur-beli'], function () {
        Route::post('/data', [App\Http\Controllers\TransaksiController::class, 'data_retur_beli'])->name('data-retur-beli');
        Route::post('/data/{id}', [App\Http\Controllers\TransaksiController::class, 'detail_data_retur_beli'])->name('detail-data-retur-beli');
        Route::get('/tambah', [App\Http\Controllers\TransaksiController::class, 'tambah_retur_beli'])->name('tambah-retur-beli');
        Route::get('/edit/{id}', [App\Http\Controllers\TransaksiController::class, 'edit_retur_beli'])->name('edit-retur-beli');
        Route::post('/store', [App\Http\Controllers\TransaksiController::class, 'store_retur_beli'])->name('store-retur-beli');
        Route::get('/', [App\Http\Controllers\TransaksiController::class, 'transaksi_retur_beli'])->name('retur-pembelian');
        Route::post('/update/{id}', [App\Http\Controllers\TransaksiController::class, 'update_retur_beli'])->name('update-retur-beli');
        Route::get('/detail/{id}', [App\Http\Controllers\TransaksiController::class, 'detail_retur_beli'])->name('detail-retur-beli');
        Route::delete('/delete', [App\Http\Controllers\TransaksiController::class, 'delete_retur_beli'])->name('delete-retur-beli');
    });

    Route::group(['prefix' => '/booking'], function () {
        Route::get('/', [App\Http\Controllers\TransaksiController::class, 'master_booking'])->name('master_booking');
        Route::post('/data', [App\Http\Controllers\TransaksiController::class, 'data_master_booking'])->name('data_booking');
        Route::get('/tambah', [App\Http\Controllers\TransaksiController::class, 'tambah_booking'])->name('tambah_booking');
        Route::post('/store', [App\Http\Controllers\TransaksiController::class, 'store_booking'])->name('store_booking');
        Route::get('/', [App\Http\Controllers\MasterController::class, 'master_booking'])->name('master_booking');
    });
});

Route::group(['prefix' => '/laporan'], function () {
    Route::get('/', [App\Http\Controllers\LaporanController::class, 'archive_laporan'])->name('laporan');
    Route::get('/keuangan', [App\Http\Controllers\LaporanController::class, 'laporan_keuangan'])->name('keuangan');
    Route::get('/pembelian', [App\Http\Controllers\LaporanController::class, 'laporan_pembelian'])->name('pembelian');
    Route::get('/penjualan', [App\Http\Controllers\LaporanController::class, 'laporan_penjualan'])->name('penjualan');
    Route::get('/produk', [App\Http\Controllers\LaporanController::class, 'laporan_produk'])->name('produk');
    Route::get('/kasir', [App\Http\Controllers\LaporanController::class, 'kasir'])->name('kasir');
});
