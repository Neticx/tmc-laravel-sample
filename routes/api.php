<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
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

Route::prefix('user')->group(function (){
   Route::post('register',[AuthController::class,'register']);
   Route::post('login',[AuthController::class,'login']);
});
Route::middleware('auth:sanctum')->group(function (){
    Route::prefix('category')->group(function (){
        Route::post('/',[CategoryController::class,'create']);
    });

    Route::prefix('products')->group(function (){
        Route::post('/',[ProductController::class,'create']);
    });
});
