<?php

use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('home');
});

Route::group(['middleware' => 'auth:user'], function () {
    Route::view('/user', 'beranda');
});

Route::group(['middleware' => 'auth:admin'], function () {
    
    Route::view('/admin', 'template.admin_master');
});

require __DIR__.'/auth.php';



//List Route untuk CRUD Admin
Route::resource('/product','App\Http\Controllers\ProductController')->middleware('auth:admin');;
Route::resource('/product-category','App\Http\Controllers\ProductCategoriesController')->middleware('auth:admin');;
Route::resource('/courier','App\Http\Controllers\CourierController')->middleware('auth:admin');;
Route::resource('/discount', 'App\Http\Controllers\DiscountController')->middleware('auth:admin');;
//halaman edit gambar produk
Route::get('/gambar/{id}/create','App\Http\Controllers\ProductController@createGambar')->middleware('auth:admin');;
Route::get('/gambar/{id}','App\Http\Controllers\ProductController@editGambar')->middleware('auth:admin');;
Route::post('/gambar/{id}/store','App\Http\Controllers\ProductController@storeGambar')->middleware('auth:admin');;
Route::delete('/gambar/{gambar:id}/destroy','App\Http\Controllers\ProductController@hapusGambar')->middleware('auth:admin');;
//metode untuk meng-update gambar produk
Route::match(['put', 'patch'],'/gambar/{id}/update', 'App\Http\Controllers\ProductController@updateGambar')->middleware('auth:admin');;







//lawas

// Route::prefix('user')->group(function(){
//     // Route::get('/', 'AdminController@index')->name('admin.dashboard');
//     Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showUserLoginForm')->name('user.login');
//     Route::post('/login', 'App\Http\Controllers\Auth\LoginController@userLogin')->name('user.login.submit');
//     Route::get('/dashboard', 'App\Http\Controllers\UserController@index')->name('user.dashboard')->middleware('auth:user');
//     Route::get('/home', 'App\Http\Controllers\Auth\UserLogoutController@logout')->name('user.logout');
//     Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showUserRegisterForm')->name('user.register');
//     Route::post('/register','App\Http\Controllers\Auth\RegisterController@createUser')->name('user.register.submit');

//     Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('user.password.request');
//     Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
//     Route::get('/password/reset{token}','Auth\AdminResetPasswordController@showResetForm')->name('user.password.reset');
//     Route::post('/password/reset','Auth\AdminResetPasswordController@reset')->name('user.password.update');
// });

// Route::prefix('admin')->group(function(){
//     // Route::get('/', 'AdminController@index')->name('admin.dashboard');
//     Route::get('/login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('admin.login');
//     Route::post('/login/admin', 'App\Http\Controllers\Auth\LoginController@adminLogin')->name('admin.login.submit');
//     Route::get('/dashboard', 'App\Http\Controllers\AdminController@index')->name('admin.dashboard')->middleware('auth:admin');
//     Route::get('/logout/admin', 'App\Http\Controllers\Auth\AdminLogoutController@logout')->name('admin.logout');
//     // Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
//     // Route::post('/register','Auth\AdminRegisterController@register')->name('admin.register.submit');

//     Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
//     Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
//     Route::get('/password/reset{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
//     Route::post('/password/reset','Auth\AdminResetPasswordController@reset')->name('admin.password.update');
// });

// Route::get('/', function () {
//     return view('home');
// });
