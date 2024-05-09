<?php

use Illuminate\Support\Facades\Route;




Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard',[App\Http\Controllers\Backend\IndexController::class, 'dashboard'])->name('dashboard');
    Route::get('logout',[App\Http\Controllers\Backend\IndexController::class, 'userLogout'])->name('user.logout');

    Route::post('product/store',[App\Http\Controllers\Backend\IndexController::class, 'productStore'])->name('product.store');
    Route::get('all/product',[App\Http\Controllers\Backend\IndexController::class, 'allProduct'])->name('all.product');
    Route::get('product/edit/{id}',[App\Http\Controllers\Backend\IndexController::class, 'editProduct'])->name('edit.product');
    Route::post('product/update/{id}',[App\Http\Controllers\Backend\IndexController::class, 'updateProduct'])->name('update.product');
    Route::get('product/delete/{id}',[App\Http\Controllers\Backend\IndexController::class, 'deleteProduct'])->name('delete.product');

    Route::get('attribute/view/{id}',[App\Http\Controllers\Backend\AttributeController::class, 'attributeView'])->name('attribute.view');
    Route::post('attribute/store',[App\Http\Controllers\Backend\AttributeController::class, 'attributeStore'])->name('attribute.store');
    Route::get('attribute/edit/{id}/{product_id}',[App\Http\Controllers\Backend\AttributeController::class, 'attributeEdit'])->name('attribute.edit');
    Route::post('attribute/update/{id}',[App\Http\Controllers\Backend\AttributeController::class, 'attributeUpdate'])->name('attribute.update');
    Route::get('attribute/delete/{id}',[App\Http\Controllers\Backend\AttributeController::class, 'attributeDelete'])->name('attribute.delete');
});



