<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KemejaController;

use App\Http\Controllers\Api\NewPasswordController;
use App\Http\Controllers\API\PenjualController;
use App\Http\Controllers\API\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('forgot-password', [NewPasswordController::class, 'forgotPassword']);
Route::post('reset-password', [NewPasswordController::class, 'reset']);

// Lindungi rute API lainnya dengan middleware auth:sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('kemeja', KemejaController::class);
    Route::apiResource('penjual', PenjualController::class);
    Route::apiResource('transaksi', TransaksiController::class);
    Route::post('/kemeja/{id}', [KemejaController::class, 'update']);
    Route::post('/penjual/{id}', [PenjualController::class, 'update']);
    Route::post('/transaksi/{id}', [TransaksiController::class, 'update']);
});
