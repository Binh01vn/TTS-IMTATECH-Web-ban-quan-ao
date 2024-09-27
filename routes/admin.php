<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')->middleware(['auth.checkAdmin'])->group(function () {
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
    // Route quan ly thuoc tinh san pham
    Route::prefix('attributes')
        ->as('attributes.')
        ->group(function () {
            Route::get('/', [AttributeController::class, 'listAttribute'])->name('list');
            Route::post('createAttrValues', [AttributeController::class, 'createAttrValues'])->name('create');
            Route::get('{id}/delValueC', [AttributeController::class, 'delValueC'])->name('delValueC');
            Route::get('{id}/delValueS', [AttributeController::class, 'delValueS'])->name('delValueS');
            Route::get('{attr}/edit', [AttributeController::class, 'showFormEdit'])->name('edit');
            Route::post('{attr}/update', [AttributeController::class, 'update'])->name('update');
        });
    // Route quan ly san pham
    Route::prefix('products')
        ->as('products.')
        ->group(function () {
            Route::get('/', [ProductController::class, 'listProduct'])->name('listPrd');
            Route::get('create', [ProductController::class, 'create'])->name('createPrd');
            Route::get('attrValue', [ProductController::class, 'getAttrValue'])->name('attrValue');
            Route::post('store', [ProductController::class, 'store'])->name('storePrd');
            Route::get('listProduct', [ProductController::class, 'list'])->name('list');
            Route::get('editProduct/{slug}', [ProductController::class, 'editProduct'])->name('editProduct');
            Route::put('updateProduct/{slug}', [ProductController::class, 'updateProduct'])->name('updateProduct');
            Route::get('{id}/delImageG', [ProductController::class, 'delImageG'])->name('delImageG');
            Route::get('{id}/delTag', [ProductController::class, 'delTag'])->name('delTag');
        });
    // Route quan ly tags
    Route::prefix('tags')
        ->as('tags.')
        ->group(function () {
            Route::get('/', [TagController::class, 'index'])->name('listTags');
            Route::post('create', [TagController::class, 'create'])->name('createTag');
            Route::get('{id}/destroy', [TagController::class, 'destroy'])->name('deleteTag');
        });
    Route::prefix('orders')
        ->as('orders.')
        ->group(function () {
            Route::get('listOrder', [OrderController::class, 'listOrder'])->name('list');
            Route::post('bulkActions', [OrderController::class, 'bulkActions'])->name('bulkActions');
            Route::get('{id}/orderDetail', [OrderController::class, 'orderDetail'])->name('detail');
        });
});
