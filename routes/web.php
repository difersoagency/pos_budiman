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
});


