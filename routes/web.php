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

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');
Route::get('/users/{user}/view', 'UserController@show')->name('users.view');
Route::get('/users/{user}/edit', 'UserController@update')->name('users.update');
Route::post('/users/{user}/store', 'UserController@store')->name('users.store');
Route::post('/users/make-admin', 'UserController@makeAdmin')->name('users.make-admin');
Route::delete('/users/{user}/delete', 'UserController@destroy')->name('users.delete');

Route::delete('/media/{medium}/delete', 'MediaController@destroy')->name('media.delete');
Route::get('/media/create', 'MediaController@create')->name('media.create');
Route::get('/media/{medium}/view', 'MediaController@show')->name('media.view');
Route::get('/media/{medium}/edit', 'MediaController@edit')->name('media.edit');
Route::post('/media/{medium}/update', 'MediaController@update')->name('media.update');
Route::post('/media/store', 'MediaController@store')->name('media.store');
Route::get('/media', 'MediaController@index')->name('media');


Route::delete('/mediausers/{mediumuser}/delete', 'MediumUsersController@destroy')->name('mediausers.delete');
Route::get('/mediausers/create', 'MediumUsersController@create')->name('mediausers.create');
Route::get('/mediausers/{mediumuser}/edit', 'MediumUsersController@edit')->name('mediausers.edit');
Route::post('/mediausers/{mediumuser}/update', 'MediumUsersController@update')->name('mediausers.update');
Route::post('/mediausers/store', 'MediumUsersController@store')->name('mediausers.store');
Route::get('/mediausers', 'MediumUsersController@index')->name('mediausers');


