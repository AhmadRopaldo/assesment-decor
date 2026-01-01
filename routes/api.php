<?php

use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Baris ini mencakup semua fungsi CRUD untuk produk
Route::apiResource('produks', ProdukController::class);
Route::apiResource('tags', TagController::class);

//untuk endpoint 
Route::post('/produk', [ProdukController::class, 'store']);

Route::get('/admin-orders', [OrderController::class, 'index']);





