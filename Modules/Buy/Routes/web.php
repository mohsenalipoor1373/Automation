<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('buy')->group(function () {
    Route::get('index', 'BuyController@index')->name('admin.module.buy.index');
    Route::get('list', 'BuyController@list')->name('admin.module.buy.list');
    Route::get('super/success/{id?}', 'BuyController@supers')->name('admin.module.buy.super.success');
    Route::get('admin/success/{id?}', 'BuyController@admins')->name('admin.module.buy.admin.success');
    Route::get('super/error/{id?}', 'BuyController@errors')->name('admin.module.buy.super.error');
    Route::get('admin/error/{id?}', 'BuyController@admine')->name('admin.module.buy.admin.error');
    Route::get('supervsior', 'BuyController@shows')->name('admin.module.buy.show-supervsior');
    Route::get('make', 'BuyController@make')->name('admin.module.buy.make-supervsior');
    Route::get('makeadmin', 'BuyController@makeadmin')->name('admin.module.buy.make-admin');
    Route::get('showadmin', 'BuyController@showadmin')->name('admin.module.buy.show-admin');
    Route::get('stores', 'BuyController@stores')->name('admin.module.buy.stores');
    Route::post('store', 'BuyController@store')->name('admin.module.buy.store');
});
