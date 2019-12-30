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

Route::prefix('cage')->group(function () {
    Route::get('index', 'CageController@index')->name('admin.module.cage.index');
    Route::post('store', 'CageController@store')->name('admin.module.cage.store');
    Route::post('datestore', 'CageController@datestore')->name('admin.module.cage.date.store');
    Route::post('update', 'CageController@update')->name('admin.module.cage.update');
    Route::get('success/{id?}', 'CageController@success')->name('admin.module.cage.admin.success');
    Route::get('error/{id?}', 'CageController@error')->name('admin.module.cage.admin.error');
    Route::get('list', 'CageController@list')->name('admin.module.cage.list');
    Route::get('date/{id?}', 'CageController@date')->name('admin.module.cage.admin.date');
    Route::get('showadmin', 'CageController@showadmin')->name('admin.module.cage.show-admin');
    Route::get('make', 'CageController@make')->name('admin.module.cage.make-admin');
    Route::get('makeadmin', 'CageController@makeadmin')->name('admin.module.cage.makeadm');
    Route::get('save/{id?}', 'CageController@save')->name('admin.module.buy.save');
    Route::get('edit/{id?}', 'CageController@edit')->name('admin.module.buy.edit');
    Route::get('delete/{id?}', 'CageController@delete')->name('admin.module.buy.delete');
});
