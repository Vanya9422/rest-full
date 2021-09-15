<?php

use Illuminate\Support\Facades\Route;

Route::post('categories', [\App\Http\Controllers\Api\V1\CategoryController::class, 'store']);
Route::delete('categories/{category}', [\App\Http\Controllers\Api\V1\CategoryController::class, 'destroy']);
