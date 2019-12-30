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

Route::prefix('leave')->group(function () {
    Route::get('/index', 'LeaveController@index')->name('admin.module.leave.index');
    Route::get('/wizard/{user?}', 'LeaveController@wizard')->name('admin.module.leave.wizard');
    Route::get('/wizard/edit/{id?}', 'LeaveController@edit')->name('admin.module.leave.edit');
    Route::post('/store', 'LeaveController@store')->name('admin.module.leave.store');
    Route::post('/update', 'LeaveController@update')->name('admin.module.leave.update');
    Route::get('/show', 'LeaveController@show')->name('admin.module.leave.show');
    Route::get('/delete/{id?}', 'LeaveController@delete')->name('admin.module.leave.delete');
    Route::get('/showleave', 'LeaveController@showleave')->name('admin.module.leave.show-leave');
    Route::get('/showadmin', 'LeaveController@showadmin')->name('admin.module.leave.show-admin');
    Route::get('/supervisor/true/{id?}', 'LeaveController@supervisorTrue')->name('admin.module.leave.supervisor.true');
    Route::get('/supervisor/false/{id?}', 'LeaveController@supervisorFalse')->name('admin.module.leave.supervisor.false');
    Route::get('/admin/true/{id?}', 'LeaveController@adminTrue')->name('admin.module.leave.admin.true');
    Route::get('/admin/false/{id?}', 'LeaveController@adminFalse')->name('admin.module.leave.admin.false');
    Route::get('/make', 'LeaveController@makeleave')->name('admin.module.leave.make-leave');
    Route::get('/make/admin', 'LeaveController@makeadmin')->name('admin.module.leave.make-admin');
    Route::get('/supervisor/list/{id?}', 'LeaveController@list')->name('admin.module.leave.supervisor.list');
    Route::get('/check', 'LeaveController@check')->name('admin.module.leave.check');
    Route::get('/make/supervisor', 'LeaveController@make')->name('admin.module.leave.make');
    Route::get('/save/{id?}', 'LeaveController@save')->name('admin.module.leave.save');

});
