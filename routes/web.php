<?php

use App\Http\Controllers\DienkeController;
use App\Http\Controllers\GiaDienController;
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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    // Gia dien 
    Route::prefix('giadien-hientai')->group(function () {
        Route::get('/', [GiaDienController::class, 'showlist'])->name('giadien');
    });

    Route::prefix('khachhang')->group(function () {
        Route::get('/', function () {
            return view('khachhang');
        })->name('khachhang');
    });
    Route::prefix('hoadon')->group(function () {
        Route::get('/', function () {
            return view("hoadon");
        })->name('hoadon');
    });

    Route::prefix('no')->group(function () {
        Route::get('/', function () {
            return view("no");
        })->name('no');
    });

    // Resource Controllers 
    Route::resources([
        'giadiens' => GiaDienController::class,
        'dienkes' => DienkeController::class,
    ]);
});
