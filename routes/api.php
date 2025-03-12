<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BuyController;


Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']); 
    Route::get('/{id}', [ProductController::class, 'show']); 
    Route::post('/', [ProductController::class, 'store']); 
    Route::put('/{id}', [ProductController::class, 'update']); 
    Route::delete('/{id}', [ProductController::class, 'destroy']); 
});


Route::prefix('buys')->group(function () {
    Route::get('/', [BuyController::class, 'index']);
    Route::get('/{id}', [BuyController::class, 'show']);
    Route::post('/', [BuyController::class, 'store']); 
    Route::put('/{id}', [BuyController::class, 'update']); 
    Route::delete('/{id}', [BuyController::class, 'destroy']); 
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
