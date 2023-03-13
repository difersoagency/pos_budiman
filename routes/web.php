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


    Route::group(['prefix' => '/substitusi'], function () {
        Route::get('/', [App\Http\Controllers\MasterController::class, 'master_substitusi'])->name('substitusi');
        Route::get('/data', [App\Http\Controllers\MasterController::class, 'substitusi_data'])->name('substitusi.data');
        Route::get('/tambah', [App\Http\Controllers\MasterController::class, 'substitusi_create'])->name('substitusi.create');
        Route::post('/store', [App\Http\Controllers\MasterController::class, 'substitusi_store'])->name('substitusi.store');
        Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'substitusi_edit'])->name('substitusi.edit');
        Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'substitusi_update'])->name('substitusi.update');
        Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'substitusi_delete'])->name('substitusi.delete');
    });

    Route::group(['prefix' => '/koreksi'], function () {
        Route::get('/', [App\Http\Controllers\MasterController::class, 'master_koreksi'])->name('koreksi');
        Route::post('/data/{id}', [App\Http\Controllers\MasterController::class, 'data_koreksi'])->name('koreksi.data');
        Route::get('/tambah', [App\Http\Controllers\MasterController::class, 'koreksi_create'])->name('koreksi.create');
        Route::post('/store', [App\Http\Controllers\MasterController::class, 'koreksi_store'])->name('koreksi.store');
    });
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
        Route::post('/data/{id}', [App\Http\Controllers\MasterController::class, 'master_supplier_data'])->name('supplier.data');
        Route::get('/create', [App\Http\Controllers\MasterController::class, 'master_supplier_create'])->name('supplier.create');
        Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'master_supplier_edit'])->name('supplier.edit');
        Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'master_supplier_update'])->name('supplier.update');
        Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'master_supplier_delete'])->name('supplier.delete');
    });



    Route::group(['prefix' => '/promo'], function () {
        Route::get('/', [App\Http\Controllers\MasterController::class, 'master_promo'])->name('promo');
        Route::post('/data/{tgl_min}/{tgl_max}', [App\Http\Controllers\MasterController::class, 'promo_data'])->name('promo.data');
        Route::get('/create', [App\Http\Controllers\MasterController::class, 'promo_create'])->name('promo.create');
        Route::post('/store', [App\Http\Controllers\MasterController::class, 'promo_store'])->name('promo.store');
        Route::get('/edit/{id}', [App\Http\Controllers\MasterController::class, 'promo_edit'])->name('promo.edit');
        Route::post('/update/{id}', [App\Http\Controllers\MasterController::class, 'promo_update'])->name('promo.update');
        Route::delete('/delete', [App\Http\Controllers\MasterController::class, 'promo_delete'])->name('promo.delete');
    });
});
Route::view('/test-kasir', 'kasir');

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
        Route::get('/nota/{id}', [App\Http\Controllers\TransaksiController::class, 'nota_beli'])->name('nota-beli');
        Route::post('/data', [App\Http\Controllers\TransaksiController::class, 'data_transaksi_beli'])->name('pembelian.data');
        Route::post('/data/{id}', [App\Http\Controllers\TransaksiController::class, 'detail_data_transaksi_beli'])->name('pembelian.data.detail');
        Route::get('/edit/{id}', [App\Http\Controllers\TransaksiController::class, 'edit_beli'])->name('edit-beli');
        Route::get('/detail/{id}', [App\Http\Controllers\TransaksiController::class, 'detail_beli'])->name('detail-beli');
        Route::post('/update/{id}', [App\Http\Controllers\TransaksiController::class, 'update_beli'])->name('update-beli');
        Route::delete('/delete', [App\Http\Controllers\TransaksiController::class, 'delete_beli'])->name('delete-beli');
        Route::get('/selectdata/{id}', [App\Http\Controllers\TransaksiController::class, 'selectdata_beli'])->name('selectdata-beli');
        
    });

    Route::group(['prefix' => '/jual'], function () {
        Route::get('/', [App\Http\Controllers\TransaksiController::class, 'transaksi_jual'])->name('trans-jual');
        Route::get('/nota/{id}', [App\Http\Controllers\TransaksiController::class, 'nota_jual'])->name('nota-jual');
        Route::post('/data', [App\Http\Controllers\TransaksiController::class, 'data_transaksi_jual'])->name('data_jual');
        Route::get('/detail/{id}', [App\Http\Controllers\TransaksiController::class, 'detail_jual'])->name('detail_jual');
        Route::post('/data_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'data_detail_jual'])->name('data_detail_jual');

        Route::get('/tambah', [App\Http\Controllers\TransaksiController::class, 'tambah_jual'])->name('tambah-jual');
        Route::post('/store', [App\Http\Controllers\TransaksiController::class, 'store_jual'])->name('store_jual');

        Route::get('/edit/{id}', [App\Http\Controllers\TransaksiController::class, 'edit_jual'])->name('edit_jual');
        Route::put('/update/{id}', [App\Http\Controllers\TransaksiController::class, 'update_jual'])->name('update_jual');

        Route::delete('/delete', [App\Http\Controllers\TransaksiController::class, 'delete_jual'])->name('delete_jual');

        
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

        Route::get('/tambah_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'tambah_detail_hutang'])->name('tambah_detail_hutang');
        Route::post('/store_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'store_detail_hutang'])->name('store_detail_hutang');
        Route::get('/edit_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'edit_detail_hutang'])->name('edit_detail_hutang');
        Route::post('/update_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'update_detail_hutang'])->name('update_detail_hutang');
        Route::delete('/delete_detail', [App\Http\Controllers\TransaksiController::class, 'delete_detail_hutang'])->name('delete_detail_hutang');

        
    });

    Route::group(['prefix' => '/piutang'], function () {
        Route::get('/bayar', [App\Http\Controllers\TransaksiController::class, 'bayar_piutang'])->name('bayar_piutang');
        Route::get('/', [App\Http\Controllers\TransaksiController::class, 'master_piutang'])->name('master_piutang');
        Route::post('/data', [App\Http\Controllers\TransaksiController::class, 'data_piutang'])->name('data_piutang');
        Route::get('/detail/{id}', [App\Http\Controllers\TransaksiController::class, 'detail_piutang'])->name('detail_piutang');
        Route::post('/data_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'data_detail_piutang'])->name('data_detail_piutang');

        Route::get('/tambah_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'tambah_detail_piutang'])->name('tambah_detail_piutang');
        Route::post('/store_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'store_detail_piutang'])->name('store_detail_piutang');
        Route::get('/edit_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'edit_detail_piutang'])->name('edit_detail_piutang');
        Route::post('/update_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'update_detail_piutang'])->name('update_detail_piutang');
        Route::delete('/delete_detail', [App\Http\Controllers\TransaksiController::class, 'delete_detail_piutang'])->name('delete_detail_piutang');

        Route::delete('/delete', [App\Http\Controllers\TransaksiController::class, 'delete_piutang'])->name('delete_piutang');

        
    });

    Route::group(['prefix' => '/retur-jual'], function () {
        Route::post('/data', [App\Http\Controllers\TransaksiController::class, 'data_retur_jual'])->name('data_retur_jual');
        Route::get('/detail/{id}', [App\Http\Controllers\TransaksiController::class, 'detail_retur_jual'])->name('detail_retur_jual');
        Route::post('/data_detail/{id}', [App\Http\Controllers\TransaksiController::class, 'data_detail_retur_jual'])->name('data_detail_retur_jual');

        Route::get('/tambah', [App\Http\Controllers\TransaksiController::class, 'tambah_retur_jual'])->name('tambah-retur-jual');
        Route::post('/store', [App\Http\Controllers\TransaksiController::class, 'store_retur_jual'])->name('store-retur-jual');

        Route::get('/edit/{id}', [App\Http\Controllers\TransaksiController::class, 'edit_retur_jual'])->name('edit_retur_jual');
        Route::put('/update/{id}', [App\Http\Controllers\TransaksiController::class, 'update_retur_jual'])->name('update_retur_jual');

        Route::get('/', [App\Http\Controllers\TransaksiController::class, 'transaksi_retur_jual'])->name('retur-penjualan');
        Route::delete('/delete', [App\Http\Controllers\TransaksiController::class, 'delete_retur_jual'])->name('delete-retur-jual');
        
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
        Route::get('/edit/{id}', [App\Http\Controllers\TransaksiController::class, 'edit_booking'])->name('edit_booking');
        Route::put('/update/{id}', [App\Http\Controllers\TransaksiController::class, 'update_booking'])->name('update_booking');
        Route::get('/', [App\Http\Controllers\TransaksiController::class, 'master_booking'])->name('master_booking');
        Route::delete('/delete', [App\Http\Controllers\TransaksiController::class, 'delete_booking'])->name('booking.delete');
    });
});

Route::group(['prefix' => '/laporan'], function () {
    Route::get('/', [App\Http\Controllers\LaporanController::class, 'archive_laporan'])->name('laporan');
    Route::get('/laba_rugi', [App\Http\Controllers\LaporanController::class, 'laporan_laba_rugi'])->name('laporan.laba_rugi');
    Route::get('/pembelian', [App\Http\Controllers\LaporanController::class, 'laporan_pembelian'])->name('laporan.pembelian');
    Route::get('/penjualan', [App\Http\Controllers\LaporanController::class, 'laporan_penjualan'])->name('laporan.penjualan');
    Route::get('/retur_beli', [App\Http\Controllers\LaporanController::class, 'laporan_retur_beli'])->name('laporan.retur_beli');
    Route::get('/retur_jual', [App\Http\Controllers\LaporanController::class, 'laporan_retur_jual'])->name('laporan.retur_jual');
    Route::get('/hutang', [App\Http\Controllers\LaporanController::class, 'laporan_hutang'])->name('laporan.hutang');
    Route::get('/piutang', [App\Http\Controllers\LaporanController::class, 'laporan_piutang'])->name('laporan.piutang');
    Route::get('/kartu_stok', [App\Http\Controllers\LaporanController::class, 'laporan_kartu_stok'])->name('laporan.kartu_stok');
    Route::get('/top_penjualan', [App\Http\Controllers\LaporanController::class, 'laporan_top_penjualan'])->name('laporan.top_penjualan');
    Route::get('/produk', [App\Http\Controllers\LaporanController::class, 'laporan_produk'])->name('laporan.produk');
    Route::get('/kasir', [App\Http\Controllers\LaporanController::class, 'kasir'])->name('kasir');
    Route::group(['prefix' => '/data'], function () {
        Route::get('/laba_rugi/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'laporan_laba_rugi_data'])->name('data.laporan.laba_rugi');
        Route::get('/pembelian/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'laporan_pembelian_data'])->name('data.laporan.pembelian');
        Route::get('/penjualan/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'laporan_penjualan_data'])->name('data.laporan.penjualan');
        Route::get('/retur_beli/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'laporan_retur_beli_data'])->name('data.laporan.retur_beli');
        Route::get('/retur_jual/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'laporan_retur_jual_data'])->name('data.laporan.retur_jual');
        Route::get('/hutang/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'laporan_hutang_data'])->name('data.laporan.hutang');
        Route::get('/piutang/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'laporan_piutang_data'])->name('data.laporan.piutang');
        Route::get('/kartu_stok/{barang_id}/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'laporan_kartu_stok_data'])->name('data.laporan.kartu_stok');
        Route::get('/top_penjualan/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'laporan_top_penjualan_data'])->name('data.laporan.top_penjualan');
        Route::get('/produk', [App\Http\Controllers\LaporanController::class, 'laporan_produk_data'])->name('data.laporan.produk');
    });
    Route::group(['prefix' => '/table'], function () {
        Route::post('/laba_rugi/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'data_laba_rugi'])->name('table.laporan.laba_rugi');
        Route::post('/pembelian/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'data_pembelian'])->name('table.laporan.pembelian');
        Route::post('/penjualan/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'data_penjualan'])->name('table.laporan.penjualan');
        Route::post('/retur_beli/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'data_retur_beli'])->name('table.laporan.retur_beli');
        Route::post('/retur_jual/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'data_retur_jual'])->name('table.laporan.retur_jual');
        Route::post('/hutang/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'data_hutang'])->name('table.laporan.hutang');
        Route::post('/piutang/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'data_piutang'])->name('table.laporan.piutang');
        Route::post('/kartu_stok/{barang_id}/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'data_kartu_stok'])->name('table.laporan.kartu_stok');
        Route::post('/top_penjualan/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\LaporanController::class, 'data_top_penjualan'])->name('table.laporan.top_penjualan');
        Route::post('/produk', [App\Http\Controllers\LaporanController::class, 'data_produk'])->name('table.laporan.produk');
    });
});
