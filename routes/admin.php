<?php

use App\Http\Controllers\Admin\CategoryController;
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

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.contents.dashboard.main');
    })->name('dashboard');
    // route quan ly danh muc san pham
    Route::prefix('categories')
        ->as('categories.')
        ->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('listDM');
            Route::get('create', [CategoryController::class, 'create'])->name('createDM');
            Route::post('store', [CategoryController::class, 'store'])->name('storeDM');
            Route::get('edit/{slug}', [CategoryController::class, 'edit'])->name('editDM');
            Route::put('update/{slug}', [CategoryController::class, 'update'])->name('updateDM');
            Route::get('delete/{slug}', [CategoryController::class, 'destroy'])->name('deleteDM');
        });
});
