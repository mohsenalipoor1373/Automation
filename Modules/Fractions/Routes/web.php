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

Route::prefix('fractions')->group(function () {
    Route::get('/index', 'FractionsController@index')->name('admin.module.fractions.index');
    Route::get('/wizard/{user?}', 'FractionsController@wizard')->name('admin.module.fractions.wizard');
    Route::post('/store', 'FractionsController@store')->name('admin.module.fractions.store');
    Route::post('/update', 'FractionsController@update')->name('admin.module.fractions.update');
    Route::get('/show', 'FractionsController@show')->name('admin.module.fractions.show');
    Route::get('/make', 'FractionsController@make')->name('admin.module.fractions.make');
    Route::get('/showfraction', 'FractionsController@showfraction')->name('admin.module.fractions.show-fraction');
    Route::get('/fractions/true/{id?}', 'FractionsController@supervisorTrue')->name('admin.module.fractions.supervisor.true');
    Route::get('/fractions/false/{id?}', 'FractionsController@supervisorFalse')->name('admin.module.fractions.supervisor.false');
    Route::get('/makefraction', 'FractionsController@makefraction')->name('admin.module.fractions.make-fraction');
    Route::get('/showadmin', 'FractionsController@showadmin')->name('admin.module.fractions.show-admin');
    Route::get('/admin/true/{id?}', 'FractionsController@adminTrue')->name('admin.module.fractions.admin.true');
    Route::get('/admin/false/{id?}', 'FractionsController@adminFalse')->name('admin.module.fractions.admin.false');
    Route::get('/supervisor/list/{id?}', 'FractionsController@list')->name('admin.module.fractions.supervisor.list');
    Route::get('/make/admin', 'FractionsController@makeadmin')->name('admin.module.fractions.make-admin');
    Route::get('/delete/{id?}', 'FractionsController@delete')->name('admin.module.fraction.delete');
    Route::get('/check', 'FractionsController@check')->name('admin.module.fraction.check');
    Route::get('/edit/{id?}', 'FractionsController@edit')->name('admin.module.fraction.edit');
    Route::get('/save/{id?}', 'FractionsController@save')->name('admin.module.fraction.save');

});
