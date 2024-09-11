<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
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
    // Route quan ly thuoc tinh san pham
    Route::prefix('attributes')
        ->as('attributes.')
        ->group(function () {
            Route::get('/', [AttributeController::class, 'listAttributes'])->name('listAttr');
            Route::post('store', [AttributeController::class, 'store'])->name('storeAttr');
            Route::get('{id}/delete', [AttributeController::class, 'destroy'])->name('destroyAttr');
            Route::get('{id}/edit', [AttributeController::class, 'edit'])->name('editAttr');
            Route::get('{id}/deleteV', [AttributeController::class, 'delete'])->name('delValueAttr');
            Route::post('{id}/add-create', [AttributeController::class, 'addOrCreate'])->name('addOrCreate');
        });
    // Route quan ly san pham
    Route::prefix('products')
        ->as('products.')
        ->group(function () {
            Route::get('/', [ProductController::class, 'listProduct'])->name('listPrd');
            Route::get('create', [ProductController::class, 'create'])->name('createPrd');
            Route::get('attrValue', [ProductController::class, 'getAttrValue'])->name('attrValue');
            Route::post('variantPrd', [ProductController::class, 'variantPrd'])->name('variantPrd');
            Route::post('store', [ProductController::class, 'store'])->name('storePrd');
        });
    // Route quan ly tags
    Route::prefix('tags')
        ->as('tags.')
        ->group(function () {
            Route::get('/', [TagController::class, 'index'])->name('listTags');
            Route::post('create', [TagController::class, 'create'])->name('createTag');
            Route::get('{id}/destroy', [TagController::class, 'destroy'])->name('deleteTag');
        });
});
