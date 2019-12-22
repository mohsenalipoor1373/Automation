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

Route::prefix('fish')->group(function() {
    Route::get('index', 'FishController@index')->name('admin.module.fish.index');
    Route::post('store', 'FishController@store')->name('admin.module.fish.store');
    Route::get('list', 'FishController@list')->name('admin.module.fish.list');
});
