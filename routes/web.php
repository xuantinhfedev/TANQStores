<?php

use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignInController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\xemChiTietController;
use App\Http\Controllers\XemDanhMucController;
use App\Http\Controllers\XemTheLoaiController;
use App\Http\Controllers\ThongTinCaNhanController;
use App\Http\Controllers\ThanhToanController;
use App\Http\Controllers\ThongKeController;

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

Route::prefix('/')->group(function(){
    Route::get('/', [homeController::class, 'home'])->name('home');
    Route::get('/DangNhap', [homeController::class, 'register'])->name('DangNhap');
    Route::get('/DangKy', [homeController::class, 'signin'])->name('DangKy');
    Route::get('/GioHang', [GioHangController::class, 'index'])->name('giohang');
    Route::get('/LogInAdmin', function () {
        return view('LogInAdmin');
    });
    Route::get('/delete/{id}', [OrdersController::class, 'deleteUser'])->name('deleteUser');
    Route::get('/deleteUserLogin/{id}', [OrdersController::class, 'deleteUserLogin'])->name('deleteUserLogin');
    Route::get('/ThongBao', [homeController::class, 'notification'])->name('ThongBao');
    Route::get('/KTDonHang', [homeController::class, 'KTDonHang'])->name('KTDonHang');
    Route::get('/KTDH', [OrdersController::class, 'detailView'])->name('KTDH');
    Route::get('/CTDH/{id}', [OrdersController::class, 'detailUserView'])->name('CTDH');
    Route::get('/KTDHview', [OrdersController::class, 'checkdetailView'])->name('KTDHview');
    Route::get('/XepHangThanhVien', [OrdersController::class, 'XepHangThanhVien'])->name('XepHangThanhVien');
    Route::post('/DangKyinfo',[SignInController::class,'checkinfo']);
    Route::get('/Products/ChiTiet/{id}', [SanPhamController::class, 'ChiTiet'])->name('chitiet');
    Route::get('/search-products', [ProductsController::class, 'search'])->name('search-products');
    Route::get('/checkout',[SignInController::class, 'checkout'])->name('checkout');
    route::get('/test', [homeController::class, 'test'])->name('test');
    Route::post('getsl', [SanPhamController::class, 'GetSL'])->name('getSL');
    route::post('/ThemGH', [GioHangController::class, 'addToCart'])->name('ThemGH');
    route::post('/XoaGH', [GioHangController::class, 'remove'])->name('XoaGH');
    route::post('/SuaGH', [GioHangController::class, 'update'])->name('SuaGH');
    Route::post('/LocDM', [XemDanhMucController::class, 'LocDanhMuc'])->name('LocDM');
    Route::post("/DangNhap/Auth",[LoginController::class , 'LoginAuth']);
    Route::post("/DangNhap/Admin",[LoginController::class , 'LoginAdmin'])->name('LoginAdmin');
});

// Route::get('/adminsite', function () {
//     return view('adminsite');
// });
Route::get('/checkoutAdmin',[SignInController::class, 'checkoutadmin'])->name('checkoutadmin');

Route::prefix('XemTheLoai')->name('XemTheLoai.')->group(function(){
    Route::get('/{id}',[XemTheLoaiController::class,'getSP_TheLoai'])->name('index');
});
Route::prefix('XemDanhMuc')->name('XemDanhMuc.')->group(function(){
    Route::get('/{id}',[XemDanhMucController::class,'goToXemDanhMuc'])->name('index');
});
Route::prefix('xemChiTiet')->name('xemChiTiet.')->group(function(){
    Route::get('/{id}',[xemChiTietController::class,'goToXemChiTiet'])->name('index');
});
Route::prefix('ThongTinCaNhan')->name('ThongTinCaNhan.')->group(function(){
    Route::get('/',[ThongTinCaNhanController::class,'goToThongTinCaNhan'])->name('index');
    Route::get('/Form_sua',[ThongTinCaNhanController::class,'formSua'])->name('suaThongTin');
    Route::post('/Form_sua',[ThongTinCaNhanController::class,'postSua'])->name('post_suaThongTin');
});
Route::prefix('ThanhToan')->name('ThanhToan.')->group(function(){
    Route::get('/',[ThanhToanController::class,'goToThanhToan'])->name('index');
    Route::get('/DHN',[ThanhToanController::class,'DatHangNgay'])->name('DHN');
    Route::post('/',[ThanhToanController::class,'insertDH'])->name('postHD');
});

Route::middleware('checkadmin')->prefix('/adminsite')->group(function () {
    Route::get('/', function(){
        return view('admin.adminsite');
    })->name('adminsite');

    Route::prefix('/user')->name('users.')->group(function(){
        Route::get('/', [UsersController::class, 'index'])->name('index');

        Route::get('/add', [UsersController::class, 'add'])->name('add');

        Route::post('/add', [UsersController::class, 'handleAdd'])->name('post-add');

        Route::get('/edit/{id}', [UsersController::class, 'getEdit'])->name('edit');

        Route::post('/update', [UsersController::class, 'handleEdit'])->name('post-edit');

        Route::get('/delete/{id}', [UsersController::class, 'delete'])->name('delete');
    });

    Route::prefix('/product')->name('products.')->group(function(){
        Route::get('/', [ProductsController::class, 'index'])->name('index');

        Route::get('/add', [ProductsController::class, 'add'])->name('add');

        Route::post('/add', [ProductsController::class, 'handleAdd'])->name('post-add');

        Route::get('/edit/{id}', [ProductsController::class, 'getEdit'])->name('edit');

        Route::post('/update', [ProductsController::class, 'handleEdit'])->name('post-edit');

        Route::get('/delete/{id}', [ProductsController::class, 'delete'])->name('delete');

        Route::prefix('/detail')->name('details.')->group(function(){
            Route::get('/{id}', [DetailProductController::class, 'index'])->name('index');

            Route::get('/{id}/add', [DetailProductController::class, 'add'])->name('add');

            Route::post('/{id}/add', [DetailProductController::class, 'handleAdd'])->name('post-add');

            Route::get('/{id}/edit/{detailID}', [DetailProductController::class, 'getEdit'])->name('edit');

            Route::post('/{id}/update', [DetailProductController::class, 'handleEdit'])->name('post-edit');

            Route::get('/{id}/delete/{detailID}', [DetailProductController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('/danhmuc')->name('danhmuc.')->group(function(){
        Route::get('/', [DanhMucController::class, 'index'])->name('index');

        Route::get('/add', [DanhMucController::class, 'add'])->name('add');

        Route::post('/add', [DanhMucController::class, 'handleAdd'])->name('post-add');

        Route::get('/edit/{id}', [DanhMucController::class, 'getEdit'])->name('edit');

        Route::post('/update', [DanhMucController::class, 'handleEdit'])->name('post-edit');

        Route::get('/delete/{id}', [DanhMucController::class, 'delete'])->name('delete');
    });

    Route::prefix('/theloai')->name('theloai.')->group(function(){
        Route::get('/', [TheLoaiController::class, 'index'])->name('index');

        Route::get('/add', [TheLoaiController::class, 'add'])->name('add');

        Route::post('/add', [TheLoaiController::class, 'handleAdd'])->name('post-add');

        Route::get('/edit/{id}', [TheLoaiController::class, 'getEdit'])->name('edit');

        Route::post('/update', [TheLoaiController::class, 'handleEdit'])->name('post-edit');

        Route::get('/delete/{id}', [TheLoaiController::class, 'delete'])->name('delete');
    });

    Route::prefix('/order')->name('orders.')->group(function(){
        Route::get('/', [OrdersController::class, 'index'])->name('index');

        Route::get('/detail/{id}', [OrdersController::class, 'detail'])->name('detail');

        Route::post('/update', [OrdersController::class, 'update'])->name('post-edit');

        Route::get('/delete/{id}', [OrdersController::class, 'delete'])->name('delete');
    });

    Route::get('/thongke', [ThongKeController::class, 'index'])->name('thongke');
});

