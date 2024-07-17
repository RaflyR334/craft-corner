<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\UserController;


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route Admin Atau Backend
// Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function (){
//     Route::get('/', function (){
//         return view('admin.index');
//     });
// });

Route::group(['prefix'=>'admin', 'middleware'=>['auth',IsAdmin::class]], function (){
    Route::get('/',function(){
        return view('admin.indexadmin');
    });

    // Route Lainnya ....
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::resource('kategori', App\Http\Controllers\KategoriController::class);
    Route::resource('produk', App\Http\Controllers\ProdukController::class);
});


// Route Frontend(depan)
Route::get('/', [FrontController::class, 'index']);
Route::get('shop',[FrontController::class, 'shop']);
Route::get('produk/{id}',[FrontController::class, 'show']);
Route::get('cart',[FrontController::class, 'index']);

Route::post('cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::delete('cart/clear', [CartController::class, 'clear'])->name('cart.clear');
// Route::get('detailpro',[FrontController::class, 'detailpro']);
// Route::get('compaire',[FrontController::class, 'compaire']);
// Route::get('wishlist',[FrontController::class, 'wishlist']);
// Route::get('userd',[FrontController::class, 'userd']);
