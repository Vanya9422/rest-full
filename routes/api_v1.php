<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'categories'], function () {
    Route::post('/', [\App\Http\Controllers\Api\V1\CategoryController::class, 'store']);
    Route::delete('{category}', [\App\Http\Controllers\Api\V1\CategoryController::class, 'destroy']);
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [\App\Http\Controllers\Api\V1\ProductController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Api\V1\ProductController::class, 'store']);
    Route::put('{product}', [\App\Http\Controllers\Api\V1\ProductController::class, 'update']);
    Route::delete('{product}', [\App\Http\Controllers\Api\V1\ProductController::class, 'destroy']);
});
