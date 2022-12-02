<?php

use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class ,'index']);
Route::get('/colections',[App\Http\Controllers\Frontend\FrontendController::class ,'categories']);
Route::get('/colections/{category_slug}',[App\Http\Controllers\Frontend\FrontendController::class ,'products']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){

    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    //Slider Routes
    Route::get('sliders', [App\Http\Controllers\Admin\SliderController::class, 'index']);
    Route::get('sliders/create', [App\Http\Controllers\Admin\SliderController::class, 'create']);
    Route::post('sliders',[App\Http\Controllers\Admin\SliderController::class, 'store']);
    Route::get('sliders/{slider}/edit', [App\Http\Controllers\Admin\SliderController::class, 'edit']);
    Route::put('sliders/{slider}', [App\Http\Controllers\Admin\SliderController::class, 'update']);
    Route::get('sliders/{slider}/delete', [App\Http\Controllers\Admin\SliderController::class, 'destroy']);

    // Category Routes
    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::post('category', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::get('category/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::put('category/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::get('category/{category}/delete', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']);

    // Product Routes
    Route::get('products', [App\Http\Controllers\Admin\ProductController::class, 'index']);
    Route::get('products/create', [App\Http\Controllers\Admin\ProductController::class, 'create']);
    Route::post('products', [App\Http\Controllers\Admin\ProductController::class, 'store']);
    Route::get('products/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit']);
    Route::put('products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update']);
    Route::get('products/{product_id}/delete', [App\Http\Controllers\Admin\ProductController::class, 'destroy']);
    Route::get('product-image/{product_image_id}/delete', [App\Http\Controllers\Admin\ProductController::class, 'destroyImage']);
    Route::post('product-color/{prod_color_id}', [App\Http\Controllers\Admin\ProductController::class, 'updateProdColorQty']);
    Route::get('product-color/{prod_color_id}/delete', [App\Http\Controllers\Admin\ProductController::class, 'deleteProdColorQty']);


    // Colors Routes
    Route::get('colors', [App\Http\Controllers\Admin\ColorController::class, 'index']);
    Route::get('colors/create', [App\Http\Controllers\Admin\ColorController::class, 'create']);
    Route::post('colors', [App\Http\Controllers\Admin\ColorController::class, 'store']);
    Route::get('colors/{color}/edit', [App\Http\Controllers\Admin\ColorController::class, 'edit']);
    Route::put('colors/{color_id}', [App\Http\Controllers\Admin\ColorController::class, 'update']);
    Route::get('colors/{color_id}/delete', [App\Http\Controllers\Admin\ColorController::class, 'destroy']);

    // Brand Routes
    Route::get('brands/index', App\Http\Livewire\Admin\Brands\Index::class)->name('admin.brands.index');
    Route::get('brands/create', App\Http\Livewire\Admin\Brands\Create::class)->name('admin.brands.create');
    Route::get('brands/edit/{brand}', App\Http\Livewire\Admin\Brands\Edit::class)->name('admin.brands.edit');
});
