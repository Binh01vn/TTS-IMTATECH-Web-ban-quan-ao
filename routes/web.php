<?php

use App\Http\Controllers\Auth\Client\DashboardAccountController;
use App\Http\Controllers\Auth\Client\LoginController;
use App\Http\Controllers\Auth\Client\RegisterController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ShopController;
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

// Route::get('/', function () {
//     return view('client.contents-main.home.home-content');
// });

Route::get('/', [HomeController::class, 'shopHome'])->name('shopHome');
Route::get('prdModal', [HomeController::class, 'prdModal'])->name('modal');

Route::prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('login', [LoginController::class, 'showFormLogin'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('log');
        Route::get('register', [RegisterController::class, 'showFormReg'])->name('register');
        Route::post('register', [RegisterController::class, 'register'])->name('reg');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });

Route::prefix('dashboard')
    ->as('dashboard.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [DashboardAccountController::class, 'dashboardAccount'])->name('index');
    });

Route::prefix('shop')
    ->as('shop.')
    ->group(function () {
        Route::get('shopIndex', [ShopController::class, 'shopIndex'])->name(name: 'shopIndex');
        Route::get('detail/{slug}', [ShopController::class, 'productDetail'])->name('detail');
        Route::post('addCart', [ShopController::class, 'addCart'])->name('addCart');
    });