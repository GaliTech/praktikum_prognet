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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/admin', [LoginController::class,'showAdminLoginForm']);
Route::get('/login/user', [LoginController::class,'showUserLoginForm']);
Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);
Route::get('/register/user', [RegisterController::class,'showUserRegisterForm']);

Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::post('/login/user', [LoginController::class,'userLogin']);
Route::post('/register/admin', [RegisterController::class,'createAdmin']);
Route::post('/register/user', [RegisterController::class,'createUser']);

Route::group(['middleware' => 'auth:user'], function () {
    Route::view('/user', 'user');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
});

Route::get('logout', [LoginController::class,'logout']);
Auth::routes();

Route::get('/home-user', [App\Http\Controllers\HomeController::class, 'user'])->name('home');
Route::get('/home-admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('home');
