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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/inbox', 'HomeController@inbox')->name('inbox')->middleware('auth');
Route::get('/send', 'HomeController@send')->name('send')->middleware('auth');
Route::get('/read/{id?}', 'HomeController@read')->name('read')->middleware('auth');

Route::post('/sms/store', 'SmsController@store')->name('admin.sms.store')->middleware('auth');

Route::get('/users/wizard/{id?}', 'UserController@wizard')->name('admin.users.wizard');
Route::get('/profile', 'UserController@profile')->name('profile');
Route::post('/profile/edit', 'UserController@EditProfile')->name('edit.profile');
Route::post('/profile/edit/pass', 'UserController@EditPass')->name('edit.pass');
Route::get('/users/edit/{id?}', 'UserController@edit')->name('admin.users.edit');
Route::get('/roles/edit/{id?}', 'RoleController@edit')->name('admin.roles.edit');
Route::get('/users/show', 'UserController@show')->name('admin.users.show');
Route::get('/users/delete/{id?}', 'UserController@delete')->name('admin.users.delete');
Route::get('/roles/delete/{id?}', 'RoleController@delete')->name('admin.roles.delete');
Route::get('/roles/show', 'RoleController@show')->name('admin.roles.show');
Route::post('/users/store', 'UserController@store')->name('admin.users.store');
Route::post('/users/update', 'UserController@update')->name('admin.users.update');
Route::post('/roles/update', 'RoleController@update')->name('admin.roles.update');
Route::get('/roles/wizard', 'RoleController@wizard')->name('admin.roles.wizard');
Route::post('/roles/store', 'RoleController@store')->name('admin.roles.store');
Route::get('/lock', 'RoleController@lock')->name('admin.lock');
Route::post('/check/lock', 'RoleController@checklock')->name('admin.check.lock')->middleware('auth');
