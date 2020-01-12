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

Route::prefix('fish')->group(function () {
    Route::get('index', 'FishController@index')->name('admin.module.fish.index');
    Route::post('store', 'FishController@store')->name('admin.module.fish.store');
    Route::post('update', 'FishController@update')->name('admin.module.fish.update');
    Route::get('list', 'FishController@list')->name('admin.module.fish.list');
    Route::get('details', 'FishController@details')->name('admin.module.fish.details');
    Route::get('make', 'FishController@make')->name('admin.module.fish.make');
    Route::get('makes', 'FishController@makes')->name('admin.module.fish.makes');
    Route::get('makea', 'FishController@makea')->name('admin.module.fish.makea');
    Route::post('datestore', 'FishController@datestore')->name('admin.module.fish.date.store');
    Route::get('showdate/{id?}', 'FishController@showdate')->name('admin.module.fish.date.show');
    Route::get('success/{id?}', 'FishController@success')->name('admin.module.fish.admin.success');
    Route::get('error/{id?}', 'FishController@error')->name('admin.module.fish.admin.error');
    Route::get('save/{id?}', 'FishController@save')->name('admin.module.fish.save');
    Route::get('edit/{id?}', 'FishController@edit')->name('admin.module.fish.edit');
    Route::get('delete/{id?}', 'FishController@delete')->name('admin.module.fish.delete');

    Route::get('m/success/{id?}', 'FishController@msuccess')->name('admin.module.fishm.admin.success');
    Route::get('makes/m', 'FishController@mmakes')->name('admin.module.fish.makes.m');
    Route::get('off/{id?}', 'FishController@off')->name('admin.module.fish.off');
    Route::get('buym', 'FishController@buym')->name('admin.module.fish.makes.buym');
    Route::get('buysuccess/{id?}', 'FishController@buysuccess')->name('admin.module.fishm.admin.buysuccess');



});
