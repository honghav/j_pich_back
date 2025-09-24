<?php

use App\Http\Controllers\Api\BAnotherPaysController;
use App\Http\Controllers\Api\BCategoriesController;
use App\Http\Controllers\Api\BDashbordController;
use App\Http\Controllers\Api\BProductsController;
use App\Http\Controllers\Api\BOrdersController;
use App\Http\Controllers\Api\BProductImagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('categories', BCategoriesController::class);
Route::apiResource('products', BProductsController::class);
Route::apiResource('orders', BOrdersController::class);
Route::apiResource('anotherpay', BAnotherPaysController::class);
Route::apiResource('productimages', BProductImagesController::class);
Route::get('/productbyimages/{product}', [BProductImagesController::class, 'getAllbyProduct']);

Route::get('sumdiscount', [BOrdersController::class, 'countDiscount']);
Route::get('productstatus', [BProductsController::class, 'allByStatus']);
Route::get('countorder', [BDashbordController::class, 'getOrderCount']);
Route::get('anotherpaycount', [BDashbordController::class, 'getAnotherOrderCount']);
Route::get('anotherpaysum', [BDashbordController::class, 'getAnotherOrderSum']);
Route::get('summoneyorder', [BDashbordController::class, 'getOrderSum']);
Route::get('productactive', [BDashbordController::class, 'getProductCount']);