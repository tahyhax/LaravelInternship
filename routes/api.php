<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.', 'namespace' => '\App\Http\Controllers\Api'], function () {

    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum', 'verify-route-access']], function () {

        Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
        Route::put('orders/update-status/{order}', [\App\Http\Controllers\Api\OrderController::class, 'updateStatus']);

        Route::post('categories/{category}', [\App\Http\Controllers\Api\CategoryController::class, 'update']);
        Route::apiResource('categories', CategoryController::class)->except('update');

        Route::post('products/{product}', [\App\Http\Controllers\Api\ProductController::class, 'update']);
        Route::apiResource('products', ProductController::class)->except('update');


        Route::apiResources([
            'roles' => RoleController::class,
            'permissions' => PermissionController::class,
            'brands' => BrandController::class,
            'posts' => PostController::class,
            'payment-methods' => PaymentMethodController::class,
            'orders' => OrderController::class,
        ]);

    });

});