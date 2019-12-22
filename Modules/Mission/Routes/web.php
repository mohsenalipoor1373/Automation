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

Route::prefix('mission')->group(function () {
    Route::get('index', 'MissionController@index')->name('admin.module.mission.index');
    Route::post('store', 'MissionController@store')->name('admin.module.mission.store');
    Route::get('wizard/{id?}', 'MissionController@wizard')->name('admin.module.mission.wizard');
    Route::get('list', 'MissionController@list')->name('admin.module.mission.list');
    Route::get('stores', 'MissionController@stores')->name('admin.module.mission.stores');
    Route::get('supervsior', 'MissionController@shows')->name('admin.module.mission.show-supervsior');
    Route::get('admin', 'MissionController@showadmin')->name('admin.module.mission.show-admin');
    Route::get('admin/make', 'MissionController@makeadmin')->name('admin.module.mission.make-admin');
    Route::get('supervsior/make', 'MissionController@makes')->name('admin.module.mission.make-supervsior');
    Route::get('super-success/{id?}', 'MissionController@supersuccess')->name('admin.module.mission.super.success');
    Route::get('super-error/{id?}', 'MissionController@supererror')->name('admin.module.mission.super.error');
    Route::get('admin-success/{id?}', 'MissionController@adminsuccess')->name('admin.module.mission.admin.success');
    Route::get('admin-error/{id?}', 'MissionController@adminerror')->name('admin.module.mission.admin.error');
    Route::get('edit/{id?}', 'MissionController@edit')->name('admin.module.mission.edit');
    Route::get('delete/{id?}', 'MissionController@delete')->name('admin.module.mission.delete');
    Route::post('update', 'MissionController@update')->name('admin.module.mission.update');
});
