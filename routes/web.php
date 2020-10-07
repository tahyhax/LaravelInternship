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

Route::get('/category/{category:slug}', [\App\Http\Controllers\Front\CategoryController::class, 'show'])
    ->name('category.show');

Route::get('/product/{product:slug}', [\App\Http\Controllers\Front\ProductController::class, 'show'])
    ->name('products.show');


//Route::resource('posts', \App\Http\Controllers\PostController::class);

Route::get('posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post}/show', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::middleware('auth')->group(function() {
    Route::get('posts/create', [\App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
    Route::get('posts/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
    Route::delete('posts/{post}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('posts', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
    Route::put('posts/{post}', [\App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
});


Route::prefix('admin')->name('Dashboard')->name('admin.')->group(function() {

});
