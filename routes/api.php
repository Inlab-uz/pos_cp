<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Mobile\AuthController;
use App\Http\Controllers\Mobile\CashierController;
use App\Http\Controllers\Mobile\ManagerController;
use App\Http\Controllers\Mobile\MobileResponseController;
use App\Http\Controllers\PDFController;
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
Route::post('/login', [ApiAuthController::class, 'login']);

Route::group(['middleware' => 'api-auth'], function () {
    Route::post('/me', [ApiAuthController::class, 'me']);
    Route::post('/tokens', [ApiAuthController::class, 'getAllTokens']);
    Route::post('/logout', [ApiAuthController::class, 'logout']);

});

Route::group(['middleware' => 'ajax.check'], function () {
    Route::post('/api-user/toggle-status/{user_id}', [ApiUserController::class, 'toggleUserActivation']);
    Route::post('/api-token/toggle-status/{token_id}', [ApiUserController::class, 'toggleTokenActivation']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'mobile'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->middleware('auth:sanctum');
});
Route::group(['prefix' => 'mobile', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/get-category', [ManagerController::class, 'getCategory']);
    Route::post('/get-product-by-category', [ManagerController::class, 'getProductByCategory']);
    Route::post('/get-product-by-barcode', [ManagerController::class, 'getProductByBarCode']);
    Route::post('/get-product-by-id', [ManagerController::class, 'getProductById']);
    Route::get('/measurement', [ManagerController::class, 'measurement']);
    Route::post('/import-update', [ManagerController::class, 'importUpdate']);
    Route::get('/import-all', [ManagerController::class, 'getAllImport']);
    Route::post('/import-show', [ManagerController::class, 'showImport']);
    Route::post('/category-create', [ManagerController::class, 'categoryCreate']);
    Route::post('/category-update', [ManagerController::class, 'categoryUpdate']);
    Route::get('/pay_type', [ManagerController::class, 'payType']);

    Route::post('/get-product/by-barcode', [CashierController::class, 'search']);
    Route::post('/order', [CashierController::class, 'orderCreate']);
    Route::post('/add-product', [ManagerController::class, 'addProduct']);
    Route::post('/update-product', [ManagerController::class, 'updateProduct']);
    // Telegram
    Route::get('search-product', [MobileResponseController::class, 'searchProductByName']);
});


Route::group(['prefix' => 'web'], function () {

    Route::post('/get-product/by-barcode/{cid}/{barcode}', [CartController::class, 'v2searchBarcode']);
    Route::post('/get-product/by-name/{cid}/{key}', [CartController::class, 'v2searchProduct']);

});
Route::post('/upload', [ManagerController::class, 'uploadBase64Img']);
Route::post('/decode', [ManagerController::class, 'decodeBase64Img']);
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);




