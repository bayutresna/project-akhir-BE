<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\FasilitasHotelController;
use App\Http\Controllers\FasilitasKamarController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ReservasiKamarController;
use App\Http\Controllers\TipeKamarController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/me', [AuthController::class, 'getUser'])->middleware('auth:sanctum');


Route::prefix('user')->group(function(){
    Route::get('/', [UserController::class,'index']);
    Route::get('/{id}/show', [UserController::class,'show']);
    Route::post('/', [UserController::class,'store']);
    Route::post('/edit/{id}', [UserController::class,'update']);
    Route::post('/delete/{id}', [UserController::class,'destroy']);
});

Route::prefix('galeri')->group(function(){
    Route::get('/', [GalleryController::class,'index']);
    Route::get('/{id}/show', [GalleryController::class,'show']);
    Route::post('/', [GalleryController::class,'store']);
    Route::post('/edit/{id}', [GalleryController::class,'update']);
    Route::post('/delete/{id}', [GalleryController::class,'destroy']);
});

Route::prefix('fasilitas')->group(function(){
    Route::get('/', [FasilitasController::class,'index']);
    Route::get('/{id}/show', [FasilitasController::class,'show']);
    Route::post('/', [FasilitasController::class,'store']);
    Route::post('/edit/{id}', [FasilitasController::class,'update']);
    Route::post('/delete/{id}', [FasilitasController::class,'destroy']);
});

Route::prefix('fasilitaskamar')->group(function(){
    Route::get('/', [FasilitasKamarController::class,'index']);
    Route::get('/{id}/show', [FasilitasKamarController::class,'show']);
    Route::post('/', [FasilitasKamarController::class,'store']);
    Route::post('/edit/{id}', [FasilitasKamarController::class,'update']);
    Route::post('/delete/{id}', [FasilitasKamarController::class,'destroy']);
});

Route::prefix('fasilitashotel')->group(function(){
    Route::get('/', [FasilitasHotelController::class,'index']);
    Route::get('/{id}/show', [FasilitasHotelController::class,'show']);
    Route::post('/', [FasilitasHotelController::class,'store']);
    Route::post('/edit/{id}', [FasilitasHotelController::class,'update']);
    Route::post('/delete/{id}', [FasilitasHotelController::class,'destroy']);
});

Route::prefix('kamar')->group(function(){
    Route::get('/', [KamarController::class,'index']);
    Route::get('/{id}/show', [KamarController::class,'show']);
    Route::post('/', [KamarController::class,'store']);
    Route::post('/edit/{id}', [KamarController::class,'update']);
    Route::post('/delete/{id}', [KamarController::class,'destroy']);
});

Route::prefix('tipekamar')->group(function(){
    Route::get('/', [TipeKamarController::class,'index']);
    Route::get('/{id}/show', [TipeKamarController::class,'show']);
    Route::post('/', [TipeKamarController::class,'store']);
    Route::post('/edit/{id}', [TipeKamarController::class,'update']);
    Route::post('/delete/{id}', [TipeKamarController::class,'destroy']);
});

Route::prefix('reservasikamar')->group(function(){
    Route::get('/', [ReservasiKamarController::class,'index']);
    Route::get('/{id}/show', [ReservasiKamarController::class,'show']);
    Route::post('/', [ReservasiKamarController::class,'store']);
    Route::post('/edit/{id}', [ReservasiKamarController::class,'update']);
    Route::post('/delete/{id}', [ReservasiKamarController::class,'destroy']);
});

// Route::prefix('reservasinonkamar')->group(function(){
//     Route::get('/', [ReservasiNonKamarController::class,'index']);
//     Route::get('/{id}/show', [ReservasiNonKamarController::class,'show']);
//     Route::post('/', [ReservasiNonKamarController::class,'store']);
//     Route::post('/edit/{id}', [ReservasiNonKamarController::class,'update']);
//     Route::post('/delete/{id}', [ReservasiNonKamarController::class,'destroy']);
// });
