<?php

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



Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Tien dien 
    Route::prefix('dienke')->group(function () {
        Route::get('/', function () {
            return "dienke";
        })->name('dienke');
    });
    Route::prefix('khachhang')->group(function () {
        Route::get('/', function () {
            return "Khachhang";
        })->name('khachhang');
    });
    Route::prefix('hoadon')->group(function () {
        Route::get('/', function () {
            return "hoadon";
        })->name('hoadon');
    });
    Route::prefix('giadien')->group(function () {
        Route::get('/', function () {
            return "giadien";
        })->name('giadien');
    });
    Route::prefix('no')->group(function () {
        Route::get('/', function () {
            return "no";
        })->name('no');
    });
    Route::prefix('hoadon')->group(function () {
        Route::get('/', function () {
            return "hoadon";
        })->name('hoadon');
    });
});
