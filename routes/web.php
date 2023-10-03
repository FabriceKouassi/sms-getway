<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('/')->middleware('guest')
        ->group(function () {
            Route::controller(AuthController::class)
                ->group(function () {
                    Route::get('/', 'showLoginForm')->name('page.login');
                    Route::post('/', 'loginUser')->name('login');
                    Route::get('/register', 'showRegisterForm')->name('page.register');
                    Route::post('/register', 'registerUser')->name('register');
                });
        });

Route::prefix('admin_space')->middleware('auth')
        ->group(function () {
            Route::controller(AuthController::class)
                ->group(function () {
                    Route::get('/logout', 'logout')->name('logout');
                });
            Route::controller(DashboardController::class)
                ->group(function () {
                    Route::get('/dashboard', 'index')->name('dashboard');
                });
        });

