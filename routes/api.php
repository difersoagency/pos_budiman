<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    

});

Route::get('/notif', [App\Http\Controllers\MasterController::class, 'all_jatuh_tempo'])->name('notif.dashboard');
Route::get('/jual_dashboard', [App\Http\Controllers\MasterController::class, 'jual_dashboard'])->name('jual.dashboard');
Route::get('/barang_dashboard', [App\Http\Controllers\MasterController::class, 'barang_dashboard'])->name('barang.dashboard'); 
Route::get('/beli_dashboard', [App\Http\Controllers\MasterController::class, 'beli_dashboard'])->name('beli.dashboard'); 
Route::get('/booking_select', [App\Http\Controllers\MasterController::class, 'booking_select'])->name('booking.select'); 
Route::get('/barang_select', [App\Http\Controllers\MasterController::class, 'barang_select'])->name('barang.select');
Route::get('/customer_select', [App\Http\Controllers\MasterController::class, 'customer_select'])->name('customer.select'); 
Route::get('/pembayaran_select', [App\Http\Controllers\MasterController::class, 'pembayaran_select'])->name('pembayaran.select');
Route::get('/supplier_select', [App\Http\Controllers\MasterController::class, 'supplier_select'])->name('supplier.select'); 
Route::get('/satuan_select', [App\Http\Controllers\MasterController::class, 'satuan_select'])->name('satuan.select'); 
Route::get('/promo_select', [App\Http\Controllers\MasterController::class, 'promo_select'])->name('promo.select'); 
Route::get('/garansi_transjual_select', [App\Http\Controllers\MasterController::class, 'garansi_transaksi_jual_select'])->name('garansi_transjual_select');
Route::get('/get_d_trans_jual/{id}', [App\Http\Controllers\MasterController::class, 'get_d_trans_jual'])->name('get_d_trans_jual');
Route::get('/promo_aktif/{id}/{jenis}/{qty}', [App\Http\Controllers\TransaksiController::class, 'promo_aktif'])->name('promo_aktif');
Route::get('/cek_jumlah_beli/{po}/{barang}', [App\Http\Controllers\TransaksiController::class, 'cek_jumlah_beli'])->name('cek_jumlah_beli');


    
    
