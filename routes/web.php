<?php

use App\Http\Controllers\Admin\AdminCatController;
use App\Http\Controllers\Admin\AdminColorController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminGeleryController;
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminSizeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Ayody\AyodyCartController;
use App\Http\Controllers\Ayody\AyodyCheckoutController;
use App\Http\Controllers\Ayody\AyodyContactController;
use App\Http\Controllers\Ayody\AyodyDetailController;
use App\Http\Controllers\Ayody\AyodyIndexController;
use App\Http\Controllers\Ayody\AyodyLoginController;
use App\Http\Controllers\Ayody\AyodyShopController;
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
Route::pattern('slug','(.*)');
Route::pattern('id','[0-9]*');
Route::get('/', function () {
    return view('welcome');
});
Route::prefix('/')->group(function(){
    Route::get('/',[AyodyIndexController::class,'index'])->name('ayody.index');
    Route::get('/thanh-toan',[AyodyCheckoutController::class,'checkout'])->name('ayody.checkout.checkout');
    Route::get('/lien-he',[AyodyContactController::class,'contact'])->name('ayody.contact.contact');
    Route::get('/gio-hang',[AyodyCartController::class,'cart'])->name('ayody.cart.cart');
    Route::get('/dang-nhap',[AyodyLoginController::class,'login'])->name('ayody.login.login');
    Route::prefix('/')->group(function(){
        Route::get('/{slug}-{id}',[AyodyDetailController::class,'shop'])->name('ayody.shop.shop');
        Route::get('/{slug}-{id}.html',[AyodyDetailController::class,'detail'])->name('ayody.detail.detail');
    });
    Route::prefix('/')->group(function(){
        // Route::get('/{slug}-{id}',[AyodyShopController::class,'shop'])->name('ayody.shop.shop');

    });
});
Route::prefix('/admin')->group(function(){
    Route::get('/',[AdminIndexController::class,'index'])->name('admin.index');
    // danh mục
    Route::prefix('/cat')->group(function(){
        Route::get('/',[AdminCatController::class,'index'])->name('admin.cat.index');
        Route::get('/add',[AdminCatController::class,'add'])->name('admin.cat.add');
        Route::post('/add',[AdminCatController::class,'postadd'])->name('admin.cat.postadd');
        Route::get('/edit/{id}',[AdminCatController::class,'edit'])->name('admin.cat.edit');
        Route::post('/edit/{id}',[AdminCatController::class,'postedit'])->name('admin.cat.postedit');
        Route::get('/del/{id}',[AdminCatController::class,'delete'])->name('admin.cat.delete');
    });
    //người dùng
    Route::prefix('/user')->group(function(){
        Route::get('/',[AdminUserController::class,'index'])->name('admin.user.index');
        Route::get('/add',[AdminUserController::class,'add'])->name('admin.user.add');
        Route::post('/add',[AdminUserController::class,'postadd'])->name('admin.user.postadd');
        Route::get('/edit/{id}',[AdminUserController::class,'edit'])->name('admin.user.edit');
        Route::post('/edit/{id}',[AdminUserController::class,'postedit'])->name('admin.user.postedit');
        Route::get('/del/{id}',[AdminUserController::class,'delete'])->name('admin.user.delete');
        Route::get('/active-ajax',[AdminUserController::class,'ativeajax'])->name('admin.user.active');
    });
    // sản phẩm
    Route::prefix('/product')->group(function(){
        Route::get('/',[AdminProductController::class,'index'])->name('admin.product.index');
        Route::get('/add',[AdminProductController::class,'add'])->name('admin.product.add');
        Route::post('/add',[AdminProductController::class,'postadd'])->name('admin.product.postadd');
        Route::get('/edit/{id}',[AdminProductController::class,'edit'])->name('admin.product.edit');
        Route::post('/edit/{id}',[AdminProductController::class,'postedit'])->name('admin.product.postedit');
        Route::get('/del/{id}',[AdminProductController::class,'delete'])->name('admin.product.delete');
    });
    Route::prefix('/contact')->group(function(){
        Route::get('/',[AdminContactController::class,'index'])->name('admin.contact.index');
        Route::get('/del/{id}',[AdminContactController::class,'delete'])->name('admin.contact.delete');
    });
    Route::prefix('/news')->group(function(){
        Route::get('/',[AdminNewsController::class,'index'])->name('admin.news.index');
        Route::get('/add',[AdminNewsController::class,'add'])->name('admin.news.add');
        Route::post('/add',[AdminNewsController::class,'postadd'])->name('admin.news.postadd');
        Route::get('/edit/{id}',[AdminNewsController::class,'edit'])->name('admin.news.edit');
        Route::post('/edit/{id}',[AdminNewsController::class,'postedit'])->name('admin.news.postedit');
        Route::get('/del/{id}',[AdminNewsController::class,'delete'])->name('admin.news.delete');
    });
    Route::prefix('/gelery')->group(function(){
        Route::get('/add/{id}',[AdminGeleryController::class,'add'])->name('admin.gelery.add');
        Route::post('/add/{id}',[AdminGeleryController::class,'postadd'])->name('admin.gelery.postadd');
        Route::post('/del/{id}',[AdminGeleryController::class,'delete'])->name('admin.gelery.delete');
    });
    Route::prefix('/color')->group(function(){
        Route::get('/add/{id}',[AdminColorController::class,'add'])->name('admin.color.add');
        Route::post('/add/{id}',[AdminColorController::class,'postadd'])->name('admin.color.postadd');
        Route::post('/del/{id}',[AdminColorController::class,'delete'])->name('admin.color.delete');
    });
    Route::prefix('/size')->group(function(){
        Route::get('/add/{id}',[AdminSizeController::class,'add'])->name('admin.size.add');
        Route::post('/add/{id}',[AdminSizeController::class,'postadd'])->name('admin.size.postadd');
        Route::post('/del/{id}',[AdminSizeController::class,'delete'])->name('admin.size.delete');
    });

});
