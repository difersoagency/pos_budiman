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

Route::get('/booking_select', [App\Http\Controllers\MasterController::class, 'booking_select'])->name('booking.select'); 
    Route::get('/barang_select', [App\Http\Controllers\MasterController::class, 'barang_select'])->name('barang.select');
    Route::get('/customer_select', [App\Http\Controllers\MasterController::class, 'customer_select'])->name('customer.select'); 
    Route::get('/pembayaran_select', [App\Http\Controllers\MasterController::class, 'pembayaran_select'])->name('pembayaran.select'); 
