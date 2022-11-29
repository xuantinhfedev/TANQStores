<?php

use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){

    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // Category Routes
    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::post('category', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::get('category/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::put('category/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);

    // Product Routes
    Route::get('products', [App\Http\Controllers\Admin\ProductController::class, 'index']);
    Route::get('products/create', [App\Http\Controllers\Admin\ProductController::class, 'create']);
    Route::post('products', [App\Http\Controllers\Admin\ProductController::class, 'store']);
    Route::get('products/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit']);
    Route::put('products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update']);
    Route::get('product-image/{product_image_id}/delete', [App\Http\Controllers\Admin\ProductController::class, 'destroyImage']);

    // Brand Routes
    Route::get('brands/index', App\Http\Livewire\Admin\Brands\Index::class)->name('admin.brands.index');
    Route::get('brands/create', App\Http\Livewire\Admin\Brands\Create::class)->name('admin.brands.create');
    Route::get('brands/edit/{brand}', App\Http\Livewire\Admin\Brands\Edit::class)->name('admin.brands.edit');
});
