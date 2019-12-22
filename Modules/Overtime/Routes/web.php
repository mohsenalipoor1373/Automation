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

Route::prefix('overtime')->group(function () {
    Route::get('/index', 'OvertimeController@index')->name('admin.module.overtime.index');
    Route::get('/list', 'OvertimeController@list')->name('admin.module.overtime.list');
    Route::get('/admin', 'OvertimeController@admin')->name('admin.module.overtime.admin');
    Route::get('/wizard/{id?}', 'OvertimeController@wizard')->name('admin.module.overtime.wizard');
    Route::get('/show', 'OvertimeController@show')->name('admin.module.overtime.show');
    Route::get('/make', 'OvertimeController@make')->name('admin.module.overtime.make');
    Route::get('/success/{id?}', 'OvertimeController@success')->name('admin.module.overtime.success');
    Route::get('/error/{id?}', 'OvertimeController@error')->name('admin.module.overtime.error');
    Route::get('/check', 'OvertimeController@check')->name('admin.module.overtime.check');
    Route::post('/store', 'OvertimeController@store')->name('admin.module.overtime.store');
});
