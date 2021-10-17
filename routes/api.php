<?php

use App\Http\Controllers\Mobile\AuthController;
use App\Http\Controllers\Mobile\ManagerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Blade\ApiUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


# Api Clients
Route::post('/login',[ApiAuthController::class,'login']);

Route::group(['middleware' => 'api-auth'],function (){
    Route::post('/me',[ApiAuthController::class,'me']);
    Route::post('/tokens',[ApiAuthController::class,'getAllTokens']);
    Route::post('/logout',[ApiAuthController::class,'logout']);
});

Route::group(['middleware' => 'ajax.check'],function (){
    Route::post('/api-user/toggle-status/{user_id}',[ApiUserController::class,'toggleUserActivation']);
    Route::post('/api-token/toggle-status/{token_id}',[ApiUserController::class,'toggleTokenActivation']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'mobile'],function (){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login'])->middleware('auth:sanctum');
});
Route::group(['prefix' => 'mobile','middleware' => 'auth:sanctum'],function (){
    Route::get('/get-category',[ManagerController::class,'getCategory']);
    Route::post('/get-product-by-category',[ManagerController::class,'getProductByCategory']);
    Route::post('/get-product-by-barcode',[ManagerController::class,'getProductByBarCode']);
    Route::post('/add-product',[ManagerController::class,'addProduct']);
    Route::post('/update-product',[ManagerController::class,'updateProduct']);
});
