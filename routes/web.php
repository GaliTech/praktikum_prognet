<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeDetailController;
use App\Http\Controllers\HomeController;
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


Route::get('/', 'App\Http\Controllers\HomeDetailController@index');

Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/user', 'App\Http\Controllers\HomeController@index');
    Route::get('/keranjang', 'App\Http\Controllers\HomeDetailController@keranjang')->name('belanja');
    Route::post('review/{id}', 'App\Http\Controllers\HomeDetailController@review_product')->name('review');
    Route::get('/detail_produk/{id}', 'App\Http\Controllers\HomeDetailController@detail_product')->name('detail_produk');
});

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth:admin'], function () {
    //List Route untuk CRUD Admin
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
    // ->middleware('auth:admin');
    Route::resource('/product','App\Http\Controllers\ProductController');
    // ->middleware('auth:admin');
    Route::resource('/product-category','App\Http\Controllers\ProductCategoriesController');
    // ->middleware('auth:admin');
    Route::resource('/courier','App\Http\Controllers\CourierController');
    // ->middleware('auth:admin');
    Route::resource('/discount', 'App\Http\Controllers\DiscountController');
    // ->middleware('auth:admin');
    //halaman edit gambar produk
    Route::get('/gambar/{id}/create','App\Http\Controllers\ProductController@createGambar');
    // ->middleware('auth:admin');
    Route::get('/gambar/{id}','App\Http\Controllers\ProductController@editGambar');
    // ->middleware('auth:admin');
    Route::post('/gambar/{id}/store','App\Http\Controllers\ProductController@storeGambar');
    // ->middleware('auth:admin');
    Route::delete('/gambar/{gambar:id}/destroy','App\Http\Controllers\ProductController@hapusGambar');
    // ->middleware('auth:admin');
    //metode untuk meng-update gambar produk
    Route::match(['put', 'patch'],'/gambar/{id}/update', 'App\Http\Controllers\ProductController@updateGambar');
    // ->middleware('auth:admin');
});

//List Route Modul 3
Route::get('/cart', 'App\Http\Controllers\CartsController@index')->name('cart')->middleware('auth:user');
Route::post('/cart/add', 'App\Http\Controllers\CartsController@store')->name('cart.tambah')->middleware('auth:user');
Route::post('/cart/checkout', 'App\Http\Controllers\CartsController@checkout')->name('cart.checkout')->middleware('auth:user');
Route::get('/checkout', 'App\Http\Controllers\TransactionsController@index')->name('checkout')->middleware('auth:user');
Route::get('/cart/{id}', 'App\Http\Controllers\CartsController@destroy')->name('cart.delete')->middleware('auth:user');
Route::get('/provinsi/{id}/kota', 'App\Http\Controllers\TransactionsController@getKota');
Route::post('/checkout/confirm', 'App\Http\Controllers\TransactionsController@getCost')->name('checkout.confirm')->middleware('auth:user');

//Order
Route::get('/myorder', 'App\Http\Controllers\TransactionsController@myOrder')->name('myorder')->middleware('auth:user');
Route::post('/store', 'App\Http\Controllers\TransactionsController@storePayment')->name('order.payment')->middleware('auth:user');
Route::put('/cancel/{id}', 'App\Http\Controllers\TransactionsController@orderCancel')->name('order.cancel')->middleware('auth:user');
Route::put('/timeout/{id}', 'App\Http\Controllers\TransactionsController@orderTimeout')->name('order.timeout');

//Transaction
Route::get('/transaction', 'App\Http\Controllers\TransactionsController@adminIndex')->name('transactions')->middleware('auth:admin');
Route::get('/transaction/detail/{id}', 'App\Http\Controllers\TransactionsController@transactionDetails')->name('transactions.detail')->middleware('auth:admin');
Route::put('/approve/{id}', 'App\Http\Controllers\TransactionsController@approve')->name('transactions.approve')->middleware('auth:admin');
Route::put('/delivered/{id}', 'App\Http\Controllers\TransactionsController@delivered')->name('transactions.delivered')->middleware('auth:admin');
Route::put('/canceled/{id}', 'App\Http\Controllers\TransactionsController@canceled')->name('transactions.canceled')->middleware('auth:admin');
Route::put('/expired/{id}', 'App\Http\Controllers\TransactionsController@expired')->name('transactions.expired')->middleware('auth:admin');

Route::put('/success/{id}', 'App\Http\Controllers\TransactionsController@orderSuccess')->name('user.success')->middleware('auth:user');

//Response Review
Route::get('/review', 'App\Http\Controllers\ResponseController@index')->name('admin.review')->middleware('auth:admin');
Route::post('/response', 'App\Http\Controllers\ResponseController@store')->name('admin.response')->middleware('auth:admin');
Route::put('/response/edit/{id}', 'App\Http\Controllers\ResponseController@update')->name('edit.response')->middleware('auth:admin');
Route::delete('/delete/{id}', 'App\Http\Controllers\ResponseController@destroy')->name('delete.response')->middleware('auth:admin');

//Notifications
Route::get('notif/user/{id}', 'App\Http\Controllers\HomeDetailController@notif')->name('user.notification')->middleware('auth:user');
Route::get('notif/admin/{id}', 'App\Http\Controllers\ResponseController@notif')->name('admin.notification')->middleware('auth:admin');
