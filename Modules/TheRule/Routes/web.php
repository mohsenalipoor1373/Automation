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

Route::prefix('therule')->group(function () {
    Route::get('/rule/index', 'TheRuleController@index')->name('admin.module.rule.index');
    Route::get('/rule/wizard/{id?}', 'TheRuleController@wizard')->name('admin.module.rule.wizard');
    Route::get('/rule/edit/{id?}', 'TheRuleController@edit')->name('admin.module.rule.edit');
    Route::get('/rule/show', 'TheRuleController@show')->name('admin.module.rule.show');
    Route::get('/rule/show-rule', 'TheRuleController@showrule')->name('admin.module.rule.show-rule');
    Route::get('/rule/admin-rule', 'TheRuleController@showadmin')->name('admin.module.rule.show-admin');
    Route::get('/rule/make', 'TheRuleController@make')->name('admin.module.rule.make');
    Route::get('/rule/list/{id?}', 'TheRuleController@supervisorlist')->name('admin.module.rule.supervisor.list');
    Route::get('/rule/make-rule', 'TheRuleController@makerule')->name('admin.module.rule.make-rule');
    Route::get('/rule/make-admin', 'TheRuleController@makeadmin')->name('admin.module.rule.make-admin');
    Route::post('/rule/store', 'TheRuleController@store')->name('admin.module.rule.store');
    Route::post('/rule/update', 'TheRuleController@update')->name('admin.module.rule.update');
    Route::get('/rule/delete/{id?}', 'TheRuleController@delete')->name('admin.module.rule.delete');
    Route::get('/rule/supervisor/{id?}', 'TheRuleController@supervisorTrue')->name('admin.module.rule.supervisor.true');
    Route::get('/rule/supervisor/false/{id?}', 'TheRuleController@supervisorFalse')->name('admin.module.rule.supervisor.false');
    Route::get('/rule/admin/{id?}', 'TheRuleController@adminTrue')->name('admin.module.rule.admin.true');
    Route::get('/rule/admin/false/{id?}', 'TheRuleController@adminFalse')->name('admin.module.rule.admin.false');
    Route::get('/rule/check', 'TheRuleController@check')->name('admin.module.rule.check');
    Route::get('/rule/save/{id?}', 'TheRuleController@save')->name('admin.module.rule.save');


});
