<?php

use App\Http\Controllers\admin\AjaxController;
use App\Http\Controllers\admin\AttributesController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\CouponsController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\TagsController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    // quản lý danh mục - phân loại sản phẩm
    Route::controller(CategoriesController::class)->prefix('categories')->as('categories.')->group(function () {
        Route::get('/', 'list')->name('danh_sach');
        // crud phân loại sản phẩm
        Route::post('add-phan-loai', 'phan_loai')->name('them_pl');
        Route::get('edit-pl/{slug}', 'edit_pl')->name('edit_pl');
        Route::put('update-pl/{slug}', 'update_pl')->name('update_pl');
        // crud danh mục sản phẩm
        Route::post('add-danh-muc', 'danh_muc')->name('them_dm');
        Route::get('edit-dm/{slug}', 'edit_dm')->name('edit_dm');
        Route::put('update-dm/{slug}', 'update_dm')->name('update_dm');
    });
    // quản lý sản phẩm
    Route::controller(ProductsController::class)->prefix('products')->as('products.')->group(function () {
        Route::get('/', 'index')->name('list_sp');
        Route::get('detail/{slug}', 'detail')->name('detail_sp');
        Route::get('show-form', 'showForm')->name('show_form');
        Route::post('store', 'store')->name('them_sp');
        Route::get('edit/{slug}', 'edit')->name('edit_sp');
        Route::put('update-sp/{product}', 'update')->name('update_sp');
        Route::delete('xoa-sp/{product}', 'destroy')->name('xoa_sp');
        // sản phẩm xóa mềm
        Route::get('listTrashed', 'trashed')->name('list_trashed');
        Route::get('restore-all', 'restoreAll')->name('restoreAll');
        Route::delete('forceDelProduct/{id}', 'forceDelProduct')->name('forceDelProduct');
        Route::get('restoreProduct/{id}', 'restoreProduct')->name('restoreProduct');
    });
    // quản lý thẻ
    Route::controller(TagsController::class)->prefix('tags')->as('tags.')->group(function () {
        Route::get('/', 'list')->name('list_tags');
        Route::post('add-tag', 'store')->name('them_tag');
        Route::delete('delete-tag/{tag}', 'delete')->name('xoa_tag');
    });
    // quản lý thuộc tính sản phẩm
    Route::controller(AttributesController::class)->prefix('attributes')->as('attributes.')->group(function () {
        Route::get('/', 'list')->name('list_tt');
        Route::post('them-attr-value', 'store')->name('them_attr_value');
        Route::delete('delete-color/{color}', 'deleteColor')->name('xoa_mau');
        Route::delete('delete-size/{size}', 'deleteSize')->name('xoa_kich_thuoc');
        Route::get('{attr}/edit', 'edit')->name('sua_tt');
        Route::post('{attr}/update', 'update')->name('cap_nhat_tt');
    });
    // quản lý mã khuyến mại
    Route::controller(CouponsController::class)->prefix('coupons')->as('coupons.')->group(function () {
        Route::get('/', 'index')->name('list_mkm');
        Route::get('add-coupon', 'add')->name('add_mkm');
        Route::post('store-coupon', 'store')->name('store_mkm');
        Route::get('detail-coupon/{id}', 'show')->name('detai_mkm');
        Route::get('edit-coupon/{id}', 'edit')->name('edit_mkm');
        Route::put('update-coupon/{coupon}', 'update')->name('update_mkm');
        Route::delete('delete-coupon/{coupon}', 'delete')->name('delete_mkm');
    });
    // route thực hiện các ajax
    Route::controller(AjaxController::class)->prefix('ajax')->as('ajax.')->group(function () {
        // ajax quản lý sản phẩm
        Route::get('rendCtg/{slug}', 'rendCtg')->name('rendCtg');
        Route::get('delTag/{idTag}/{idPRD}', 'delTag')->name('delTag');
        Route::get('{id}/delImg', 'delImg')->name('delImg');
        Route::get('xoa-variant/{id}', 'delVariant')->name('xoa_variant');
    });
});