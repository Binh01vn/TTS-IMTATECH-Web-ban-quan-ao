<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.contents.dashboard.main');
    })->name('dashboard');
    // route quan ly danh muc san pham
    Route::prefix('categories')
        ->as('categories.')
        ->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('listDM');
            Route::post('store', [CategoryController::class, 'store'])->name('storeDM');
            Route::get('edit/{slug}', [CategoryController::class, 'edit'])->name('editDM');
            Route::put('update/{slug}', [CategoryController::class, 'update'])->name('updateDM');
            Route::get('delete/{slug}', [CategoryController::class, 'destroy'])->name('deleteDM');
        });
    // Route quan ly thuoc tinh san pham bien the
    Route::prefix('attributes')
        ->as('attributes.')
        ->group(function () {
            Route::get('/', [AttributeController::class, 'listAttributes'])->name('listAttr');
            Route::post('store', [AttributeController::class, 'store'])->name('storeAttr');
            Route::get('{id}/delete', [AttributeController::class, 'destroy'])->name('destroyAttr');
            Route::get('{id}/edit', [AttributeController::class, 'edit'])->name('editAttr');
        });
    // Route quan ly san pham
    Route::prefix('products')
        ->as('products.')
        ->group(function () {
            Route::get('/', [ProductController::class, 'listProduct'])->name('listPrd');
            Route::get('create', [ProductController::class, 'create'])->name('createPrd');
            Route::post('store', [ProductController::class, 'store'])->name('storePrd');
        });
});
