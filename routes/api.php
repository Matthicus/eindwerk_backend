<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategorieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::apiResource('products', ProductController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::apiResource('categories', CategorieController::class)->only(['index']);