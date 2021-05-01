<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhachhangController;
use App\Http\Controllers\HoadonController;
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
            return view('dienke');
        })->name('dienke');
    });


    //DS Khách hàng
    Route::prefix('khachhang')->group(function () {
        Route::get('/',[KhachhangController::class,'all_kh'])->name('khachhang');
        // Route::get('/',[KhachhangController::class,'add_khachhang'])->name('add_khachhang');
        Route::post('add',[KhachhangController::class,'store'])->name('store');
        Route::get('delete/{makh}',[KhachhangController::class,'delete'])->name('delete');
        Route::get('update/{makh}',[KhachhangController::class,'edit'])->name('update');
        Route::post('update/{makh}',[KhachhangController::class,'update']);
    });


    Route::prefix('giadien')->group(function () {
        Route::get('/', function () {
            return view("giadien");
        })->name('giadien');
    });

    //nợ tiền
    Route::prefix('no')->group(function () {
        Route::get('/',[KhachhangController::class,'all_kh_no'])->name('no');
    });

    //Hóa đơn
    Route::prefix('hoadon')->group(function () {
        Route::get('/',[HoadonController::class,'all_hoadon'])->name('hoadon');
        // Route::get('danhsachdk',[HoadonController::class,'all_dk'])->name('hoadon');
        Route::post('tinhtien/{madk}',[HoadonController::class,'tinhtien'])->name('tinhtien');
        Route::get('print_hoadon/{mahd}',[HoadonController::class,'print_hoadon'])->name('print_hoadon');
        
    });

   // Route::resource('photos', PhotoController::class);
});

// route::get('/kh/delete/{id}', function($id){
//     echo "delete $id";
//     });