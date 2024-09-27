<?php

use App\Http\Controllers\Auth\Client\DashboardAccountController;
use App\Http\Controllers\Auth\Client\LoginController;
use App\Http\Controllers\Auth\Client\RegisterController;
use App\Http\Controllers\Client\CartController;
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

Route::prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('login', [LoginController::class, 'showFormLogin'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('log');
        Route::get('register', [RegisterController::class, 'showFormReg'])->name('register');
        Route::post('register', [RegisterController::class, 'register'])->name('reg');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware(['auth.checkLog']);
    });
Route::prefix('dashboard')
    ->as('dashboard.')
    ->middleware(['auth.checkLog'])
    ->group(function () {
        Route::get('/', [DashboardAccountController::class, 'dashboardAccount'])->name('index');
        Route::get('listOrders', [DashboardAccountController::class, 'listOrders'])->name('listOrders');
        Route::get('{id}/detailOrder', [DashboardAccountController::class, 'detailOrder'])->name('detailOrder');
        Route::get('{id}/updateStatus', [DashboardAccountController::class, 'updateStatus'])->name('updateStatus');
    });

Route::prefix('shop')
    ->as('shop.')
    ->group(function () {
        Route::get('shopIndex', [ShopController::class, 'shopIndex'])->name(name: 'shopIndex');
        Route::get('detail/{slug}', [ShopController::class, 'productDetail'])->name('detail');
    });
Route::prefix('cart')
    ->as('cart.')
    ->group(function () {
        Route::get('shopCart', [CartController::class, 'shopCart'])->name('shopCart');
        Route::post('addCart', [CartController::class, 'addCart'])->name('addCart');
        Route::get('delOneCart/{slug}', [CartController::class, 'delOneCart'])->name('delOneCart');
        Route::get('checkoutCart', [CartController::class, 'checkoutCart'])->name('checkoutCart')->middleware(['auth.checkLog']);
        Route::post('saveOrder', [CartController::class, 'createOrder'])->name('saveOrder')->middleware(['auth.checkLog']);
    });