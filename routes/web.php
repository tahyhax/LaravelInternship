<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Controllers\Front\MainController::class)->name('main.index');

Route::get('/category/{category}', [\App\Http\Controllers\Front\CategoryController::class, 'show'])
    ->name('category.show');

Route::get('products', [\App\Http\Controllers\Front\ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/{product}', [\App\Http\Controllers\Front\ProductController::class, 'show'])
    ->name('products.show');

Route::get('/posts', [\App\Http\Controllers\Front\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [\App\Http\Controllers\Front\PostController::class, 'show'])->name('posts.show');

Route::get('/cart', \App\Http\Livewire\Cart::class)->name('cart');
Route::get('/checkout', [\App\Http\Controllers\Front\CheckoutController::class, 'show'])
    ->name('checkout.show');

Route::post('/checkout/ordering', [\App\Http\Controllers\Front\CheckoutController::class, 'ordering'])
    ->name('checkout.ordering');

Route::group(['as' => 'cabinet.', 'prefix' => 'cabinet', 'middleware' => ['auth', 'role:customer']],
    function () {
        Route::get('/', \App\Http\Controllers\Cabinet\MainController::class)
            ->name('main.index');

        Route::get('/customer-info', [\App\Http\Controllers\Cabinet\CustomerInfoController::class, 'show'])
            ->name('customer-info.show');
        Route::get('/customer-info/{customer}', [\App\Http\Controllers\Cabinet\CustomerInfoController::class, 'edit'])
            ->name('customer-info.edit');

        Route::put('/customer-info/{customer}/update', [\App\Http\Controllers\Cabinet\CustomerInfoController::class, 'update'])
            ->name('customer-info.update');
    });
