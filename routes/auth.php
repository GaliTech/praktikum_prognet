<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisterController::class, 'showForm'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisterController::class, 'createUser'])
                ->middleware('guest');

Route::get('/user/login', [LoginController::class, 'showUserLoginForm'])
                ->name('login');

Route::post('/user/login', [LoginController::class, 'userLogin'])
                ->name('login.submit');

Route::get('/admin/login', [LoginController::class, 'showAdminLoginForm'])
                ->name('login.admin');

Route::post('/admin/login', [LoginController::class, 'adminLogin'])
                // ->middleware('auth:user')
                ->name('login.admin.submit');

                
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke']);
                // ->middleware('auth')
                // ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                // ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                // ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::get('/logout/user', [LogoutController::class, 'destroy'])
                ->middleware('auth:user')
                ->name('user.logout');

Route::get('/logout/admin', [LogoutController::class, 'destroyAdmin'])
                ->middleware('auth:admin')
                ->name('admin.logout');
