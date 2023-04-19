<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductModelController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

//protected routes
Route::group(['middleware' => ['auth:sanctum']], function(){

    //user
    Route::post('/logout', [AuthController::class, 'logout']);

    //product
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    //productModel
    Route::get('/products/{id}/productmodels', [ProductModelController::class, 'index']);
    Route::post('/products/{id}/productmodels', [ProductModelController::class, 'store']);
    //Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::put('/productmodels/{id}', [ProductModelController::class, 'update']);
    Route::delete('/products/{id}/productmodels', [ProductModelController::class, 'destroy']);
});
