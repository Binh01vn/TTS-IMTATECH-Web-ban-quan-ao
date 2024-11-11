<?php

use App\Http\Controllers\client\AjaxController;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\LoginController;
use App\Http\Controllers\client\OtherController;
use App\Http\Controllers\client\RegisterController;
use App\Http\Controllers\client\ShopController;
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
Route::get('/', [HomeController::class, 'index']);

Route::controller(ShopController::class)->prefix('shop')->as('shop.')->group(function () {
    Route::get('product-detail/{slug}', 'detail')->name('detail_sp');
    Route::post('review-product', 'review')->name('review_sp');
});
Route::controller(AjaxController::class)->prefix('ajax')->as('ajax.')->group(function () {
    Route::post('rend-variant', 'rendPrdV')->name('rendPrdV');
});
Route::prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('login', [LoginController::class, 'showFormLogin'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('log');
        Route::get('register', [RegisterController::class, 'showFormReg'])->name('register');
        Route::post('register', [RegisterController::class, 'register'])->name('reg');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware(['auth.checkLog']);
        // đăng nhập, đăng ký với tài khoản google
        Route::get('google', [LoginController::class, 'redirectToGoogle'])->name('google');
        Route::get('google/callback', [LoginController::class, 'handleGoogleCallback']);
    });
Route::controller(OtherController::class)->prefix('other-page')->as('other-page.')->group(function () {
    Route::get('about-us', 'AboutUs')->name('about_us');
    Route::get('contact-us', 'ContactUs')->name('contact_us');
});