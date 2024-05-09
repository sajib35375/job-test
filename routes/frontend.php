<?php

use Illuminate\Support\Facades\Route;




Route::get('/',[App\Http\Controllers\Frontend\IndexController::class, 'index'])->name('frontend.index');
Route::get('modal/data/show/{id}',[App\Http\Controllers\Frontend\IndexController::class, 'modalDataShow'])->name('modal.data.show');
Route::post('modal/data/get',[App\Http\Controllers\Frontend\IndexController::class, 'modalDataGet'])->name('modal.data.get');

Route::get('change/color/{id}',[App\Http\Controllers\Frontend\IndexController::class,'changeColor'])->name('change.color');

Route::post('order/store',[App\Http\Controllers\Frontend\IndexController::class, 'orderStore'])->name('order.store');
Route::get('cart/delete/{rowId}',[App\Http\Controllers\Frontend\IndexController::class, 'cartDelete'])->name('cart.delete');

Route::post('search/product',[App\Http\Controllers\Frontend\IndexController::class, 'searchProduct'])->name('search.product');
