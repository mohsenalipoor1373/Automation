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
    Route::get('list', 'FishController@list')->name('admin.module.fish.list');
    Route::get('details', 'FishController@details')->name('admin.module.fish.details');
    Route::get('make', 'FishController@make')->name('admin.module.fish.make');
    Route::get('makea', 'FishController@makea')->name('admin.module.fish.makea');
    Route::post('datestore', 'FishController@datestore')->name('admin.module.fish.date.store');
    Route::get('showdate/{id?}', 'FishController@showdate')->name('admin.module.fish.date.show');
    Route::get('success/{id?}', 'FishController@success')->name('admin.module.fish.admin.success');
    Route::get('error/{id?}', 'FishController@error')->name('admin.module.fish.admin.error');
});
